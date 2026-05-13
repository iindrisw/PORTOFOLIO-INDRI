import argparse
import os
import json
from cryptography.hazmat.primitives import hashes, serialization
from cryptography.hazmat.primitives.asymmetric import ed25519

def get_file_hash(file_path):
    """Menghitung hash SHA-256 dari sebuah file untuk verifikasi integritas"""
    sha256_hash = hashes.Hash(hashes.SHA256())
    with open(file_path, "rb") as f:
        for byte_block in iter(lambda: f.read(4096), b""):
            sha256_hash.update(byte_block)
    return sha256_hash.finalize().hex()

def keygen(name):
    """Generate pasangan kunci Ed25519 dan simpan ke file PEM"""
    private_key = ed25519.Ed25519PrivateKey.generate() 
    public_key = private_key.public_key() 
    
    password = input(f"Masukkan password untuk mengunci {name}.priv: ").encode()
    
    # Proteksi private key menggunakan PBKDF2 melalui BestAvailableEncryption 
    priv_bytes = private_key.private_bytes(
        encoding=serialization.Encoding.PEM,
        format=serialization.PrivateFormat.PKCS8,
        encryption_algorithm=serialization.BestAvailableEncryption(password)
    )
    
    pub_bytes = public_key.public_bytes(
        encoding=serialization.Encoding.PEM,
        format=serialization.PublicFormat.SubjectPublicKeyInfo
    )
    
    with open(f"{name}.priv", "wb") as f: f.write(priv_bytes)
    with open(f"{name}.pub", "wb") as f: f.write(pub_bytes)
    print(f"Kunci berhasil dibuat: {name}.priv dan {name}.pub")

def sign(key_path, file_path):
    """Menandatangani file tunggal menggunakan Ed25519"""
    password = input("Masukkan password kunci privat: ").encode()
    with open(key_path, "rb") as f:
        private_key = serialization.load_pem_private_key(f.read(), password=password)
    
    with open(file_path, "rb") as f:
        data = f.read()
    
    signature = private_key.sign(data) 
    with open(f"{file_path}.sig", "wb") as f:
        f.write(signature)
    print(f"Signature disimpan di: {file_path}.sig")

def verify(key_path, file_path, sig_input):
    """Verifikasi tanda tangan dari file .sig atau teks HEX dari manifest"""
    with open(key_path, "rb") as f:
        public_key = serialization.load_pem_public_key(f.read())
    
    with open(file_path, "rb") as f:
        data = f.read()
    
    # Cek apakah input adalah path file atau string HEX
    if os.path.isfile(sig_input):
        with open(sig_input, "rb") as f:
            signature = f.read()
    else:
        try:
            signature = bytes.fromhex(sig_input)
        except ValueError:
            print("Error: Argumen --sig harus berupa file .sig atau string HEX signature.")
            return
    
    file_hash = get_file_hash(file_path)
    
    print("\n" + "═"*47)
    print("Hasil Verifikasi Tanda Tangan Digital")
    print("═"*47)
    print(f"File      : {os.path.basename(file_path)}")
    print(f"Algoritma : Ed25519")
    print(f"Hash      : {file_hash[:20]}... (SHA-256)")
    
    try:
        public_key.verify(signature, data) 
        print(f"Status    : ✓ VALID")
        print(f"Pesan     : Dokumen asli. Tanda tangan sah.")
    except Exception:
        print(f"Status    : X INVALID")
        print(f"Pesan     : Dokumen dimodifikasi atau tanda tangan palsu!")
    print("═"*47 + "\n")

def manifest(key_path, folder_path):
    """Proses tanda tangan massal untuk folder dan buat manifest.json"""
    password = input("Masukkan password kunci privat: ").encode()
    with open(key_path, "rb") as f:
        private_key = serialization.load_pem_private_key(f.read(), password=password)
    
    results = []
    for filename in os.listdir(folder_path):
        file_path = os.path.join(folder_path, filename)
        if os.path.isfile(file_path):
            with open(file_path, "rb") as f:
                data = f.read()
            
            file_hash = get_file_hash(file_path)
            signature = private_key.sign(data).hex()
            
            results.append({
                "path": file_path,
                "hash": file_hash,
                "signature": signature
            })
    
    with open("manifest.json", "w") as f:
        json.dump(results, f, indent=4)
    print(f"Manifest berhasil dibuat: manifest.json ({len(results)} file)")

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="DocSign CLI Ed25519")
    subparsers = parser.add_subparsers(dest="command")

    subparsers.add_parser("keygen").add_argument("--name", required=True)
    
    p_sign = subparsers.add_parser("sign")
    p_sign.add_argument("--key", required=True)
    p_sign.add_argument("--file", required=True)

    p_verify = subparsers.add_parser("verify")
    p_verify.add_argument("--key", required=True)
    p_verify.add_argument("--file", required=True)
    p_verify.add_argument("--sig", required=True)

    p_manifest = subparsers.add_parser("manifest")
    p_manifest.add_argument("--key", required=True)
    p_manifest.add_argument("--folder", required=True)

    args = parser.parse_args()

    if args.command == "keygen":
        keygen(args.name)
    elif args.command == "sign":
        sign(args.key, args.file)
    elif args.command == "verify":
        verify(args.key, args.file, args.sig)
    elif args.command == "manifest":
        manifest(args.key, args.folder)