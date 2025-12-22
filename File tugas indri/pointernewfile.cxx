#include<iostream>
using namespace std;
void tambah(int x){
	x=x+3;
}
int main(int argc, char *argv[])
{
	int a=30;
	tambah(a);
	cout<<a<<endl;
}

//berpengaruh
#include<iostream>
using namespace std;
void tambah(int *x){
	*x=*x+3;
}
int main(int argc, char *argv[])
{
	int a=30;
	tambah(&a);
	cout<<a<<endl;
}