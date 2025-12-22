#include <stdio.h>
void nama()
{
	printf("Indri setiawati \n");
	printf("XI MIPA 3 \n\n\n");
}
void volumeK(int s)
{
	double vk=s*s*s;
	printf("volume kubus adalah = %.3f \n",vk);
}
void volumeL(int alas,int tinggi)
{
	double vl= alas*tinggi/3.0;
	printf("volume limas adalah = %.3f \n",vl);
}
void volumep(int a,int t)
{
	double vp= a*t;
	printf("volume prisma adalah = %.3f \n",vp);
}
void volumeT(int r,int ting)
{
	double vt= 3.14*r*r*ting;
	printf("volume tabung adalah = %.3f \n",vt);
}
void volumeB(int p,int L,int tt)
{
	double vb= p*L*tt;
	printf("volume balok adalah = %.3f \n",vb);
}
int main (void)
{
	nama();
	volumeK(5);
	volumeL(2,3);
	volumep(4,5);
	volumeT(2,5);
	volumeB(2,5,3);
return 0;
}