#include <stdio.h>
void datasiswa();
void databarang();
void tampilkan_data_siswa();
void tampilkan_data_barang();

int main() {
int menu;
do {
printf("Aplikasi DATA BARANG\n");
printf("1. INPUT DATA SISWA\n");
printf("2. INPUT DATA BARANG\n");
printf("3. TAMPILKAN DATA SISWA \n");
printf("4. TAMPILKAN DATA BARANG\n");
printf("5. Keluar\n");
printf("========================\n");
printf("Pilih Menu: "); scanf("%d", &menu);
printf("\n");

switch(menu) {
case 1:
datasiswa();
break;

case 2:
databarang();
break;

case 3:
tampilkan_data_siswa();
break;

case 4:
tampilkan_data_barang();
break;
	
case 5:
break;
}
} while (menu != 5);
return 0;
}

void datasiswa() {
char nama[100],barang[100];
int menu,nis,kode;
printf("INPUT DATA SISWA\n\n");
printf("Nama siswa\t: ");
scanf("%s",&nama);
printf("NIS\t\t: ");
scanf("%i",&nis);
printf("\n========================\n\n");
}

float fungsi_p(float harga, float disc) 
{ 
float total; 
total= harga*(harga * disc); 
}


void databarang() {
char nama[100],barang[100];
int menu,nis,kode;
float harga, disc, total;
printf("INPUT DATA BARANG\n\n");
printf("Kode barang\t\t:");
scanf("%i",&kode);
printf("Nama barang\t\t: ");
scanf("%s",&barang);
printf("Masukan Harga awal\t: "); 
scanf("%f",&harga);
printf("Diskon Harga\t\t: "); 
scanf("%f",&disc);
total=harga-(harga*disc/100);
printf("\nMaka Harga barang total adalah %.0f",total);
printf("\n========================\n\n");
}

void tampilkan_data_siswa() {
char nama[100],barang[100];
int menu,nis,kode;
printf("TAMPILKAN DATA SISWA \n\n");
printf("Nama siswa\t: %s\nNIS\t\t: %i",nama,nis);
printf("\n========================\n\n");
}

void tampilkan_data_barang() {
char nama[100],barang[100];
int menu,nis,kode;
printf("TAMPILKAN DATA BARANG\n\n");
printf("Kode barang\t: %i\nNama barang\t: %s",kode,barang);
printf("\n========================\n\n");
}