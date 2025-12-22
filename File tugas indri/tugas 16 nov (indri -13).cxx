#include <stdio.h>
#include <stdlib.h>

void persegi (float sisi);
void persegi_panjang (float panjang, float lebar);
void jajar_genjang (float alas, float tinggi);
void layang_layang (float d1, float d2);

void persegi (float sisi)
{
int luas;
luas=sisi*sisi;
printf("\nLuas persegi : %i", luas);
}

void persegi_panjang (int panjang, int lebar)
{
int luas;
luas=panjang*lebar;
printf("\nLuas persegi panjang : %i", luas);
}

void jajar_genjang (float alas, float tinggi)
{
float luas;
luas=alas*tinggi;
printf("\nLuas jajar genjang: %.4f", luas);
}

void layang_layang (float diag1, float diag2)
{
float luas;
luas=0.5*diag1*diag2;
printf("\nLuas layang layang : %.2f ", luas);
}

int main() 
{
int pil;
int sisi, panjang, lebar, alas, tinggi, diag1,diag2;
printf("Menu aplikasi\n");
printf("1. Menghitung luas persegi.\n"); printf("2. Menghitung luas persegi panjang. \n");
printf("3. Menghitung luas jajar genjang. \n");
printf("4. Menghitung luas layang-layang. \n");
printf("\nMasukkan pilihan anda: "); scanf("%d",&pil);

switch (pil){
case 1:
printf("Masukkan nilai sisi : "); 
scanf("%i ",&sisi);
 persegi ( sisi);
break;

case 2:
printf("Masukkan nilai panjang : "); scanf("%i",&panjang);
printf("Masukkan nilai lebar : ");
scanf("%i",&lebar); 
persegi_panjang (panjang, lebar); 
break;

case 3:
printf("Masukkan nilai alas"); scanf("%i",&alas);
printf("Masukkan nilai tinggi"); scanf("%i",&tinggi);
jajar_genjang (alas, tinggi);
break;

case 4:
printf("Masukkan nilai diagonal 1 : "); scanf("%i", &diag1);
printf("Masukkan nilai diagonal 2 :"); scanf("%i", &diag2); 
layang_layang (diag1, diag2);
break;
}
return 0;}