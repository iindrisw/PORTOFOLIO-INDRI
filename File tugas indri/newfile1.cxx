#include <stdio.h>
 
int main()
{
	int x,y,hasil1,hasil2,hasil3,hasil4;
	
	printf("Program Kalkulator Sederhana\n");
	printf("Angka 1 : ");
	scanf("%d",&x);
	printf("Angka 2 : ");
	scanf("%d",&y);
	
	hasil1=x + y;
	printf("Hasil:  ");
	printf("%i", x);
printf("+");
printf("%i",y);
printf(" = %d\n",hasil1);
	hasil2=x-y;
	printf("Hasil: ");
	 printf("%i", x);
printf("-");
printf("%i",y); 
printf(" = %d\n",hasil2);
	hasil3=x*y;
	printf("Hasil:  ");
	printf("%i", x);
printf("×");
printf("%i",y);
printf(" = %d\n",hasil3);
	hasil4=x/y;
	printf("Hasil:  ");
	printf("%i", x);
printf(":");
printf("%i",y);
printf(" = %d\n",hasil4);
	
	return 0;
	
}
