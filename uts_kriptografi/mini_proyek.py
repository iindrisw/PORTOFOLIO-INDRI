import os
import argparse
from cryptography.hazmat.primitives.kdf.pbkdf2 import PBKDF2HMAC
from cryptography.hazmat.primitives import hashes
from cryptography.hazmat.primitives.ciphers.aead import AESGCM
from cryptography.hazmat.backends import default_backend
from cryptography.exceptions import InvalidTag

SALT_SIZE = 16
NONCE_SIZE = 12
ITERATIONS = 100000
KEY_SIZE = 32  # AES-256


def derive_key(password: str, salt: bytes) -> bytes:
    kdf = PBKDF2HMAC(
        algorithm=hashes.SHA256(),
        length=KEY_SIZE,
        salt=salt,
        iterations=ITERATIONS,
        backend=default_backend()
    )
    return kdf.derive(password.encode())

#enkripsi
def encrypt_file(input_file, output_file, password):
    try:
        with open(input_file, 'rb') as f:
            data = f.read()

        # Generate salt & nonce
        salt = os.urandom(SALT_SIZE)
        nonce = os.urandom(NONCE_SIZE)

        # Derive key
        key = derive_key(password, salt)
        aesgcm = AESGCM(key)

        # Metadata
        original_filename = os.path.basename(input_file).encode()
        filename_length = len(original_filename)

        # AAD = SEMUA HEADER
        aad = salt + nonce + filename_length.to_bytes(1, 'big') + original_filename

        # Enkripsi
        ciphertext = aesgcm.encrypt(nonce, data, aad)

        # Simpan file
        with open(output_file, 'wb') as f:
            f.write(salt)
            f.write(nonce)
            f.write(filename_length.to_bytes(1, 'big'))
            f.write(original_filename)
            f.write(ciphertext)

        print("✅ Enkripsi berhasil!")

    except FileNotFoundError:
        print("❌ Error: File input tidak ditemukan.")
    except Exception as e:
        print(f"❌ Error: {str(e)}")


#deskripsi
def decrypt_file(input_file, output_file, password):
    try:
        with open(input_file, 'rb') as f:
            content = f.read()

        # Ambil header
        salt = content[:SALT_SIZE]
        nonce = content[SALT_SIZE:SALT_SIZE + NONCE_SIZE]

        filename_length = content[SALT_SIZE + NONCE_SIZE]

        start = SALT_SIZE + NONCE_SIZE + 1
        end = start + filename_length

        original_filename = content[start:end]
        ciphertext = content[end:]

        # AAD HARUS SAMA 
        aad = salt + nonce + filename_length.to_bytes(1, 'big') + original_filename

        # Derive key
        key = derive_key(password, salt)
        aesgcm = AESGCM(key)

        # Dekripsi
        plaintext = aesgcm.decrypt(nonce, ciphertext, aad)

        with open(output_file, 'wb') as f:
            f.write(plaintext)

        print("✅ Dekripsi berhasil!")

    except FileNotFoundError:
        print("❌ Error: File tidak ditemukan.")
    except InvalidTag:
        print("❌ Tamper detected! Password salah atau file telah dimodifikasi.")
    except Exception as e:
        print(f"❌ Error: File rusak atau format tidak valid. Detail: {str(e)}")


def main():
    parser = argparse.ArgumentParser(description="AES-256-GCM File Encryption (Secure Version)")
    parser.add_argument("mode", choices=["encrypt", "decrypt"], help="Mode operasi")
    parser.add_argument("input_file", help="File input")
    parser.add_argument("output_file", help="File output")
    parser.add_argument("--password", required=True, help="Password")

    args = parser.parse_args()

    if args.mode == "encrypt":
        encrypt_file(args.input_file, args.output_file, args.password)
    elif args.mode == "decrypt":
        decrypt_file(args.input_file, args.output_file, args.password)


if __name__ == "__main__":
    main()