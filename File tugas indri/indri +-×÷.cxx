#include<stdio.h>)
void namaku()
{
	printf("namaku indri \n");
}
void kelasku()
{
	printf("aku kelas mipa 3\n\n");
}

void tambah()
{
	int angka1,angka2;
	int i;
	
	{
	printf("\n\nmasukan angka 1: ");
	scanf("%i",&angka1);
	printf("masukan angka 2: ");
	scanf("%i",&angka2);
	printf("hasil  %i+%i =%i",angka1,angka2,angka1+angka2);
	}

}
void kurang()
{
	int angka1,angka2;
	int i;
	
	{
	printf("\n\nmasukan angka 1: ");
	scanf("%i",&angka1);
	printf("masukan angka 2: ");
	scanf("%i",&angka2);
	printf("hasil  %i-%i =%i",angka1,angka2,angka1-angka2);
	}

}
void kali()
{
	int angka1,angka2;
	int i;
	
	{
	printf("\n\nmasukan angka 1: ");
	scanf("%i",&angka1);
	printf("masukan angka 2: ");
	scanf("%i",&angka2);
	printf("hasil  %i×%i =%i",angka1,angka2,angka1*angka2);
	}

}
void bagi()
{
	int angka1,angka2;
	double x;
	
	{
	printf("\n\nmasukan angka 1: ");
	scanf("%i",&angka1);
	printf("masukan angka 2: ");
	scanf("%i",&angka2);
	x=angka1/angka2;
	printf("hasil  %i÷%i =%.2f",angka1,angka2,x);
	}

}
	void main()
	{
		namaku();
		kelasku();
	int i;	
for (i=1;i<=5;i++){
		tambah();
		kurang();
		kali();
		bagi();
}
	}
