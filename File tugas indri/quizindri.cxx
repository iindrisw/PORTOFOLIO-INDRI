#include<iostream>
using namespace std;

bool ganjil(int x)
{
	if(x%2==0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

bool genap(int x)
{
	if(x%2==0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

int hitung(int x)
{
	return x*x*x*x;
}

int menghitung(int x,int y, int z)
{
	return x*x+2*y*z+3*z*z;
}
	
int main()
{
	cout<<ganjil(1)<<endl;
	cout<<genap(2)<<endl;
	cout<<hitung(2)<<endl;
	cout<<menghitung(1,2,3)<<endl;
	
}
