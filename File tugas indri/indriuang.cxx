#include<iostream>
using namespace std;
int main(int argc, char *argv[])
{
	int m,b,h,u,j,a,k,uang;
	uang=0;
	cout<<"Masukan uang merah : ";
	cin>>m;
	cout<<"Masukan uang biru : ";
	cin>>b;
	cout<<"Masukan uang hijau : ";
	cin>>h;
	cout<<"Masukan uang ungu : ";
	cin>>u;
	cout<<"Masukan uang jingga : ";
	cin>>j;
	cout<<"Masukan uang abu : ";
	cin>>a;
	cout<<"Masukan uang kuning : ";
	cin>>k;
	if(m>0)
	{
		uang=uang+m*100000;
	}
	if(b>0)
	{
		uang=uang+b*50000;
	}
	if(h>0)
	{
		uang=uang+m*20000;
	}
	if(u>0)
	{
		uang=uang+m*10000;
	}
	if(j>0)
	{
		uang=uang+m*5000;
	}
	if(a>0)
	{
		uang=uang+m*2000;
	}
	if(k>0)
	{
		uang=uang+m*1000;
	}
	
	cout<<"Jumlah uang : "<<uang;
}