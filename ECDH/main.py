import os
from cryptography.hazmat.primitives.asymmetric.x25519 import X25519PrivateKey, X25519PublicKey
from cryptography.hazmat.primitives.kdf.hkdf import HKDF
from cryptography.hazmat.primitives import hashes, serialization
from cryptography.hazmat.primitives.ciphers.aead import AESGCM

# 1. Key Derivation Function (HKDF) 
def derive_key(shared_secret):
    return HKDF(
        algorithm=hashes.SHA256(),
        length=32, # Untuk AES-256 
        salt=None,
        info=b"session-key", 
    ).derive(shared_secret)

# --- SIMULASI ---

# STEP 1: Generate Key Pair 
alice_private = X25519PrivateKey.generate() 
alice_public = alice_private.public_key() 

bob_private = X25519PrivateKey.generate() 
bob_public = bob_private.public_key()

# STEP 2: Key Exchange (Simulasi pertukaran dalam format Hex) 
alice_pub_hex = alice_public.public_bytes(serialization.Encoding.Raw, serialization.PublicFormat.Raw).hex()
bob_pub_hex = bob_public.public_bytes(serialization.Encoding.Raw, serialization.PublicFormat.Raw).hex()

print(f"[Alice] Public Key: {alice_pub_hex[:15]}...") 
print(f"[Bob] Public Key: {bob_pub_hex[:15]}...") 

# STEP 3: Hitung Shared Secret 
shared_alice = alice_private.exchange(bob_public)
shared_bob = bob_private.exchange(alice_public)

print(f"[Shared Secret] Alice: {shared_alice.hex()[:10]}... | Bob: {shared_bob.hex()[:10]}... (sama)") 

# STEP 4: Derive Session Key menggunakan HKDF 
session_key_alice = derive_key(shared_alice)
session_key_bob = derive_key(shared_bob)

print(f"[Session Key] Alice: {session_key_alice.hex()[:10]}... | Bob: {session_key_bob.hex()[:10]}... (sama)")

# STEP 5: Enkripsi oleh Alice 
pesan = b"Halo Bob, ini pesan rahasia!"
aesgcm = AESGCM(session_key_alice) 
nonce = os.urandom(12)  # Nonce harus acak!
ciphertext = aesgcm.encrypt(nonce, pesan, None) 

print(f"\n[Alice] Pesan asli: \"{pesan.decode()}\"") 
print(f"[Alice] Ciphertext: nonce={nonce.hex()} ct={ciphertext.hex()[:20]}...") 

# STEP 6: Dekripsi oleh Bob 
aesgcm_bob = AESGCM(session_key_bob) 
try:
    terdekripsi = aesgcm_bob.decrypt(nonce, ciphertext, None) 
    print(f"[Bob] Terdekripsi: \"{terdekripsi.decode()}\" \u2713") 
except Exception:
    print("[Bob] Gagal dekripsi!")

# STEP 7: Buktikan Isolasi (Session Baru) 
print("\n--- Simulasi Sesi Baru ---")
alice_private_baru = X25519PrivateKey.generate()
shared_baru = alice_private_baru.exchange(bob_public)
session_key_baru = derive_key(shared_baru)

print(f"[Session baru] Key berbeda: {session_key_baru.hex()[:10]}...") 
try:
    # Coba dekripsi pesan LAMA pakai kunci BARU
    AESGCM(session_key_baru).decrypt(nonce, ciphertext, None)
except:
    print("[Session baru] Gagal dekripsi pesan lama (Kunci tidak cocok!) \u2713") 