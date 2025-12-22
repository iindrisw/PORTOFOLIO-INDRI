#include <stdio.h>
int main(int argc, char *argv[])
{
	int aice,by,sc,bayar,diskon,totalharga,i;
	printf("Indri setiawati \n");
	printf("XI A3 \n");
	printf("ABSEN 13 \n\n");
	printf("___________aice terlaris dikopsis_________\n\n\n");
	printf("blueberry yoghurt = 2500 \n");
	printf("strawberry crispy = 3500 \n");
	printf("1. kamu mau blueberry yoghurt? \n");
	printf("2. kamu mau strawberry crispy? \n");
	
	for(i=1;i<=10;i++)
	{
	printf("\n \npilihanmu (1 atau 2) : ");
	scanf("%d",&aice);
	
	if(aice==1)
{
	printf(" \n masukan jumlah blueberry yoghurt yang akan dibeli : ");
	scanf("%d",&by);
	
	if(by>=8 && by<=16)
{ 
    printf("anda dapat diskon 5 persen \n");
    bayar=by*2500;
    diskon=bayar*0.05;
    totalharga=bayar-diskon;
	printf("hitung bayar = %i \n",bayar);
	printf("total bayar = %i \n",totalharga);
}
else if(by>=17)
{
	printf("anda dapat diskon 10 persen \n");
    bayar=by*2500;
    diskon=bayar*0.1;
    totalharga=bayar-diskon;
	printf("hitung bayar = %i \n",bayar);
	printf("total bayar = %i \n",totalharga);
}
else
{
	printf("anda tidak mendapat diskon \n");
	bayar=by*2500;
	printf("total bayar = %i",bayar);
}
}
else if(aice==2)
{
	printf(" \n masukan jumlah strawberry crispy yang akan dibeli : ");
	scanf("%d",&sc);
	
	if(sc>=6 && sc<=12)
{ 
    printf("anda dapat diskon 5 persen \n");
    bayar=sc*3500;
    diskon=bayar*0.05;
    totalharga=bayar-diskon;
	printf("hitung bayar = %i \n",bayar);
	printf("total bayar = %i \n",totalharga);
}
else if(sc>=13)
{
	printf("anda dapat diskon 10 persen \n");
    bayar=sc*3500;
    diskon=bayar*0.1;
    totalharga=bayar-diskon;
	printf("hitung bayar = %i \n",bayar);
	printf("total bayar = %i \n",totalharga);
}
else
{
	printf("anda tidak mendapat diskon \n");
	bayar=by*3500;
	printf("total bayar = %i",bayar);
}
}
else
{
	printf("pilihan salah, ulangi!");
}
}
}