#include<stdio.h>
#include<string.h>
struct data
{
	char nama[20];
	int umur;
	float tinggi;
};

int main(void)
{
	struct data siswa01, siswa02, siswa03;
	strcpy(siswa01.nama,"indri");
	siswa01.umur=16;
	siswa01.tinggi=170.5;
	printf("%s adalah siswa xi mipa 3 dengan usia %i tahun dan tinggi %.1lf cm \n",siswa01.nama,siswa01.umur,siswa01.tinggi);
	
	strcpy(siswa02.nama,"ratu");
	siswa02.umur=16;
	siswa02.tinggi=160.5;
	printf("%s adalah siswa xi mipa 3 dengan usia %i tahun dan tinggi %.1lf cm \n",siswa02.nama,siswa02.umur,siswa02.tinggi);

	strcpy(siswa03.nama,"widiya");
	siswa03.umur=15;
	siswa03.tinggi=140.5;
	printf("%s adalah siswa xi mipa 3 dengan usia %i tahun dan tinggi %.1lf cm \n",siswa03.nama,siswa03.umur,siswa03.tinggi);
}