#include<stdio.h>)
void namaku()
{
	printf("namaku indri \n\n");
}
void kelasku()
{
	printf("aku kelas mipa 3\n");
}
void inputtahun()
{
	int tahun;
	int i;
	for (i=1;i<=2;i++){
	{
		printf(" masukan tahun: ");
		scanf("%i",&tahun);
	}
	
	if (tahun%4==0)
	{
		printf("%i adalah tahun kabisat\n",tahun);
	}
	else
	{
		printf("%i bukan tahun kabisat\n",tahun);
	}
	
}
}
void main()
{
	namaku();
	kelasku();
	inputtahun();
}
