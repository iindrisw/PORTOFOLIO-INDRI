#include<iostream>
using namespace std;
int main(int argc, char *argv[])
{
	float a,b,c,d;
	
	c=100;
	
	cout<<"input a: ";
	cin>>a;
	cout<<"input b: ";
	cin>>b;
	
	d=(a+b)/c-100;
	d=d*-1;
	
	cout<<"Nilai d adalah "<<d;
}