#include <stdio.h>
int main()
{
printf("=========================================================================\n \t\t\t\t\t\tBANDARA 13 \n=========================================================================\nNo| Maskapai  |  Tujuan |   Kelas     | Jadwal | Tarif\n-------------------------------------------------------------------------\n1 | Lion Air  | Padang  | First class | 08.30  | 900000\n  |           |         |             | 15.00  | 900000\n  |           |         | Bisnis      | 18.20  | 800000\n  |           |         |             | 10.00  | 800000\n  |           |         | Ekonomi     | 10.45  | 650000\n  |           |         |             | 19.45  | 650000\n2 | Batik Air | Malang  | First class | 09.00  | 800000\n  |           |         |             | 18.00  | 800000\n  |           |         | Bisnis      | 10.00  | 750000\n  |           |         |             | 22.00  | 750000\n  |           |         | Ekonomi     | 23.45  | 700000\n  |           |         |             | 11.30  | 700000\n3 | Citilink  | Lombok  | First class | 09.30  | 900000\n  |           |         |             | 15.00  | 900000\n  |           |         | Bisnis      | 10.00  | 800000\n  |           |         |             | 18.20  | 800000\n  |           |         | Ekonomi     | 10.00  | 750000\n  |           |         |             | 19.45  | 750000\n4 | Air Asia  | Bali    | First class | 07.30  | 900000\n  |           |         |             | 16.00  | 900000\n  |           |         | Bisnis      | 18.20  | 870000\n  |           |         |             | 20.20  | 870000\n  |           |         | Ekonomi     | 16.45  | 800000\n  |           |         |             | 23.15  | 800000\n5 | Wings Air | Blora   | First class | 05.30  | 800000\n  |           |         |             | 12.15  | 800000\n  |           |         | Bisnis      | 10.15  | 750000\n  |           |         |             | 17.50  | 750000\n  |           |         | Ekonomi     | 11.00  | 650000\n  |           |         |             | 13.45  | 650000\n  \n=========================================================================\n");
	int kelas,jadwal,jad,bayar,pes,lafc=900000,lae=650000,lab=800000,bafc=800000,bae=600000,bab=750000,cifc=900000,cie=800000,cib=650000,aafc=900000,aae=800000,aab=870000,wafc=850000,wab=750000,wae=650000;
	printf("\n\n");
	printf("Silahkan pilih nomor Maskapai penerbangan (1-5) : ");
	scanf("%i",&pes);	printf("----------------------------------------\n");

switch (pes)
{		
case 1 : printf("Maskapai : Lion air\n----------------------------------------\nTujuan padang\n----------------------------------------\n1) First class\n2) Bisnis\n3) Ekonomi\nSilahkan pilih kelas penerbangan (1/2/3) : ");
scanf("%i",&kelas);		printf("----------------------------------------\n");
	switch (kelas)
    {   	
		case 1 : 	    
		printf("Kelas           : First class\nTarif per-tiket : %i\n",lafc);	printf("----------------------------------------\n1) 08.30\n2) 15.00\nSilahkan  pilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("------------------------------\nJadwal Keberangkatan : 08.30\n");break;
			case 2 : printf("------------------------------\nJadwal Keberangkatan : 15.00\n");	
		}
printf("------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",lafc,jad,lafc*jad);	printf("\n----------------------------------------\n Anda harus membayar sejumlah yang tertera ");

;break;
	
		case 2 : 	    
		printf("Kelas           : Bisnis \nTarif per-tiket : %i\n",lab);	printf("-----------------------------\n1) 10.00\n2) 18.20\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("------------------------------\nJadwal Keberangkatan : 10.00\n");break;
			case 2 : printf("------------------------------\nJadwal Keberangkatan : 18.20\n");break;
			default : printf ("------------------------------------------------------------\nMaaf, jadwal keberangkatan tersebut tidak tersedia. Silakan masukkan jadwal keberangkatan dengan  benar\n");break;
		}
printf("------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",lab,jad,lab*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;
	case 3 : 	    
		printf("Kelas           : Ekonomi \nTarif per-tiket : %i\n",lae);	printf("----------------------------------------\n1) 10.45\n2) 19.45\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 10.45\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 19.45\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang benar\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",lae,jad,lae*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");
	};break;

case 2 : printf("Maskapai : Batik air\n--------------------\nTujuan   : Malang \n--------------------\n1) First class \n2) Bisnis\n3) Ekonomi\nPilih kelas (1/2/3) : ");
scanf("%i",&kelas);		printf("----------------------------------------\n");
	switch (kelas)
    {   	
		case 1 : 	    
		printf("Kelas           : First class\nTarif per-tiket : %i\n",bafc);	printf("------------------------------\n1) 09.00\n2) 18.00\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 09.00\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 18.00\n");break;
			default : printf ("-------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang tersedia\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",bafc,jad,bafc*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");;break;
case 2 : 	    
		printf("Kelas : Bisnis\nTarif per-tiket : %i\n",bab);	printf("----------------------------------------\n1) 10.00\n2) 22.00\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 10.00\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 22.00\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang tersedia\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",bab,jad,bab*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;
		case 3 : 	    
		printf("Kelas           : Ekonomi\n----------------------------------------\nTarif per-tiket : %i\n",bae);	printf("----------------------------------------\n1) 11.30\n2) 23.45\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan  : 11.30\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan  : 23.45\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang benar\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",bae,jad,bae*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;}break;

case 3 : printf("Maskapai  : Citilink\n----------------------------------------\nTujuan : Lombok \n----------------------------------------\n1) First class\n2) Bisnis\n)3 Ekonomi\nPilih kelas (1/2/3) : ");
scanf("%i",&kelas);		printf("----------------------------------------\n");
	switch (kelas)
    {   	
		case 1 : 	    
		printf("Kelas : First class\n----------------------------------------\nTarif per-tiket : %i\n",cifc);	printf("----------------------------------------\n1) 09.30\n2) 15.00\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 09.30\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 15.00\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang tersedia\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",cifc,jad,cifc*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;	
	case 2 : 	    
		printf("Kelas : Bisnis ----------------------------------------\nTarif per-tiket : %i\n",cib);	printf("----------------------------------------\n1) 18.20\n2) 10.00\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 18.20\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 10.00\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal keberangkatan tersebut tidak tersedia. Silakan masukkan jadwal keberangkatan dengan benar\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",cib,jad,cib*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;
		case 3 : 	    
		printf("Kelas : Ekonomi\n----------------------------------------\nTarif per-tiket : %i\n",cie);	printf("----------------------------------------\n1) 10.00\n2) 19.45\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 10.00\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 19.45\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang benar\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",cie,jad,cie*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;}
break;

case 4 : printf("Maskapai : Air Asia\n----------------------------------------\nTujuan   : Bali\n----------------------------------------\n\n1) First class\n2) Bisnis\n3) Ekonomi\nSilahkan pilih kelas penerbangan :  ");
scanf("%i",&kelas);		printf("----------------------------------------\n");
	switch (kelas)
    {   	
		case 1 : 	    
		 printf("Kelas : First class\n----------------------------------------/nTarif per-tiket : %i\n",aafc);	printf("----------------------------------------\n1) 07.30\n2) 16.00\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 07.30\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 16.00\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang tersedia\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",aafc,jad,aafc*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;
        case 2 : 	    
		printf("Kelas : Bisnis \n----------------------------------------\nTarif per-tiket : %i\n",aab);	printf("----------------------------------------\n1) 18.20\n2) 20.20\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 18.20\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 20.20\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang tersedia\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",aab,jad,aab*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;
		case 3 : 	    
		printf("Kelas : Ekonomi\n----------------------------------------\nTarif per-tiket : %i\n",aae);	printf("----------------------------------------\n1) 16.45\n2) 23.15\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 16.45\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 23.15\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang benar\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",aae,jad,aae*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;}break;


case 5 : printf("Maskapai : Wings Air\n----------------------------------------\n Tujuan: Blora\n----------------------------------------\n1) First class\n2) Bisnis\n3) Ekonomi\nPilih kelas (1/2/3) : ");
scanf("%i",&kelas);		printf("----------------------------------------\n");
	switch (kelas)
    {   	
		case 1 : 	    
		printf("Kelas : First class\n----------------------------------------\nTarif per-tiket : %i\n",wafc);	printf("----------------------------------------\n1) 05.30\n2) 12.15\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 05.30\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 12.15\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang tersedia\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",wafc,jad,wafc*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;
	case 2 : 	    
		printf("Kelas : Bisnis\nTarif per-tiket : %i\n",wab);	printf("----------------------------------------\n1) 10.15\n2) 17.50\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 10.15\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 17.50\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang tersedia\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",wafc,jad,wab*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;
	case 3 : 	    
		printf("Kelas : Ekonomi\n----------------------------------------\nTarif per-tiket : %i\n",wae);	printf("----------------------------------------\n1) 11.00\n2) 13.45\nPilih jadwal keberangkatan (1/2) : ");
		scanf("%i",&jadwal);
		switch(jadwal)
		{
			case 1 : printf("----------------------------------------\nJadwal Keberangkatan : 11.00\n");break;
			case 2 : printf("----------------------------------------\nJadwal Keberangkatan : 13.45\n");break;
			default : printf ("----------------------------------------\nMaaf, jadwal tersebut tidak tersedia. Silakan masukkan waktu yang tersedia\n");break;
		}
printf("----------------------------------------\nJumlah tiket yang di pesan : ");
scanf("%i",&jad);	printf("----------------------------------------\nTotal Harga Tiket : %i × %i = %i",wae,jad,wae*jad);	printf("\n----------------------------------------\nAnda harus membayar sejumlah yang tertera ");	;break;

    default : printf ("Maaf,nomor kelas penerbangan tersebut tidak tersedia. Silakan masukkan nomor kelas penerbangan dengan benar \n");
    };break;
 default : printf ("Maaf, nomor Maskapai tersebut tidak tersedia. Silakan masukkan nomor Maskapai dengan benar \n");	
    
  }		

int i;
for ( i=1 ; i<=jad ; i++)
{ printf("\n\n__________________________________________________________\n\n\t\tRESERVASI TIKET PESAWAT\n__________________________________________________________\n\nTanggal : 25/11/2023\n");
  switch (pes)
  {
case 1 : printf("Maskapai: Lion Air\nTujuan  : Padang\n");
  	switch (kelas)
  	{case 1 : printf("Kelas   : First class\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu   : 08.30\n");break;
  	    case 2 : printf("Waktu    : 15.00\n");}break;
  	 case 2 : printf("Kelas   : Bisnis\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu   : 18.20\n");break;
  	    case 2 : printf("Waktu  : 10.00\n");}break;
  	case 3 : printf("Kelas : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 10.45\n");break;
  	    case 2 : printf("Waktu : 19.45\n");}}break;
  	        
case 2 : printf("Maskapai: Batik Air\nTujuan  : Malang\n");
  	switch (kelas)
  	{case 1 : printf("Kelas   : First class\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu   : 09.00\n");break;
  	    case 2 : printf("Waktu   : 18.00\n");}break;
    case 2 : printf("Kelas     : Bisnis\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu   : 10.00\n");break;
  	    case 2 : printf("Waktu   : 22.00\n");}break;
  	case 3 : printf("Kelas   : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu   : 11.30\n");break;
  	    case 2 : printf("Waktu  : 23.45\n");}}break;
  	    
case 3 : printf("Maskapai : Citilink\nTujuan : Lombok\n");
  	switch (kelas)
  	{case 1 : printf("Kelas  : First class\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 09.30\n");break;
  	    case 2 : printf("Waktu : 15.00\n");}break;
  	 case 2 : printf("Kelas : Bisnis\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 10.00\n");break;
  	    case 2 : printf("Waktu : 18.20\n");}break;
  	case 3 : printf("Kelas : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 10.00\n");break;
  	    case 2 : printf("Waktu : 19.45\n");}}break;
  	    
case 4 : printf("Maskapai : Air Asia\nTujuan : Bangkok\n");
  	switch (kelas)
  	{case 1 : printf("Kelas : First class\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 07.30\n");break;
  	    case 2 : printf("Waktu : 16.00\n");}break;
  	 case 2 : printf("Kelas : Bisnis\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 18.20\n");break;
  	    case 2 : printf("Waktu : 20.20\n");}break;
  	case 3 : printf("Kelas : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu : 16.45\n");break;
  	    case 2 : printf("Waktu : 23.15\n");}}break;
  	    
case 5 : printf("Maskapai : Wings Air\nTujuan   : Blora\n");
  	switch (kelas)
  	{case 1 : printf("Kelas   : First class\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu  : 05.30\n");break;
  	    case 2 : printf("Waktu : 12.15\n");}break;
  	 case 2 : printf("Kelas   :Bisnis\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu  : 10.15\n");break;
  	    case 2 : printf("Waktu : 17.50\n");}break;
  	case 3 : printf("Kelas   : Ekonomi\n");
  	    switch (jadwal)
  	    {case 1 : printf("Waktu  : 11.00\n");break;
  	    case 2 : printf("Waktu : 13.45\n");}}break;
  	 }
  
  printf("-----------------------------------------------------------\nSelamat menempuh perjalanan dan hati hati di jalan.\n-----------------------------------------------------------\n\n");
}}