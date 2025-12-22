
#include<stdio.h>
#include<string.h>
int main()
{
	int tiket,jml,harga,total,byr,kembalian;
	int i,h,angkakursi[50];
	int film,jam;
	float kembalian2,bayar,totalharga,hargatiket=25000;
	float jamx[6]={11.30,12.55,14.20,16.10,19.10,20.45};
	float jamy[6]={11.45,13.00,15.30,17.20,19.15,21.00};
	char cetak,pesan;
	char jud[5][50]={"Erorr","JUMANJI","XXX\t","FROZEN 2","KUNTI 2"},hurufkursi[20][50];
	kembali:
		printf("======================================================================\n");
		printf("\t\t\t Pesawat Lion Air\n");
		printf("\t\t  Kec. Pauh, Kota Padang,Sumatera Barat\n");
		printf("======================================================================\n");
		printf("\t\t\t JADWAL PENERBANGAN PESAWAT\n");
		printf("--------------------------------------------------------------------");
		printf("|\t |\t\t|\t\t\tJam\t\t\t|\n");
		printf("| No |  Tujuan\t|-----------------------------------------------|\n");
		printf("|  \t\t\t|   1   |   2   |   3   |   4   |   5   |   6   |\n");
		printf("|------------------------|----------------------------------------------|\n");
		printf("|    1   | Ambon\t| 01.00 | 03.45 | 06.00 | 07.15 | 09.30 | 12.00 |\n");
		printf("|    2   | Aceh\t\t| 11.45 | 13.00 | 15.30 | 17.20 | 19.15 | 21.00 |\n");
		printf("|    3   | Jambi\t| 11.45 | 13.00 | 15.30 | 17.20 | 19.15 | 21.00 |\n");
		printf("|    4   | Jakarta\t| 11.30 | 12.55 | 14.20 | 16.10 | 19.10 | 20.45 |\n");
		printf(" ---------------------- -------------------------------------------------- \n\n");
		printf(" Harga Tiket\n 1. Senin-Kamis\tRp.25.000\n 2. Jum'at\tRp. 30.000\n 3. Sabtu-Minggu\tRp. 35.000\n\n");
		printf("===============================================================================\n");
		printf("Sekarang hari Selasa\n");
		printf("Harga tiket : Rp. %.0f\n",hargatiket);
		printf("Pilih Film(1-4) : ");
		scanf("%d",&film);
		printf("Pilih Jam Ke(0-6): ");
		scanf("%d",&jam);
		printf("film %s\n",jud[film]);
		if (film==1 | film==4)
		{
			printf("Jam %.2f\n",jamx[jam]);
		}
		else if(film==2 | film==3)
		{
			printf("Jam %.2f\n",jamy[jam]);
		}
		printf("Jumlah tiket yang ingin dibeli : ");
		scanf("%d",&tiket);
		for(h=0;h<tiket;h++)
		{
			printf("Pilih seat(A-J) :\n ");
			scanf("%s",&hurufkursi);
			printf(" Pilih nomor kursi :\n ");
			scanf("%d",&angkakursi);
		}
		printf("Jumlah pesanan :  %d\n",tiket);
		printf("------------------------------------\n");
		printf("| N0 |\tFilm\t| Kursi | Harga  |\n");
		printf("------------------------------------\n");
		for(i=0;i<tiket;i++)
		{
			printf("|  %d  |%s\t|  %s%d  | %.3f  |\n",i+1,jud[film],hurufkursi[i],angkakursi[i],hargatiket,tiket);
		}
		printf("---------------------------------\n");
		totalharga=hargatiket*tiket;
		printf("Total harga\t\tRp %.0f\n",totalharga);
		printf("Bayar\t\t\tRp. ");
		scanf("%f",&bayar);
		kembalian2=bayar-totalharga;
		printf("\t\t\t__________\n\n");
		printf("Kembalian\t\tRp %.0f\n ",kembalian2);
		printf("Cetak Tiket (Y/N) ?");
		scanf("%s",&cetak);
		if (cetak=='y' | cetak=='Y')
		{
			for (i=0;i<tiket;i++)
			{
				printf("------------------------------------\n");
				printf("|\tBioskop Andilan\t\t|\n");
				printf("------------------------------------\n");
				printf("| %s\t\t\t|\n",jud[film]);
				printf("| Date : Selasa, 24-Des\t\t|\n");
				printf("| Time : %.2f\t\t\t|\n",jamy[jam]);
				printf("| Row  : %s  Seat : %d\t\t|\n",hurufkursi[i],angkakursi[i]);
				printf("| Price: 25.000  CASH\t\t|\n\n");
				printf("------------------------------------\n\n");
			}
			printf("Ingin memesan lagi(Y,N)?");
			scanf("%s",&pesan);
			if(pesan=='y' |pesan=='Y')
			{
				goto kembali;
			}
			else if(pesan=='n' |pesan=='N')
			{
				goto selesai;
			}
			else if(cetak=='n' |cetak=='N')
			{
				printf("Ingin memesan lagi(Y,N)");
				if(pesan=='y'|pesan=='Y')
				{
					goto kembali;
				}
				else if(pesan=='n'|pesan=='N')
				{
					goto selesai;
				}
				selesai:
					printf("Terimakasih telah membeli tiket bioskop kami\n Selamat menonton...");
					return 0;
	}	}	}