#include<iostream>
using namespace std;
int main(int argc, char *argv[])
{
	int a=10;
	cout<<a<<endl;
	cout<<&a<<endl;
	
	int *b;//pointer b
	b=&a;//pointer b menyimpan alamat memory var a
	*b=100;//a=100
	cout<<a<<endl;//100
	cout<<b<<endl;//nilai pointer b
	cout<<*b<<endl;//nilai yang dirujuk pointer b
	cout<<&b<<endl;//alamat memory pointer b
}