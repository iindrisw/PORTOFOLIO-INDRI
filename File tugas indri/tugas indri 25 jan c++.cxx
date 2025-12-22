#include<iostream>
using namespace std;
int main()
{
	int nilai;
	cout<<" ========\tTUGAS INFORMATIKA S2 C++ <<indri>>\t ======== \t";
	cout<<"\n\n Nama\t \t: Indri setiawati \t";
	cout<<"\n No Absen \t: 13 \t";
	cout<<" \n Tanggal  \t: 25 Januari 2024 \t";
	cout<<" \n Input nilai \t:";
	cin>>nilai;
	if(nilai>= 80 && nilai <=100)
	{
		cout<<" Grade nilai\t:Sangat baik";
	}
	else if(nilai>= 70 && nilai <=79)
	{
		cout<<" Grade nilai\t:Baik";
	}
	else if(nilai>= 60 && nilai <=69)
	{
		cout<<" Grade nilai\t:Cukup";
	}
	else if(nilai>= 50 && nilai <=59)
	{
		cout<<" Grade nilai\t:Kurang";
	}
	else
	{
		cout<<" Grade nilai\t:Gagal";
	}
}