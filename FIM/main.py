import hashlib
import hmac
import json
import os
import argparse

# Fungsi hitung hash SHA-256 file (Hemat RAM/Streaming)
def get_file_hash(filepath):
    h = hashlib.sha256()
    try:
        with open(filepath, 'rb') as f:
            # Baca per 64KB agar tidak membebani memori
            for chunk in iter(lambda: f.read(65536), b""):
                h.update(chunk)
        return h.hexdigest()
    except Exception as e:
        print(f"[ERROR] Gagal akses {filepath}: {e}")
        return None

# Fungsi hitung HMAC untuk memproteksi file baseline.json
def calculate_hmac(data_dict, password):
    key = password.encode()
    # Urutkan keys agar string JSON selalu konsisten (deterministik)
    data_str = json.dumps(data_dict, sort_keys=True)
    return hmac.new(key, data_str.encode(), hashlib.sha256).hexdigest()

def init_mode(folder, password):
    print(f"[INIT] Memindai folder: {folder}...")
    baseline = {}
    
    # Ambil semua file di folder & sub-folder
    for root, _, files in os.walk(folder):
        for name in files:
            filepath = os.path.join(root, name)
            # Normalisasi path agar konsisten di berbagai OS
            norm_path = os.path.relpath(filepath, folder)
            file_hash = get_file_hash(filepath)
            if file_hash:
                baseline[norm_path] = file_hash
                
    # Buat signature HMAC agar baseline tidak bisa diedit manual oleh penyerang
    signature = calculate_hmac(baseline, password)
    
    output = {
        "data": baseline,
        "signature": signature
    }
    
    with open("baseline.json", "w") as f:
        json.dump(output, f, indent=4)
    
    print(f"[INIT] Memindai {len(baseline)} file...")
    print("[INIT] Baseline disimpan: baseline.json (HMAC dilindungi)")

def check_mode(folder, password):
    if not os.path.exists("baseline.json"):
        print("[ERROR] File baseline.json tidak ditemukan! Jalankan 'init' dulu.")
        return

    with open("baseline.json", "r") as f:
        stored_baseline = json.load(f)

    # 1. Verifikasi Integritas Baseline (Cegah modifikasi file JSON)
    current_sig = calculate_hmac(stored_baseline["data"], password)
    if not hmac.compare_digest(stored_baseline["signature"], current_sig):
        print("[ERROR] Baseline dimodifikasi! HMAC tidak valid — baseline tidak dipercaya.")
        return

    # 2. Scan Kondisi Folder Sekarang
    print(f"[CHECK] Memindai {folder}...")
    current_files = {}
    for root, _, files in os.walk(folder):
        for name in files:
            filepath = os.path.join(root, name)
            norm_path = os.path.relpath(filepath, folder)
            f_hash = get_file_hash(filepath)
            if f_hash:
                current_files[norm_path] = f_hash

    # 3. Bandingkan dengan Data Baseline
    old_data = stored_baseline["data"]
    ok_count = 0
    
    # Deteksi File Baru dan File Berubah
    for path, h_val in current_files.items():
        if path not in old_data:
            print(f"[BARU] {path} (tidak ada di baseline)")
        elif old_data[path] != h_val:
            print(f"[UBAH] {path} (hash berubah — isi dimodifikasi!)")
            print(f"       Baseline: {old_data[path][:16]}...")
            print(f"       Sekarang: {h_val[:16]}...")
        else:
            ok_count += 1

    # Deteksi File yang Dihapus
    for path in old_data:
        if path not in current_files:
            print(f"[HAPUS] {path} (ada di baseline, sekarang hilang)")

    print(f"[OK] {ok_count} file tidak berubah")

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="FIM - File Integrity Monitor")
    parser.add_argument("mode", choices=["init", "check"], help="Mode: init atau check")
    parser.add_argument("folder", help="Target folder")
    parser.add_argument("--password", required=True, help="Password untuk keamanan HMAC")
    
    args = parser.parse_args()
    
    if args.mode == "init":
        init_mode(args.folder, args.password)
    else:
        check_mode(args.folder, args.password)

