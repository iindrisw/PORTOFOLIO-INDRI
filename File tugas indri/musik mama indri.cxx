#include <stdio.h>
int main()
{
    printf("Indri setiawati\n");
 printf("XI MIPA 3\n");
 printf("ABSEN 13 \n");
 printf("\n----------------------------------------------------------------------\n");  
       printf("                  SELAMAT MEMILIH MUSIK GUYS  \n");  
   printf("----------------------------------------------------------------------\n");  
printf ("\n");

int no_urutan;
int i;

for ( i=1 ; i<=12 ; i++)
{
   printf("\n");
   printf("Playlist mama indri \n");
	
	printf("JUDUL LAGU : \n");
	printf("1. Symphony No.40\n");
	printf("2. Moonlight Sonata\n");
	printf("3. Could It Be \n");
	printf("4. Pulang \n");
	printf("5. Kun anta \n");
	printf("6.Ya Nabi Salam Alayka  \n");
	printf("7. Old love\n");
	printf("8. If I Ain't Got You \n");
	printf("9. Jengah \n");
	printf("10. Garuda di dadaku\n");
	printf("11. Before you go\n");
	printf("12. If I Can't Have You\n");
	printf("\n");
   printf("pilih nomor lagu yang kamu sukai guys (1-12):  ");
   scanf("%d", &no_urutan);
   
   switch(no_urutan)
   {
   case 1 : printf(" Symphony No.40\n ");
   printf(" lagu ini bergenre  musik klasik karya Wolfgang Amadeus Mozart \n\n\n "); break;
   
   case 2 : printf(" Moonlight Sonata \n");
   printf("lagu ini bergenre  musik klasik karya Ludwig van Beethoven \n\n\n "); break;
   
   case 3 : printf(" Could It Be \n");
   printf("lagu ini bergenre  musik Jazz raisa yang nyanyi guys \n\n\n"); break;
   
   case 4 : printf(" Pulang \n");
   printf("lagu ini bergenre  musik Jazz Andien itu penyanyinya  \n\n\n"); break;
   
      case 5 : printf(" Kun anta\n");
   printf("Lagu ini bergenre musik religi by Humood Al Khuder\n\n\n"); break;
   
      case 6 : printf(" Ya Nabi Salam Alayka \n");
   printf("Lagu ini bergenre musik religi by Maher Zain  \n\n\n"); break;
   
      case 7 : printf(" Old love\n");
   printf("Lagu ini bergenre musik RnB by  Yuji and putri dahlia  \n\n\n"); break;
   
      case 8 : printf(" If I Ain't Got You \n");
   printf("Lagu ini bergenre musik RnB by  Alicia Keys \n\n\n"); break;
   
      case 9 : printf(" Jengah\n");
   printf("Lagu ini bergenre rock by pas band \n\n\n"); break;
   
      case 10 : printf(" Garuda di dadaku\n");
   printf("Lagu ini bergenre rock by Netral \n\n\n"); break;
   
      case 11 : printf(" Before you go\n");
   printf("lagu ini bergenre pop song by Lewis Capaldi\n\n\n"); break;
   
      case 12 : printf(" If I Can't Have You\n");
   printf("lagu ini bergenre pop song by Shawn Mendes\n\n\n"); break;
   
               
}
}
   

}