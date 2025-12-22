#include <stdio.h>
void buka()
{
 int hasil,menu,a,b,c;

 
printf ("silakan pilih menu untuk anda berbuka (1-3) :\n");
 printf("1. Kolak\n");
 printf("2. Es buah\n");
 printf("3. Risol\n");
  
 printf("Silakan pilih menu : ");
 scanf("%d",&menu);
 
 switch(menu){
 case 1 : printf("Kolak\n");break;
 case 2 : printf("Es buah\n");break;
 case 3 : printf("Risol\n");break;
 }
 void main()
 {
 	int i=1;
 	for (i=1;i<=3;i++)
 	{
 		menu();
 	}
}
}
