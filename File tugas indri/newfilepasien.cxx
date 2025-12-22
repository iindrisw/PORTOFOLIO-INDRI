#include<iostream>
#include<string>
using namespace std;

struct pasien{
	string nama;
	string status;
	int umur;
};

int main(int argc, char *argv[])
{
	pasien data_pasien[3];
	for(int i=0;i<3;i++){
	cout<<"-----------------------------------------"<<endl;
	cout<<"Pasien ke-"<<i+1<<endl;
	cout<<"-----------------------------------------"<<endl;
	cout<<"Nama: ";
	getline(cin>>ws,data_pasien[i].nama);
	cout<<"Status: ";
	getline(cin>>ws,data_pasien[i].status);
	cout<<"Umur: ";
	cin>>data_pasien[i].umur;
	}
	cout<<"Nama \tUmur \tStatus"<<endl;
	cout<<"-----------------------------------------"<<endl;
	for(int i=0;i<3;i++){
	cout<<data_pasien[i].nama<<" \t";
	cout<<data_pasien[i].umur<<" \t";
	cout<<data_pasien[i].status<<endl;
}}