#include <iostream>

using namespace std;

int main(){
    // Deklarasi Variabel
    int golongan, hari_kerja;
    float gaji_pokok, lembur, pajak, total_penerimaan;
    gaji_pokok = 0;
    lembur = 0;
    pajak = 0;
    total_penerimaan = 0;

    // Input
    cout << "Golongan   : ";
    cin >> golongan;
    cout << "Hari Kerja : ";
    cin >> hari_kerja;

    // Hitung
    // hitung gaji pokok
    if (golongan == 1){
        gaji_pokok = 1500000;
    }
    else if(golongan == 2){
        gaji_pokok = 2000000;
    }
    else if(golongan == 3){
        gaji_pokok = 3000000;
    }
    else{
        cout << "Tidak ada golongan tersebut.";
        return 1;
    }

    // hitung lembur
    lembur = (hari_kerja - 20) * 200000;

    // hitung pajak
    if( (gaji_pokok + lembur) > 4000000 ){
        pajak = (gaji_pokok + lembur) * 5 / 100;
    }

    // hitung total penerimaan
    total_penerimaan = gaji_pokok + lembur - pajak;


    // Output
    cout << fixed;
    cout << "Gaji Pokok       : " << gaji_pokok << endl;
    cout << "Lembur           : " << lembur << endl;
    cout << "Pajak            : " << pajak << endl;
    cout << "Total Penerimaan : " << total_penerimaan << endl;

    return 0;
}