
	#include<stdio.h>

	int main()
	{
		char nama[30];
		int usia;
		char tempat_tinggal[30];
		char tempat_kuliah[30];
		char program_studi[30];
		
		printf("Indri setiawati \n");
		printf("kelas XI A3\n");
		printf("Absen 13\n");
		printf("-----------------------------------------------------------------\n");
		printf("-----------------------------------------------------------------\n");
		printf("\n");
		
		printf("halo, siapa nama mu : ");
		scanf("%s",&nama);
		printf("berapa usia mu : ");
		scanf("%d",&usia);
		printf("dimanakah tempat tinggal mu : ");
		scanf("%s",&tempat_tinggal);
		printf("dimanakah tempat kuliah mu : ");
		scanf("%s",&tempat_kuliah);
		printf("program studi mu apa : ");
		scanf("%s ",&program_studi);
		printf("\n");
		printf("-----------------------------------------------------------------\n");
		printf("-----------------------------------------------------------------\n");
		
		printf("halo %s senang berteman denganmu, usiamu sekarang sudah %d tahun ya? makin keren aja kamu, apalagi kamu sekarang kuliah di %s di program studi %s,rumah kamu di %s kan? kapan-kapan kita pergi sama-sama ya ke kampus? aku juga mahasiswa kampus %s",nama,usia,tempat_kuliah,program_studi,tempat_tinggal,tempat_kuliah);
	}
