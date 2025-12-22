#include <iostream>
#include <string>
using namespace std;

struct pengunjung {
    string nama;
    long nik;
    string tanggal_pengembalian;
    string tanggal_peminjaman;
    string namabuku;
    string alamat;
    string pesan;
    string tanggal_penyaluran;
};

struct buku {
    string namap;
    int id;
    string judbuk;
    string sinopsis;
    int tahun;
    string penulis;
};

void bersihkan(){
    cout << "\033[2J\033[1;1H";
}

buku  data_buku [100];
int hitung = 0;

void fitur( ) {
    cout << "1. Tentang Perpustakaan" << endl;
    cout << "2. List Menu Buku" << endl;
    cout << "3. Donasi Buku" << endl;
    cout << "4. Peminjaman Buku" << endl;
    cout << "5. Pengembalian Buku" << endl;
    cout << "6. Pengaduan" << endl;
}

void buat_buku() {
    if (hitung < 100) {
        cout << "Masukkan Nama: ";
        getline(cin >> ws, data_buku [hitung].namap);
        cout << "Masukkan ID Buku: ";
        cin >> data_buku [hitung].id;
        cout << "Masukkan Judul Buku: ";
        getline(cin >> ws, data_buku [hitung].judbuk);
        cout << "Masukkan Sinopsis Buku: ";
        getline(cin >> ws, data_buku [hitung].sinopsis);
        cout << "Masukkan Tahun terbit Buku: ";
        cin >> data_buku [hitung].tahun;
        cout << "Masukkan Penulis Buku: ";
        getline(cin >> ws, data_buku [hitung].penulis);

        hitung++;
    }
    else {
        cout << "Data sudah penuh!" << endl;
    }
}

void tampil_data() {
    if (hitung == 0) {
        cout << "Data buku  belum tersedia." << endl;
    } else {
        for (int i = 0; i < hitung; i++) {
            cout << "ID Buku: " << data_buku [i].id << endl;
            cout << "Judul Buku: " << data_buku [i].judbuk << endl;
            cout << "Sinopsis Buku: " << data_buku [i].sinopsis << endl;
            cout << "Tahun terbit Buku: " << data_buku [i].tahun << endl;
            cout << "Penulis Buku: " << data_buku [i].penulis << endl;
        }
    }
}

void listbuk() {
    cout << "LIST MENU BUKU" << endl;
    cout << "1. Laskar Pelangi - Andrea Hirata" << endl;
    cout << "2. Sangat Aneh - Tere Liye" << endl;
    cout << "3. Antologi Rindu - Pidi Baiq" << endl;
    cout << "4. Hujan Bulan Juni - Sapardi Djoko Damono" << endl;
    cout << "5. Bumi Manusia - Pramoedya Ananta Toer" << endl;
    cout << "6. Dasar-Dasar Ilmu Pendidikan - Hasbullah" << endl;
    cout << "7. Manajemen Resiko Bisnis - Hery" << endl;
        cout << "8. Autobiografi Tan Malaka Dari Penjara ke Penjara - Tan Malaka" << endl;
    
}


int main() {
    int pilih, p;
    pengunjung data_pengunjung[8];
    
    char pesan;
    
    do {
        fitur();
        cout << "Silahkan Pilih fitur (1-6): ";
        cin >> pilih;

        if (pilih == 1) {
            bersihkan();
            cout << "TENTANG PERPUSTAKAAN" << endl;
            cout << "Selamat datang di Perpustakaan MPIS." << endl;
            cout << "Perpustakaan Ini didirikan tahun 2006" << endl;
            cout << "Nama MPIS mencerminkan nilai-nilai utama perpustakaan ini: Modern, Produktif, Inspiratif, Serbaguna, dan Santai" << endl;
            cout << "Perpustakaan ini berada di jalan Syekh Nurjati Desa Kubang" << endl;

        } else if (pilih == 2) {
            bersihkan();
            listbuk();
            for (int i = 0; i < hitung; i++) {
                cout << i + 9 << ". " << data_buku [i].judbuk << " - " << data_buku [i].penulis << endl;
            }

            cout << "Masukkan nomor urutan buku yang ingin dilihat: ";
            cin >> p;

            if (p < 1 ) {
                cout << "Masukkan nomor urutan buku dengan benar!" << endl;
                cout << "Masukkan nomor urutan buku yang ingin dilihat: ";
                cin >> p;
            }

            if (p == 1) {
                cout << "ID Buku: 111" << endl;
                cout << "Judul buku: Laskar Pelangi" << endl;
                cout << "Sinopsis buku: Sebuah novel yang menceritakan tentang sekelompok anak di Belitung dan perjuangan mereka mengejar pendidikan." << endl;
                cout << "Tahun rilis buku: 2005" << endl;
                cout << "Penulis buku: Andrea Hirata" << endl;
            } else if (p == 2) {
                cout << "ID Buku: 112" << endl;
                cout << "Judul buku: Sangat Aneh" << endl;
                cout << "Sinopsis buku: Novel yang mengangkat tema kehidupan dan berbagai pilihan yang dihadapi oleh karakter-karakternya." << endl;
                cout << "Tahun rilis buku: 2013" << endl;
                cout << "Penulis buku: Tere Liye" << endl;
            } else if (p == 3) {
                cout << "ID Buku: 103" << endl;
                cout << "Judul buku: Antologi Rindu" << endl;
                cout << "Sinopsis buku: Kumpulan puisi yang menyentuh tentang kerinduan dan cinta." << endl;
                cout << "Tahun rilis buku: 2017" << endl;
                cout << "Penulis buku: Pidi Baiq" << endl;
            } else if (p == 4) {
                cout << "ID Buku: 1104" << endl;
                cout << "Judul buku: Hujan Bulan Juni" << endl;
                cout << "Sinopsis buku: Novel yang memadukan puisi dan prosa dengan tema cinta yang mendalam." << endl;
                cout << "Tahun rilis buku: 1994" << endl;
                cout << "Penulis buku: Sapardi Djoko Damono" << endl;
            } else if (p == 5) {
                cout << "ID Buku: 1105" << endl;
                cout << "Judul buku: Bumi Manusia" << endl;
                cout << "Sinopsis buku: Sebuah novel yang merupakan bagian dari tetralogi Buru, menggambarkan kehidupan di Nusantara pada masa penjajahan Belanda." << endl;
                cout << "Tahun rilis buku: 1980" << endl;
                cout << "Penulis buku: Pramoedya Ananta Toer" << endl;
             }   else if (p == 6) {
                cout << "ID Buku: 2399" << endl;
                cout << "Judul buku: Dasar-Dasar Ilmu Pendidikan" << endl;
                cout << "Sinopsis buku:  Di dalam buku ini disajikan secara runtut mengenai faktor-faktor\n penentu dalam pendidikan, aliran-aliran pendidikan, konsep pendidikan seumur hidup, \nketerkaitan masyarakat dan pendidikan, inovasi pendidikan,\n demokrasi pendidikan, dan konsep-konsep pendidikan lainnya, \nserta ditutup dengan pendidikan karakter. Semuanya dituangkan\n dalam konsep-konsep yang bersifat teoritis dan praktik kependidikan." << endl;
                cout << "Tahun rilis buku: 2017" << endl;
                cout << "Penulis buku: Hasbullah" << endl;
            }
            else if (p == 7) {
                cout << "ID Buku: 2579" << endl;
                cout << "Judul buku: Manajemen Resiko Bisnis" << endl;
                cout << "Sinopsis buku:  Tujuan dari manajemen risiko adalah bukan \nuntuk menghilangkan risiko hingga nol namun lebih kepada mengelola risiko yang ada sehingga \ntidak menimbulkan masalah yang besar bagi perusahaan.\nSebuah novel yang merupakan bagian dari tetralogi Buru, menggambarkan\n kehidupan di Nusantara pada masa penjajahan Belanda." << endl;
                cout << "Tahun rilis buku: 2020" << endl;
                cout << "Penulis buku: Hery" << endl;
            }
            else if (p == 8) {
                cout << "ID Buku: 7857" << endl;
                cout << "Judul buku: Autobiografi Tan Malaka Dari Penjara ke Penjara" << endl;
                cout << "Sinopsis buku:  Meskipun tengah berada di balik jeruji, \nTan Malaka masih tetap berusaha untuk mendobrak semangat perjuangan rakyat Indonesia.\nBagi Tan Malaka, barang siapa yang ingin menikmati hakikat dari kemerdekaan\n secara utuh, maka ia pun harus ikhlas serta tulus untuk menjalani pahit \nserta getirnya hidup terpenjara." << endl;
                cout << "Tahun rilis buku: 1970" << endl;
                cout << "Penulis buku: Tan Malaka" << endl;
            }
            
            else if(p>8)
            {
            	tampil_data();
            }
        } else if (pilih == 3) {
            bersihkan();
            cout << "DONASI BUKU" << endl;
            buat_buku();
        } else if (pilih == 4) {
            bersihkan();
            listbuk();
            for (int i = 0; i < hitung; i++) {
                cout << i + 9 << ". "<< data_buku [i].judbuk << " - " << data_buku [i].penulis << endl;}
            cout << "PEMINJAMAN BUKU" << endl;
            cout << "Masukkan NIK Anda: ";
            cin >> data_pengunjung[1].nik;
            cout << "Masukkan Nama Anda: ";
            getline(cin >> ws, data_pengunjung[0].nama);
            cout << "Masukkan Alamat Anda: ";
            getline(cin >> ws, data_pengunjung[5].alamat);
            cout << "Masukkan Judul Buku: ";
            getline(cin >> ws, data_pengunjung[4].namabuku);
            cout << "Masukkan Tanggal Peminjaman (tanggal, bulan, tahun): ";
           getline(cin >> ws,data_pengunjung[3].tanggal_peminjaman);

            cout << "============================================================" << endl;
            cout << "###==              PERPUSTAKAAN MPISS             ===###" << endl;
            cout << "============================================================" << endl;
            cout << "NIK \t\t\t NAMA \t ALAMAT\tJUDUL BUKU   \t  TANGGAL PEMINJAMAN" << endl;
            cout << data_pengunjung[1].nik << "\t";
            cout << data_pengunjung[0].nama << "\t";
            cout << data_pengunjung[5].alamat << "\t";
            cout << data_pengunjung[4].namabuku << "\t\t";
            cout << data_pengunjung[3].tanggal_peminjaman << endl;
        } else if (pilih == 5) {
            bersihkan();
            cout << "PENGEMBALIAN BUKU" << endl;
            cout << "Masukkan NIK Anda: ";
            cin >> data_pengunjung[1].nik;
            cout << "Masukkan Nama Anda: ";
            getline(cin >> ws, data_pengunjung[0].nama);
            cout << "Masukkan Alamat Anda: ";
            getline(cin >> ws, data_pengunjung[5].alamat);
            cout << "Masukkan Tanggal Pengembalian :";
            getline(cin >> ws, data_pengunjung[2].tanggal_pengembalian);

            cout << "Terima kasih telah mengembalikan buku tepat waktu!" << endl;
        } else if (pilih == 6) {
            bersihkan();
            cout << "PENGADUAN" << endl;
            cout << "Masukkan Nama Anda: ";
            getline(cin >> ws, data_pengunjung[0].nama);
            
            getline(cin >> ws, data_pengunjung[6].pesan);
            cout << "Terima kasih atas pengaduan Anda!" << endl;
            cout << "============================================================" << endl;
            cout << "###==             FORM PENGADUAN          ===###" << endl;
            cout<<"Nama: " << data_pengunjung[0].nama<< endl;
            cout <<"Pesan:"<< data_pengunjung[6].pesan << endl;
            
            cout << "Silahkan masukkan pengaduan Anda: ";
        }
		cout<<endl;
        cout << "Ingin kembali lagi? (y/n): ";
        cin >> pesan;
    }while(pesan == 'y' || pesan == 'Y');
    
    	cout<<"thank you";
    

    return 0;
}