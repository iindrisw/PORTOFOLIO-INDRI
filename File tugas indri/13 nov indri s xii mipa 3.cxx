#include <stdio.h>

float fungsi_p(float harga, float disc) 
{ 
float total; 
total= harga*(harga * disc); 
return 0; 
}

void main()
{ 

float harga, disc, total;

printf("Masukan Harga awal: "); 
scanf("%f",&harga);

printf("Diskon Harga: "); 
scanf("%f",&disc);

total-fungsi_p(harga, disc);

printf("\nMaka Harga barang total adalah %f", total);
}