#include<iostream>
using namespace std;

int hitungluas(int panjang, int lebar)
{
	int luas;
	luas=panjang*lebar;
	return luas;
}
int hitung(int x)
{
	return x*x+2*x-3;
}

void cetak(int x, char karakter)
{
	for(int i=0;i<x;i++)
	{
	cout<<karakter;
}
	cout<<endl;

}

int main()
{
	cout<<hitungluas(20,10)<<endl;
	cout<<hitungluas(10,5)<<endl;
	cout<<hitung(4)<<endl;
	cetak(20,'=');
	cout<<"Program tugas akhir"<<endl;
	cetak(20,'-');
	cetak(20, '=');
	
	return 0;
	
}