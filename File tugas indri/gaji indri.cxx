#include<iostream>
using namespace std;
int main(int argc, char *argv[])
{
	int g,h;
	float tb,t,l;
	g=0;
	l=0;
	p=0;
	cout<<"Masukan golongan: ";
	cin>>g;
	cout<<"Masukan hari kerja ";
	cin>>h;
	
	if(g==1)
	{
		g=1500000;
	}
	else if(g==2)
	{
		g=2000000;
	}
	else if(g==3)
	{
		g=3000000;
	}
	else
	{
		cout<<"eror";
		return 1;
	}
	
	l=(h-20)*200000;
	
	if((g+h)>4000000) 
	{
		p=
	
}