
#include<stdio.h>
int main(int argc, char *argv[])
{
	char kode;
	printf("Indri setiawati \n");
	printf("XI A3 \n");
	printf("\n");
	printf("masukan kode warna lampu (M/K/H): ");
	scanf("%c", &kode);
	if (kode=='M')
	{
		printf("berhenti");
	}
	else if (kode=='K')
	{
		printf("Hati hati");
	}
	else if (kode=='H')
	{
		printf("Jalan");
	}	

	else

	printf("kode warna salah");
}


