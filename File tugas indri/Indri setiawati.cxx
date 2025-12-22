#include<stdio.h>
int main(int argc, char *argv[])
{
	printf("Nama: Indri setiawati \n");
	printf("kelas: Xi mipa 3 \n");
	printf("\n");
	printf("kelipatan dua");

	int kelipatan_dua[5]={2,4,6,8,10};
	printf("kelipatan dua pertama %d \n",kelipatan_dua[0]);    
	printf("kelipatan dua kedua %d\n",kelipatan_dua[1]);     
	printf("kelipatan dua ketiga %d \n",kelipatan_dua[2]);       
	 printf("kelipatan dua keempat %d\n",kelipatan_dua[3]);    
	printf("kelipatan dua kelima %d \n",kelipatan_dua[4]);       
	printf("cetak semua elemen %d,%d,%d,%d,%d \n",kelipatan_dua [0],kelipatan_dua [1],kelipatan_dua [2],kelipatan_dua [3],kelipatan_dua [4]);    
	
	printf("\n");
	printf("ipk");
	printf("\n");

	float ipk[5]={2.3,4.0,3.6,2.8,1.0};
	printf("ipk pertama %.1f \n",ipk[0]);    
	printf("ipk kedua%.1f\n",ipk[1]);     
	printf("ipk ketiga %.1f \n",ipk[2]);       
	 printf("ipk keempat %.1f \n",ipk[3]);    
	printf("ipkdua kelima %.1f  \n",ipk[4]);       
	printf("cetak semua elemen %.1f,%.1f,%.1f,%.1f,%.,%.1f \n",ipk[0],ipk [1],ipk[2],ipk [3],ipk[4]);    
}