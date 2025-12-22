
#include <stdio.h>
int main(int argc, char *argv[])
{
	int s1,s2,luas,keliling;
	
	printf ("nama : Indri setiawati \n");
	printf("kelas : xi mipa 3 \n");
	printf("\n");
	
	printf("PROGRAM LUAS & KELILING \n");
	
	printf("\n");
	printf("luas & keliling persegi \n");
	
	printf("s1 = ");
	scanf("%i",&s1);
	printf("s2= ");
	scanf("%i",&s2);
	
	printf("luas %i×%i=%i \n",s1,s2,s1*s2);
	
	printf("s1= ");
	scanf("%i",&s1);	
	printf("keliling 4×%i=%i \n",s1,4*s1);
	
	printf("\n");
	int p,l;
	printf("Luas dan keliling persegi panjang\n");
	
	printf("p = ");
	scanf("%i",&p);
	printf("l= ");
	scanf("%i",&l);
	
	printf("luas %i×%i=%i \n",p,l,p*l);
	
	printf("p= ");
	scanf("%i",&p);	
	printf("l= ");
	scanf("%i",&l);	
	printf("keliling 2×(%i+%i)=%i\n",p,l,2*(p+l));
	
	printf("\n");
	int a,b,c,t;
	
	printf("Luas dan keliling segi tiga\n");
	
	printf("a= ");
	scanf("%i",&a);
	printf("b= ");
	scanf("%i",&b);
	printf("c= ");
	scanf("%i",&c);
	
	printf("keliling %i+%i+%i=%i \n",a,b,c,a+b+c);
	
	printf("a= ");
	scanf("%i",&a);	
	printf("t= ");
	scanf("%i",&t);	
	printf("luas 1/2*%i×%i=%i",a,t,a*t/2);
	
	
	

}