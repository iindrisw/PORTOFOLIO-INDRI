#include<stdio.h>
int main(int argc, char *argv[])
{
	int no_menu;
	int jumlah;
    int harga;
    int totalharga;
    char mp[20];
    int totaluang;
    int kembalian;
    printf("INDRI SETIAWATI\n");
    printf("XI A3\n");
  
    

	printf("SELAMAT DATANG DI CAFE SEPTEMBER CERIA");
	printf("\n");
	printf("MENU ANDALAN: \n");
	printf("1. Burger itali\n");
	printf("2. Burger amerika\n");
	printf("3. Burger itali\n");
	printf("4. Burger itali\n");
	printf("5. Burger itali\n");
	
	printf("silahkan pilih nomor menu (1-5): ");
	scanf("%d",&no_menu);
	
		switch (no_menu)
	{
		case 1:printf("burger itali \n");
		break;
			case 2:printf("pizza \n");
		break;
			case 3:printf("kabobs \n");
		break;
			case 4:printf("spagethi \n");
		break;
			case 5:printf("fire chicken \n");
		break;
	}
printf("\n");
	printf("harga satuan: ");
	scanf("%i",&harga);
	
	
	printf("jumlah yang di pesan: ");
	scanf("%i",&jumlah);
	

	printf("total harga: %i*%i=%i \n", jumlah,harga,jumlah*harga );
	
	
	printf("metode pembayaran (cash/debit/credit): ");
	scanf("%s",&mp);
	

	printf("total uang yang di beri: ");
	scanf("%i",&totaluang);
	

printf("total kembalian: %i-%i=%i",totaluang,jumlah*harga,totaluang-jumlah*harga);
printf("\n");
printf("silahkan menunggu pesanan di meja yang di sediakan");
printf("TERIMA KASIH");
	
}