#include<iostream>
using namespace std;
int main()
{
	int ember,sapu,kainpel,total,bayar;
	float p;
	bayar =0;
	cout<<"Toko peralatan rumah\n1. Ember \t\t 30000\n2. Sapu \t\t 15000\n3. Kain pel \t\t 10000";
	cout<<endl;
	cout<<"Masukan jumlah ember yang dibeli    : ";
	cin>>ember;
	cout<<"Masukan jumlah sapu yang dibeli\t    : ";
	cin>>sapu;
	cout<<"Masukan jumlah kain pel yang dibeli : ";
	cin>>kainpel;
	
	if(ember>0)
	{
		bayar=bayar+ember*30000;
	}
	if(sapu>0)
	{
		bayar=bayar+sapu*15000;
	}
	if(kainpel>0)
	{
		bayar=bayar+kainpel*10000;
	}
	
	cout<<"Total belanja anda: "<<bayar;
	cout<<endl;
	
	p=0.15;

	if(bayar>=150000)
	{
			total=bayar-(bayar*p);
		cout<<"Selamat anda mendapatkan 1 kain pel gratis dan diskon sebesar 15%\nTotal yang harus anda bayar: "<<total;
	}
else	if(bayar>=100000 && bayar<150000)
	{
		cout<<"Selamat anda mendapatkan 1 kain pel gratis \nTotal yang harus anda bayar: "<<bayar;
	}
	else
	{
		cout<<"Total yang harus anda bayar: "<<bayar;
	}
	
}