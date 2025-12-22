#include<iostream>
using namespace std;
int main(int argc, char *argv[])
{
	cout<<"## Program c++ Konvensi Panjang ##"<<endl;
	cout<<" Indri setiawati\n XII MIPA 3\n Absen 13"<<endl;
	cout<<" Senin 12 Februari 2024"<<endl;
	cout<<"=============================="<<endl;
	cout<<endl;
	
	float km,m,cm;
	
	cout<<" Input panjang dalam Kilometer(KM): ";
	cin>>km;
	cout<<endl;
	
	m=km*1000;
	cm=km*100000;
	
	cout<<" Dalam Kilometer = "<<m<<" Dalam Meter";
	cout<<endl;
	cout<<" Dalam Kilometer = "<<cm<<" Dalam Centi meter";
	cout<<endl;
}