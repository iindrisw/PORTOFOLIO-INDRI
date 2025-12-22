#include<stdio.h>
int main(int argc, char *argv[])
{
	int nilai;
	printf("Indri setiawati \n");
	printf("XI A3 \n");
	printf("\n");
	
	printf("masukan nilai (>90/>85/<85): ");
	scanf("%i", &nilai);
	if (nilai>90)
	{
		printf("amat baik");
	}
	else if (nilai>85)
	{
		printf("Baik");
	}
	else if (nilai<=85)
	{
		printf("remedial");
	}	



}