
	#include <stdio.h>
int main()
{
    printf("Indri setiawati\n");
 printf("XI MIPA 3\n");
 printf("\n----------------------------------------------------------------------\n");  
       printf("       SELAMAT DATANG DI RAMALAN ZODIAK MAMA JIDAN \n");  
   printf("----------------------------------------------------------------------\n");  
printf ("\n");

int no_bulan;
int i;

for ( i=1 ; i<=12 ; i++)
{
   printf("masukkan nomor bulan dulu guys (1-12)\n");
   scanf("%d" , &no_bulan);
   
   switch(no_bulan)
   {
   case 1 : printf(" hai anak januari\n ");
   printf("zodiakmu capricorn pasti suka makan mbek \n\n\n "); break;
   
   case 2 : printf(" hai anak februari \n");
   printf("zodiakmu aquarius pasti kamu suka makan sapi \n\n\n "); break;
   
   case 3 : printf(" hai anak maret\n");
   printf("zodiakmu pisces kamu tidak akan melarat \n\n\n"); break;
   
   case 4 : printf(" hai anak april\n");
   printf("zodiakmu aries pasti rupamu sangat menawan \n\n\n"); break;
   
      case 5 : printf(" hai anak mei\n");
   printf("zodiakmu taurus kamu akan menikah dengan chindo \n\n\n"); break;
   
      case 6 : printf(" hai anak juni\n");
   printf("zodiakmu gemini ada yg suka kamu loh \n\n\n"); break;
   
      case 7 : printf(" hai anak juli\n");
   printf("zodiakmu cancer kamu akan kejatuhan rizki yg berlimpah \n\n\n"); break;
   
      case 8 : printf(" hai anak agustus\n");
   printf("zodiakmu leo crush mu akan suka kamu balik loh \n\n\n"); break;
   
      case 9 : printf(" hai anak september\n");
   printf("zodiakmu virgo rupamu mirip athena waw \n\n\n"); break;
   
      case 10 : printf(" hai anak  oktober\n");
   printf("zodiakmu libra kamu akan mendapatkan keadilan dimanapun kamu berpijak \n\n\n"); break;
   
      case 11 : printf(" hai anak november\n");
   printf("zodiakmu  scorpio kamu akan selalu di berkahi atas segala kegiatan yg kamu lakukan \n\n\n"); break;
   
      case 12 : printf(" hai anak desember\n");
   printf("zodiakmu sagitarius kamu pasti akan selalu di manja oleh semua orang \n\n\n"); break;
   
               
}
}
   

}