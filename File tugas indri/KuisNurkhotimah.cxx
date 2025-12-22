#include <iostream>
using namespace std;

bool cekGanjil(int bilangan) {
    return (bilangan % 2 != 0);
}

bool cekGenap(int bilangan) {
    return (bilangan % 2 == 0);
}

int pangkat4(int bilangan) {
    return bilangan * bilangan * bilangan * bilangan;
}

int fungsi(int x, int y, int z) {
    return (x * x) + (2 * y * z) + (3 * z * z);
}

int main() {
    int bilangan, x, y, z;
    bilangan = 7;
    cout << "Apakah " << bilangan << " ganjil? " << (cekGanjil(bilangan) ? "Ya" : "Tidak") << endl;
    bilangan = 8;
    cout << "Apakah " << bilangan << " genap? " << (cekGenap(bilangan) ? "Ya" : "Tidak") << endl;
    bilangan = 3;
    cout << "Hasil " << bilangan << " pangkat 4 adalah: " << pangkat4(bilangan) << endl; x = 1; y = 2; z = 3;
    cout << "Nilai f(" << x << ", " << y << ", " << z << ") = " << fungsi(x, y, z) << endl;

    return 0;
}