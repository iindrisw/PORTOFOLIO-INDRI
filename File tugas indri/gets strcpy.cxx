#include <stdio.h>
#include <string.h>

int main()

{
	char Nama[20];
	char waktu[20];
	char kendaraan[20];
	char sholat[20];
	char ph[20];
	char aku[20];
	char bangun[20];
	char solat[20];
	char motor[20];
	char penilaian[20];
	printf("Tugas itk program dengan fungsi gets\n");
    printf("Nama: Indri setiawati \n");
    printf("kelas: XI MIPS 3 \n");
	printf("Nama saya :");
	gets(Nama);
	printf("saya bangun pukul : ");
	gets(waktu);
	printf("saya sholat: ");
	gets(sholat);
	printf("saya ke sekolah naik: ");
	gets(kendaraan);
	printf("saya melakukan penilaian harian pada matpel: ");
	gets(ph);
	
	printf("Tugas itk program dengan fungsi strcpy\n");
	strcpy(aku,"indri");
	printf("nama saya %s\n",aku);
	strcpy(bangun,"jam lima");
	printf("saya bangun %s \n",bangun);
	strcpy(solat,"subuh");
	printf("saya sholat %s\n",solat);
	strcpy(motor,"motor");
	printf("saya ke sekolah naik %s\n",motor);
	strcpy(penilaian,"pjok");
	printf("saya melakukan penilaian %s\n",penilaian);

}
