
#include<stdio.h>

int main()
{
	int i,harga,PPN,kode,total;
	char kelas,nambah; 
	
	printf("\n                            INDONESIA AIRLINES                                 \n");
	printf("\nreservasi tiket pesawat");
	
	printf("\n===========================================================================\n");
	printf("Tujuan Anda                 Kelas          Kelas        Kelas        jam keberangkatan\n");
	printf("                           Ekonomi(E)     Bisnis(B)    Eksekutif (X)\n");
	printf("===========================================================================\n");
	printf("1.Yogyakarta               Rp.125.000    Rp.500.000    Rp.700.000      21.00\n");
	printf("2.Malaysia                 Rp.250.000    Rp.750.000    Rp.1.200.000    13.00\n");
	printf("3.Singapura                Rp.450.000    Rp.1.200.000  Rp.1.700.000    15.40\n");
	printf("4.Jepang                   Rp.1.250.000  Rp.2.300.000  Rp.3.100.000    22.00\n");
	printf("===========================================================================\n");
	
	for (i=1;i<=100;i++)
	{
	printf("\nPilih tujuan anda (1/2/3/4): ");
	scanf("%d",&kode);
	
	switch(kode)
	{
		case 1: {
					printf("Tujuan Anda : Yogyakarta\n");
					printf("\n-----------Silahkan Pilih Kelas Pesawat---------\n");
					printf("Masukkan Kode Kelas (E/B/X): ");
					scanf("%s",&kelas);
					if(kelas=='E' || kelas=='e')
					{
						harga=125000;
						PPN=0;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp. %d",harga);
						printf("\nPPN: Rp. %d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);	
					}
					else if(kelas=='B' || kelas=='b')
					{
						harga=500000;
						PPN=0;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp.%d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);
					}
					else if(kelas=='X' || kelas=='x')
					{
						harga=700000;
						PPN=0;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp.%d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);
					}		
			break;
		}
		case 2: 
			{printf("Tujuan Anda : Malaysia\n");
					printf("\n-------------Silahkan Pilih Kelas Pesawat-----------\n");
					printf("Masukkan Kode Kelas (E/B/X): ");
					scanf("%s",&kelas);
					if(kelas=='E' || kelas=='e')
					{
						harga=250000;
						PPN=550;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp. %d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);	
					}
					else if(kelas=='B' || kelas=='b')
					{
						harga=750000;
						PPN=1500;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp.%d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);
					}
					else if(kelas=='X' || kelas=='x')
					{
						harga=1200000;
						PPN=5000;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp.%d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);
					}
			
			break;
		}
		case 3: 
			{printf("Tujuan Anda : Singapura\n");
					printf("\n-------------Silahkan Pilih Kelas Pesawat-----------\n");
					printf("Masukkan Kode Kelas (E/B/X): ");
					scanf("%s",&kelas);
					if(kelas=='E' || kelas=='e')
					{
						harga=450000;
						PPN=1000;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp. %d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);	
					}
					else if(kelas=='B' || kelas=='b')
					{
						harga=1200000;
						PPN=2000;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp.%d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);
					}
					else if(kelas=='X' || kelas=='x')
					{
						harga=1700000;
						PPN=5000;
						total=harga-PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp.%d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);
					}
			break;
		}
		case 4:
			{printf("Tujuan Anda : Jepang\n");
					printf("\n-------------Silahkan Pilih Kelas Pesawat-----------\n");
					printf("Masukkan Kode Kelas (E/B/X): ");
					scanf("%s",&kelas);
					if(kelas=='E' || kelas=='e')
					{
						harga=1250000;
						PPN=1000;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp. %d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);	
					}
					else if(kelas=='B' || kelas=='b')
					{
						harga=2300000;
						PPN=6000;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp.%d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);
					}
					else if(kelas=='X' || kelas=='x')
					{
						harga=3100000;
						PPN=10000;
						total=harga+PPN;
						printf("\nHarga Tiket : Rp.%d",harga);
						printf("\nPPN: Rp.%d",PPN);
						printf("\nTotal pembayaran : Rp.%d",total);
					}
			break;
		}
		default:
			printf("Maaf, Anda Salah Memasukkan Kode");
	}
			
			
		char kereta,jadwal;
{ printf("\n\n____________________________________________________________\n\nTIKET KERETA\n____________________________________________________________\n\nTanggal : 30/06/2036\n");
  switch (kereta)
  {
case 1 : printf("Nama Kereta : Sriwijaya\nKeberangkatan : Cirebon-Bandung\n");
  	switch (kelas)
  	{case 1 : printf("Kelas : Eksekutif\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 08.00\n");break;
  	    case 2 : printf("Waktu : 15.00\n");}break;
  	case 2 : printf("Kelas : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 18.00\n");break;
  	    case 2 : printf("Waktu : 10.00\n");}}break;
  	        
case 2 : printf("Nama Kereta : Utomo\nKeberangkatan : Cirebon-Jakarta\n");
  	switch (kelas)
  	{case 1 : printf("Kelas : Eksekutif\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 09.00\n");break;
  	    case 2 : printf("Waktu : 17.00\n");}break;
  	case 2 : printf("Kelas : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 10.00\n");break;
  	    case 2 : printf("Waktu : 22.00\n");}}break;
  	    
case 3 : printf("Nama Kereta : Dwipanggi\nKeberangkatan : Cirebon-Banten\n");
  	switch (kelas)
  	{case 1 : printf("Kelas : Eksekutif\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 10.00\n");break;
  	    case 2 : printf("Waktu : 13.00\n");}break;
  	case 2 : printf("Kelas : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 09.00\n");break;
  	    case 2 : printf("Waktu : 20.00\n");}}break;
  	    
case 4 : printf("Nama Kereta : Tsaka\nKeberangkatan : Cirebon-Bogor\n");
  	switch (kelas)
  	{case 1 : printf("Kelas : Eksekutif\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 11.00\n");break;
  	    case 2 : printf("Waktu : 20.00\n");}break;
  	case 2 : printf("Kelas : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 16.00\n");break;
  	    case 2 : printf("Waktu : 23.00\n");}}break;
  	    
case 5 : printf("Nama Kereta : Gayajana\nKeberangkatan : Cirebon-Bekasi\n");
  	switch (kelas)
  	{case 1 : printf("Kelas : Eksekutif\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 12.00\n");break;
  	    case 2 : printf("Waktu : 22.00\n");}break;
  	case 2 : printf("Kelas : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 14.00\n");break;
  	    case 2 : printf("Waktu : 23.00\n");}}break;
  	 }
  
  printf("\nSelamat menempuh perjalanan dengan kereta pilihan anda.\n____________________________________________________________\n\n");
  
}
}
}
	

	
	
