import math
import os
import time


data_kota = [["sumber", -6.74875, 108.47115],
        ["plumbon",  -6.72000, 108.46250 ],
        ["arjawinangun", -6.64034, 108.40238],
        ["depok", -6.72697, 108.44186],
        ["talun", -6.75500, 108.51833]
        ]

data_feedback = (
    ("adam", "menu chat pelanggan belum dibuAT, nanti tolong dibuat"),
    ("indri", "Tolong tambahin fitur jadwal keberangkatan."),
    ("farid", "Tampilan menu pelanggan tolong nanti dirapihin lagi."),
)

pelanggan = [[0, 'adam','123',True, 200000],[1, 'anjay', '123', True, 200000]]
driver = [[0 ,'admin', '123', True, 0], [1, 'anjir', '123', False, 10]]
promo = {
    'diskon10':{'nama_promo':'gajian','persen_promo':10}
    }
order = [[[0 ,'admin', '123', True],[1, 'anjay','123',True], 'cirebon','batam']]

def cs():
    os.system('cls' if os.name == 'nt' else 'clear')

def main():
    cs()
    time.sleep(0.5)
    print("\n=== Landing Page ===")
    print("1. Admin")
    print("2. Driver")
    print("3. Pelanggan")   
    print('-----------------------')
    pilihan = int(input('masukan :'))
    if pilihan == 1:
        menu_admin()
    elif pilihan == 2:
        menu_driver()
    elif pilihan == 3:
        menu_pelanggan()   
        print("Pilihan tidak valid.")
    else:
        main()

def menu_admin():
    while True:
        
        cs()
        time.sleep(0.5)
        print("\n=== Menu admin ===")
        print("1. View Database")
        print("2. View Transaksi")
        print("3. Data kota")
        print('4. kembali')
        print("-----------------------")
        
        try:
            pilih = int(input("masukan pilihan: "))
        
        except ValueError:
            print("input tidak valid masukan angka")
            time.sleep(1)
            menu_admin()
        if pilih == 1:
            database()
        elif pilih == 2:
            transaksi()
        elif pilih == 3:
            daftar_kota()
        elif pilih == 4:
            main()  
        else:
            print("Pilihan tidak valid.")
            menu_admin()
def database():
    cs()
    time.sleep(0.5)
    print('=== Database ===')
    print('1. View driver')
    print('2. View pelanggan')
    print('3. data feedback')
    print('4. Kembali')
    print('-----------------')
    pilih = input("masukan yang anda pilih : ")
    if pilih == '1':
        database_driver()
        pilih = input('\nketik tombol apa saja untuk kembali : ')
        if pilih:
            database()
    elif pilih == '2':
        database_pelanggan()
        pilih = input('\nketik tombol apa saja untuk kembali : ')
        if pilih:
            database()
    elif pilih == '3':
        menu_admin()
    elif pilih == '4':
        lihat_feedback()
    else:
        print('pilihan tidak valid')
        time.sleep(0.5)
        database()
def lihat_feedback():
    cs()
    print("=== Feedback Pengguna ===")
    for i, fb in enumerate(data_feedback):
        print(f"{i+1}. Dari {fb[0]}: \"{fb[1]}\"")
    input("\nTekan Enter untuk kembali...")

def database_driver():
    data_active_driver = driver_active()
    print('berikut adalah list data driver yg aktif :')
    for i in range (len(data_active_driver)):
        print(data_active_driver[i][0], "Nama driver:" , data_active_driver[i][1])
    pilih = input('\nketik tombol apa saja untuk kembali : ')
    if pilih:
        database()

def database_pelanggan():
    global data_pelanggan_active_now
    data_pelanggan_active_now = pelanggan_active()
    print('berikut adalah list data pelanggan yg aktif :')
    for i in range (len(data_pelanggan_active_now)):
        print(data_pelanggan_active_now[i][0], "Nama pelanggan:" , data_pelanggan_active_now[i][1])
    pilih = input('\nketik tombol apa saja untuk kembali : ')
    if pilih:
        database()
    
    
def transaksi():
    cs()
    time.sleep(0.5)
    print("=== Transaksi view ===")
    print("1. Promo")
    print("2. Kembali ")
    pilih = input("Masukan yang akan anda pilih : ")
    if pilih == '1':
        promo_admin()
    elif pilih == '2':
        menu_admin()
    else:
        print ("Pilihan tidak valid")
        transaksi()
def promo_admin():
    cs()
    global nama_promo
    global persen_promo
    global keys
    time.sleep(0.5)
    print("\n=== Menu Promo ===")
    print("1. Create Promo")
    print("2. View Promo")
    print("3. Delete Promo")
    print("4. kembali")
    print('---------------------')
    pilih = input("Masukan yang akan anda pilih : ")
    if pilih == '1':
        kode=input("Masukan kode promo: ")
        nama_promo=input("Masukan nama promo: ")
        persen_promo=int(input("Masukan nilai presentase promo : "))
        promo[kode]={'nama_promo':nama_promo, 'persen_promo':persen_promo}
        print("promo berhasil ditambahkan !!")
        time.sleep(0.5)
        promo_admin()
    elif pilih == '2':
        if not promo:
            print("Belum ada promo")
            print('silahkan kembali dan buat promo')
            pilih = input('\nketik tombol apa saja untuk kembali : ')
            if pilih:
                promo_admin()
        else:
            keys=list(promo.keys())
            for i in range(len(keys)):
                key=keys[i]
                detail = promo[key]
                print("=" * 18)
                print(f"{i}. kode: {key} Nama Promo : {detail['nama_promo']}, presentase : {detail['persen_promo']}")
                print("=" * 18)
            pilih = input('\n\nketik tombol apa saja untuk kembalk : ')
            if pilih:
                promo_admin()
    elif pilih =='3':
        if not promo:
            print("Belum ada promo")
            print('silahkan kembali dan buat promo')
            pilih = input('\nketik tombol apa saja untuk kembali : ')
            if pilih:
                promo_admin()
        else:
            print(promo)
            delete =int(input("Masukan promo yang akan di hapus: "))
            del promo[delete]
            pilih = input('\nketik tombol apa saja untuk kembali : ')
            if pilih:
                promo_admin()    
    elif pilih =='4':
        main()
    else:
        print("Pilihan tidak valid")   
        time.sleep(0.5)
        promo_admin()


def pembayaran_admin():
    cs()
    time.sleep(0.5)
    #literal utk mmebuat kotak
    id = 0
    
    for i in range(len(order)):
        id = i + 1
    id_order =  id-1
    for i in range(len(order)):
        print("Nama pengguna    : ", order[id_order][1][1])
        print('Nama driver      :', order[id_order][0][1])
        print("Kota awal kamu   : ",  order[id_order][2])
        print("Kota tujuan kamu : ",  order[id_order][3])
        print(f"Jarak           : {jarak:.2f} km")
        print(f"Tarif           : Rp{tarif: .0f}")
    pilih = print('\n apakah kamu ingin melanjutkan pembayaran(y/n)')
    if pilih == 'y' or 'Y':
        tunggu_pelanggan()
    else:
        dashboard_pelanggan()
        

def koordinat(nama_kota):
    for kota in data_kota:
        if nama_kota == kota[0]:
            return kota[1], kota[2]
    return 'kota tidak ditemukan'

def tarif_admin(destinasi_awal, destinasi_tujuan):
    # Konversi derajat ke radian
    lat1_rad = math.radians(destinasi_awal[0])
    lon1_rad = math.radians(destinasi_awal[1])
    lat2_rad = math.radians(destinasi_tujuan[0])
    lon2_rad = math.radians(destinasi_tujuan[1])


    # Selisih koordinat
    dlat = lat2_rad - lat1_rad
    dlon = lon2_rad - lon1_rad

    # Rumus Haversine yang benar
    a = math.sin(dlat / 2)*2 + math.cos(lat1_rad) * math.cos(lat2_rad) * math.sin(dlon / 2)*2
    r = 6371  # Radius bumi dalam kilometer
    c = 2 * math.atan2(math.sqrt(a), math.sqrt(1 - a))
    jarak = r * c  # Hasil dalam kilometer

    tarif_m = 500  # Tarif per km
    return jarak, jarak * tarif_m



#daftar kota 
def daftar_kota():
    print("\n=== Data kota ===")
    print("1. View daftar kota")
    print("2. Create daftar kota")
    print("3. Modify daftar kota")
    print("4. Delete daftar kota")
    print("5. Kembali") 
    pilih = input("Masukan yang anda pilih :")
    if pilih == "1":
        for i in range(len(data_kota)):
            print(f"{i}. Nama kota : {data_kota[i][0]}\nLintang : {data_kota[i][1]}\nBujur : {data_kota[i][2]}\n")
        pilih = input("ketik tombol apa saja untuk kembali :")
        if pilih :
            daftar_kota()
    elif pilih == "2":
        input_data_kota = input("berapa data yang ingin anda tambah :")
        for i in range(input_data_kota):
            Nama_kota = input("Nama kota yang ingin anda tambahka :")
            
        


#Driver V V V V V V 
def menu_driver():
    cs()
    time.sleep(0.5)
    print('=== dashboard driver ===')
    print("1. Login")
    print("2. Buat akun")
    print("3. Kembali")
    pilih = input('Apa yang kamu pilih: ')
    if pilih == '1':
        login_driver()
    elif pilih == '2':
        create_account_driver()
    elif pilih == '3':
        main()
    else:
        print('Pilihan tidak valid')
        menu_driver()

def create_account_driver():
    cs()
    time.sleep(0.5)
    print("=== Create account ===")
    username_account_driver = input("Masukkan Username Anda: ")
    password_account_driver= input("Masukkan Password Anda: ")
    status = False
    cash = 0
    id = 0
    for i in range(len(driver)):
        id += 1
    id_driver = id
    data_account_driver = data_create_account_driver(username_account_driver, password_account_driver)
    if data_account_driver:
        print("Account sudah digunakan")
        time.sleep(0.5)
        create_account_driver()
    else:
        driver.append([id_driver, username_account_driver, password_account_driver, status, cash])
        print("anda berhasil membuat account")
        time.sleep(0.5)
        login_driver()

    
    
def data_create_account_driver(username_account_driver, password_account_driver):
    for i in range(len(driver)):
        usn = driver[i][1]
        pw = driver[i][2]
        if usn == username_account_driver and pw == password_account_driver:
            return driver[i]
    return None

def login_driver():
    cs()
    time.sleep(0.5)
    print("=== Login account ===")
    global data_active_driver
    global username_driver
    global username_pelanggan
    username_driver = input('Masukkan username Drive: ')
    password_driver = input('Masukkan password Drive: ')
    data_active_driver = data_login_driver(username_driver, password_driver)
    if data_active_driver:
        print("anda berhasil login")
        time.sleep(0.5)
        dashboard_driver(data_active_driver)
    else:
        print("Username atau password salah.")
        time.sleep(0.5)
        menu_driver()

def data_login_driver(username_login_driver, password_login_driver):
    cs()
    time.sleep(0.5)
    for i in range(len(driver)):
        usn = driver[i][1]
        pw = driver[i][2]
        if usn == username_login_driver and pw == password_login_driver:
            return driver[i]
    return None


def dashboard_driver(data_driver):
    cs()
    time.sleep(0.5)
    global status_driver_jalan
    status_driver_jalan = 0
    print("=== Dashboard driver ===")
    print('nama kamu :', data_driver[1])
    print('status kamu :', data_driver[3])
    print('uang yang kamu miliki :', data_driver[4], 'Rp')
    print('\n1. cek pesanan')
    print("2. ubah status")
    print('3. kembali')
    pilih = input("mau apa kamu :")
    if pilih == '1':
        driver_cek(data_driver)
    elif pilih == "2":
        if data_driver[3] == True:
            data_driver[3] = False
            print("status anda telah dirubah!")
            time.sleep(1)
            dashboard_driver(data_driver)
        else:
            data_driver[3] = True
            print("status anda telah dirubah!")
            time.sleep(1)
            dashboard_driver(data_driver)
    elif pilih == '3':
        menu_driver()
    else:
        print('pilihan tidak valid')
        time.sleep(0.5)
        dashboard_driver(data_driver)    


#PELANGGAN V V V V V

def menu_pelanggan():
    cs()
    time.sleep(0.5)
    print("1. login")
    print("2. creat account")
    print("3. kembali")
    pilih = input("apa yang kamu pilih :")
    if pilih == '1':
        login_pelanggan()
    elif pilih == '2':
        create_login_pelanggan()
    elif pilih == '3':
        main()
    else:
        print("pilihan tidak valid")
        menu_pelanggan()
    
def create_login_pelanggan ():
    cs()
    time.sleep(0.5)
    print("=== Create account ===")
    username_account_pelanggan = input("Masukkan Username Anda: ")
    password_account_pelanggan = input("Masukkan Password Anda: ")
    status = False
    cash = 200000
    id_pelanggan = len(pelanggan) + 1  
    data_account_pelanggan = data_create_account_pelanggan(username_account_pelanggan, password_account_pelanggan)
    if data_account_pelanggan:
        print("Account sudah digunakan")
        time.sleep(1)
        create_login_pelanggan()
    else:
        pelanggan.append([id_pelanggan, username_account_pelanggan, password_account_pelanggan, status, cash])
        print("anda berhasil membuat account")
        time.sleep(1)
        login_pelanggan()

def data_create_account_pelanggan(username_account_pelanggan, password_account_pelanggan):
    for i in range(len(pelanggan)):
        usn = pelanggan[i][1]
        pw = pelanggan[i][2]
        if usn == username_account_pelanggan and pw == password_account_pelanggan:
            return pelanggan[i]
    return 0  

def login_pelanggan():
    cs()
    time.sleep(0.5)
    print("=== Login account ===")
    global username_pelanggan
    global pasword_pelanggan
    global data_pelanggan
    username_pelanggan = input("masukan username anda :")
    pasword_pelanggan = input ("masukan pasword anda :")
    data_pelanggan = data_login_pelanggan(username_pelanggan, pasword_pelanggan)
    if data_pelanggan:
        print("login berhasil")
        dashboard_pelanggan(data_pelanggan)
    else:
        print("username atau pasword salah")
        menu_pelanggan() 
    
def data_login_pelanggan(username, pasword):
    cs()
    time.sleep(0.5)
    for i in range(len(pelanggan)):
        usn = pelanggan[i][1]
        pw = pelanggan[i][2]
        if usn == username and pw == pasword:
           print("login berhasil")
           time.sleep(1)
           return pelanggan[i]
        None
def dashboard_pelanggan(data_pelanggan):
    cs()
    time.sleep(0.5)
    print("=== dashboard_pelanggan ===")
    print('Nama kamu', data_pelanggan[1])
    print('uang yang kamu miliki : rp.', data_pelanggan[4])
    print("\n1.Pesan")
    print("2.Lihat Promo")
    print('3. exit')
    try:
        pilih = int(input("masukan pilihan: "))
    except ValueError:
        print("input tidak valid masukan angka")
        time.sleep(1)
        dashboard_pelanggan(data_pelanggan)
    if pilih ==1 :
        pesanan()
    elif pilih == 2:
        promotion(data_pelanggan)
    elif pilih == 3:
        menu_pelanggan()
    else:
        print("pilihan tidak valid")
        time.sleep(0.5)
        dashboard_pelanggan(data_pelanggan)
   
       
def pesanan():
    cs()
    time.sleep(0.5)
    global destinasi_awal
    global destinasi_tujuan
    global jarak
    global tarif
    print('pilih kota yang tersedia :')
    for i in range(len(data_kota)):
        print(i+1,'.', data_kota[i][0])

    destinasi_awal = input("\ndestinasi awal: ")
    destinasi_tujuan = input("destinasi akhir: ")
    koor_awal = koordinat(destinasi_awal)
    koor_tujuan = koordinat(destinasi_tujuan)
    jarak, tarif = tarif_admin(koor_awal, koor_tujuan)
    print("tujuan anda adalah : ", destinasi_awal,"sampai",destinasi_tujuan)
    time.sleep(1)
    data_driver_active()

def promooooooo(kode_promo):
    if kode_promo in promo:
        nilai_pro = promo[kode_promo]['persen_promo']
        return nilai_pro
    else:
        print("Kode promo tidak valid.")
        return 0 


    
def promotion(data_pelanggan):
    cs()
    time.sleep(0.5)
    global keys
    if not promo:
        print("Belum ada promo")
        print('silahkan kembali dan buat promo')
        pilih = input('\nketik tombol apa saja untuk kembali : ')
        if pilih:
            dashboard_pelanggan(data_pelanggan)
    else:
        keys=list(promo.keys())
        for i in range(len(keys)):
            key=keys[i]
            detail = promo[key]
            print("=" * 18)
            print(f"{i}. kode: {key} Nama Promo : {detail['nama_promo']}, presentase : {detail['persen_promo']}")
            print("=" * 18)
        pilih = input('tekan tombol apapun untuk kembali :')
        if pilih:
            dashboard_pelanggan(data_pelanggan)  


def data_driver_active():
    cs()
    global data_cari_driver
    time.sleep(0.5)
    data_active_driver = driver_active()
    print('berikut adalah list data driver yg aktif :')
    for i in range (len(data_active_driver)):
        print(data_active_driver[i][0], "Nama driver:" , data_active_driver[i][1])
    pilih_driver = int(input('Masukan driver mana yang kamu pilih :'))
    data_cari_driver = data_pilih_driver(pilih_driver)
    if data_cari_driver:
        status_order()
    else: 
        print("tidak ada driver yang anda pilih")
        time.sleep(0.5)
        data_driver_active()
        

def data_pilih_driver(pilih_driver):
    for i in range(len(driver)):
        pilihan_driver = driver[i][0]
        if pilih_driver == pilihan_driver:
            return driver[i]
    return None

def driver_active():
    driver_aktif = []
    for i in driver:
        if i[3] == True:
            driver_aktif.append(i)
    return driver_aktif

#promo_admin()
#pembayaran_admin()



    
def pelanggan_active():
    pelanggan_aktif = []
    for i in pelanggan:
        if i[3] == True:
            pelanggan_aktif.append(i)
    return pelanggan_aktif

#dashboard_pelanggan()
def status_order ():
    order.append ([data_cari_driver,data_pelanggan, destinasi_awal, destinasi_tujuan])
    print("driver yang kamu pilih adalah :",data_cari_driver[1])
    time.sleep(2)
    tunggu_pelanggan()

def tunggu_pelanggan():
    global id_order
    cs()
    id_order = 0
    for i in range(len(order)):
        id_order = i + 1
    id_order = id_order - 1    
    print('=== Struk pelanggan ===')
    print("Nama pengguna    : ", order[id_order][1][1])
    print('Nama driver      :', order[id_order][0][1])
    print("Kota awal kamu   : ",  order[id_order][2])
    print("Kota tujuan kamu : ",  order[id_order][3])
    print(f"Jarak           : {jarak:.2f} km")
    print(f"Tarif           : Rp{tarif: .0f}")
    pilih = input('\n apakah kamu ingin melanjutkan pembayaran(y/n)')
    if pilih == 'y':
        dashboard_tunggu_pelanggan()
    else:
        print("Terima kasih, silakan kembali ke menu utama.")
        dashboard_pelanggan(data_pelanggan)
    
def driver_cek(data_driver):
    for i in range (len(order)):
        if order[i][0][1] == data_active_driver:
            if order[i][0][1]:
                global id_cek
                id = 0
                for i in range(len(order)):
                    id = i + 1
                id_cek =  id-1
                for i in range(len(order)):
                    print('Mode driver')
                    print("Nama pengguna    : ", order[id_cek][1][1])
                    print('Nama driver      :', order[id_cek][0][1])
                    print("Kota awal kamu   : ",  order[id_cek][2])
                    print("Kota tujuan kamu : ",  order[id_cek][3])
                    print(f"Jarak           : {jarak:.2f} km")
                    print(f"Tarif           : Rp{tarif: .0f}")
                pilih = input('apakah anda ingin menerima orderan ini(y/n)?')
                if pilih == 'y':
                    dashboard_tunggu_driver()
                else:
                    dashboard_driver(data_driver)
        else:
            print("belum ada orderan yang masuk!")
            pilih = input("\nketik apapun untuk kembali :")
            if pilih:
                dashboard_driver(data_driver)     
            
def dashboard_tunggu_driver():
    global status_driver_jalan
    cs()
    print("=== Menu driver ===")
    print('1. otw tempat?')
    print("2. switch")
    pilih = input('Masukan pilihan anda :')
    if pilih == '1':
        status_driver_jalan = 'y'
        status_driver()
    elif pilih == '2':
        dashboard_tunggu_pelanggan()
    else:
        print('pilihan tidak valid')
        time.sleep(0.5)
        dashboard_pelanggan()

def dashboard_tunggu_pelanggan():
    global status_driver_jalan
    status_driver_jalan = 0
    cs()
    print("=== Menu pelanggan ===")
    print('1. lihat status driver?')
    print('2. switch')
    pilih = input('Masukan pilihan anda :')
    if pilih == '1':
        status_driver()
    elif pilih == '2':
        dashboard_tunggu_driver()    
    else:
        print('pilihan tidak valid')
        time.sleep(0.5)
        dashboard_tunggu_pelanggan()

def status_driver():
    global status_driver_jalan
    global id_cek
    id = 0
    for i in range(len(order)):
        id = i + 1
    id_cek =  id-1
    cs()
    if status_driver_jalan == 'y':
        print('driver menuju ke lokasi anda')
        time.sleep(5)
        print('driver sudah sampai \ntemui driver anda!!')
        print('Nama driver anda adalah :', order[id_cek][0][1])
        time.sleep(5)
        print('sedang dalam perjalanan mengantar anda')
        time.sleep(5)
        print('sudah sampai tujuan!')
        time.sleep(2)
        transaksi_akhir()
    else:
        print('Driver belum otw!!')
        print('tunggu sebentar ya')
        pilih = input('tekan tombol apapun untuk kembali :')
        if pilih:
            dashboard_tunggu_pelanggan()


    
def transaksi_akhir():
    global status_driver_jalan
    cs()
    print("Nama pengguna    : ", order[id_order][1][1])
    print("uang kamu        :", data_pelanggan[4],'\n' ,"="*20)
    print('Nama driver      :', order[id_order][0][1])
    print("Kota awal kamu   : ",  order[id_order][2])
    print("Kota tujuan kamu : ",  order[id_order][3])
    print(f"Jarak           : {jarak:.2f} km")

    kode_promo = input("\nMasukkan kode promo (jika punya): ")
    diskon = promooooooo(kode_promo)
    if diskon > 0:
        diskon_rp = tarif * (diskon / 100)
        tarif_akhir = tarif - diskon_rp
        print(f"Diskon          : Rp{diskon_rp:.0f}")
        print(f"Tarif           : Rp{tarif_akhir:.0f}")
    else:
        print("Diskon          : Rp0")
        print(f"Tarif           : Rp{tarif:.0f}")
        tarif_akhir = tarif

    sisa_uang = data_pelanggan[4] - tarif_akhir
    print("Sisa uang kamu  : Rp", round(sisa_uang, 0))
    print("\nTerima kasih telah menggunakan layanan kami!")
    input("Tekan ENTER untuk keluar...")
    exit()
            

main()