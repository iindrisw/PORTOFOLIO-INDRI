//FUNGSI REKURSIF
#include<iostream>
using namespace std;
void cetak(int i)
{
	cout<<"cetak ke-"<<i<<endl; //cetak ke-10 dilihat dari int main
	if(i>0) //10>0 true
	{
		cetak(i-1); // cetak10-1, jadi cetak 9
	}
}


void cetak1(int i)
{
	
	if(i>0) //10>0 true
	{
		cetak1(i-1); // cetak10-1, jadi cetak 9 dan balik lagi ke cetak1
	}
	cout<<"cetak ke-"<<i<<endl; //menyelesaikan cetak paling terakhir terlebih dahulu (menyelesaikan 0 dan muncul berurutan 0,1,2...)
}
int main(int argc, char *argv[])
{
	cetak(10);
	cetak1(10);
	return 0;
}


