import os
import argparse
import struct
import time
from cryptography.hazmat.primitives.asymmetric import rsa, padding
from cryptography.hazmat.primitives import serialization, hashes
from cryptography.hazmat.primitives.ciphers.aead import AESGCM

MAGIC = b"SMG1"

# ================= RSA =================
def generate_keys(name):
    private_key = rsa.generate_private_key(
        public_exponent=65537,
        key_size=2048
    )

    passphrase = b"123456"

    with open(f"{name}_private.pem", "wb") as f:
        f.write(private_key.private_bytes(
            encoding=serialization.Encoding.PEM,
            format=serialization.PrivateFormat.PKCS8,
            encryption_algorithm=serialization.BestAvailableEncryption(passphrase)
        ))

    public_key = private_key.public_key()
    with open(f"{name}_public.pem", "wb") as f:
        f.write(public_key.public_bytes(
            encoding=serialization.Encoding.PEM,
            format=serialization.PublicFormat.SubjectPublicKeyInfo
        ))

    print(f"Key {name} berhasil dibuat!")

def load_public_key(name):
    with open(f"{name}_public.pem", "rb") as f:
        return serialization.load_pem_public_key(f.read())

def load_private_key(name):
    with open(f"{name}_private.pem", "rb") as f:
        return serialization.load_pem_private_key(f.read(), password=b"123456")

# ================= RSA =================
def rsa_encrypt(public_key, data):
    return public_key.encrypt(
        data,
        padding.OAEP(
            mgf=padding.MGF1(algorithm=hashes.SHA256()),
            algorithm=hashes.SHA256(),
            label=None
        )
    )

def rsa_decrypt(private_key, data):
    return private_key.decrypt(
        data,
        padding.OAEP(
            mgf=padding.MGF1(algorithm=hashes.SHA256()),
            algorithm=hashes.SHA256(),
            label=None
        )
    )

# ================= HYBRID =================
def hybrid_encrypt(public_key, plaintext):
    session_key = os.urandom(32)

    aes = AESGCM(session_key)
    nonce = os.urandom(12)
    ciphertext = aes.encrypt(nonce, plaintext, None)

    c_key = rsa_encrypt(public_key, session_key)

    return (
        MAGIC +
        struct.pack(">H", len(c_key)) +
        c_key +
        nonce +
        ciphertext
    )

def hybrid_decrypt(private_key, data):
    if data[:4] != MAGIC:
        raise ValueError("Format file tidak valid!")

    ckey_len = struct.unpack(">H", data[4:6])[0]

    c_key = data[6:6+ckey_len]
    nonce = data[6+ckey_len:6+ckey_len+12]
    ciphertext = data[6+ckey_len+12:]

    session_key = rsa_decrypt(private_key, c_key)

    aes = AESGCM(session_key)
    return aes.decrypt(nonce, ciphertext, None)

# ================= BENCHMARK =================
def rsa_encrypt_direct(public_key, data):
    return public_key.encrypt(
        data,
        padding.OAEP(
            mgf=padding.MGF1(algorithm=hashes.SHA256()),
            algorithm=hashes.SHA256(),
            label=None
        )
    )

# ================= CLI =================
def main():
    parser = argparse.ArgumentParser()
    sub = parser.add_subparsers(dest="command")

    # keygen
    k = sub.add_parser("keygen")
    k.add_argument("--name", required=True)

    # encrypt
    e = sub.add_parser("encrypt")
    e.add_argument("--from_user")
    e.add_argument("--to")
    e.add_argument("--infile")
    e.add_argument("--out")

    # decrypt
    d = sub.add_parser("decrypt")
    d.add_argument("--as_user")
    d.add_argument("--infile")
    d.add_argument("--out")

    # benchmark
    b = sub.add_parser("benchmark")
    b.add_argument("--to")
    b.add_argument("--infile")

    args = parser.parse_args()

    # ================= KEYGEN =================
    if args.command == "keygen":
        generate_keys(args.name)

    # ================= ENCRYPT =================
    elif args.command == "encrypt":
        pub = load_public_key(args.to)

        with open(args.infile, "rb") as f:
            data = f.read()

        start = time.time()
        encrypted = hybrid_encrypt(pub, data)
        end = time.time()

        with open(args.out, "wb") as f:
            f.write(encrypted)

        print(f"✅ Enkripsi berhasil! Waktu: {end - start:.6f} detik")

    # ================= DECRYPT =================
    elif args.command == "decrypt":
        priv = load_private_key(args.as_user)

        with open(args.infile, "rb") as f:
            data = f.read()

        try:
            start = time.time()
            decrypted = hybrid_decrypt(priv, data)
            end = time.time()

            with open(args.out, "wb") as f:
                f.write(decrypted)

            print(f"✅ Dekripsi berhasil! Waktu: {end - start:.6f} detik")

        except Exception:
            print("❌ Gagal decrypt!")
            print("Kemungkinan:")
            print("- Salah private key")
            print("- File rusak / dimodifikasi")

    # ================= BENCHMARK =================
    elif args.command == "benchmark":
        pub = load_public_key(args.to)

        with open(args.infile, "rb") as f:
            data = f.read()

        print("\n=== BENCHMARK ===")

        start = time.time()
        hybrid_encrypt(pub, data)
        end = time.time()
        print(f"Hybrid Encryption: {end - start:.6f} detik")

        small_data = data[:190]

        start = time.time()
        rsa_encrypt_direct(pub, small_data)
        end = time.time()
        print(f"RSA Langsung (data kecil): {end - start:.6f} detik")

        print("\nCatatan:")
        print("- RSA tidak cocok untuk data besar")
        print("- Hybrid lebih cepat & efisien")

if __name__ == "__main__":
    main()
