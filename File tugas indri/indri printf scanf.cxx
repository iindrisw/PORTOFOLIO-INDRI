#include<stdio.h>
int main(int argc, char *argv[])
{
	printf("INDRI SETIAWATI \n");
	printf("XII MIPA 3 \n");
	char nama[100];
	int nis;
	int nisn;
	char kelas[100];
	int no;
	int bb;
	int tb;
	char ttl[100];
	char alamat;
	printf("NIS: ");
	scanf("%i", &nis);
	printf("NISN: ");
	scanf("%i",&nisn);
	printf("Nama siswa: ");
	scanf("%s",&nama);
	printf("Kelas: ");
	scanf("%i",&kelas);
	printf("Tempat tanggal lahir: ");
	scanf("%s",&ttl);
	printf("Alamat: ");
	scanf("%s",&alamat);
	printf("No.telp: ");
	scanf("%i",&no);
	printf("Berat badan: ");
	scanf("%i",&bb);
	printf("Tinggi badan: ");
	scanf("%i",&tb);
	return 0;
}