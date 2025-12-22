#include<iostream>
using namespace std;
int main()
{
	int total;
	
	char nama [100];
	cout<<"\t\t## Program Bahasa C Diskon Potongan Harga ## \n";
	cout<<"INDRI SETIAWATI\nXII MIPA 3\n  13\n1 FEBRUARI 2024\n\n\n";
	

	cout<<"Masukan nama anda : ";
	cin>> nama;
	cout<<"Masukan total belanja anda : ";
	cin>>total;
	int dis1=0.1*total;
	int dis2=0.2*total;
	int dis3=total*0.3;

	if(total>0 && total <=100000)
	{
		cout<<"Maaf anda tidak mendapatkan diskon";
        cout<<"\nTotal yang harus di bayar:  "<<total;
	}
	else if(total>100000 && total <500000)
	{
		cout<<"Selamat anda mendapatkan  diskon sebesar 10%\n";
		
		cout<<"Total yang harus di bayar:  "<<total-dis1;
	}
	else if(total>=500000 && total <1000000)
	{
		cout<<"Selamat anda mendapatkan  diskon sebesar 20%\n";
		
		cout<<"Total yang harus di bayar:   "<<total-dis2;
	}
	else if(total>=1000000)
	{
		cout<<"Selamat anda mendapatkan  diskon sebesar 30%\n";
		
		cout<<"Total yang harus di bayar:  "<<total-dis3;
	}
	else
	{
		cout<<"Gagal\nMasukan nominal dengan benar";
	}
}