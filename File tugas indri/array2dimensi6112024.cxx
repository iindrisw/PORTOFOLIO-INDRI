#include<iostream>
using namespace std;
int main(int argc, char *argv[])
{
	int x[3][2];
	
	//input nilai ke array x berukusan 3x2
	
	for(int i=0;i<3;i++)
	{
		for(int j=0;j<2;j++)
		{
			cout<<"x["<<i<<"] [" <<j<<"]: ";
			cin>>x[i][j];
		}
	}
	for(int i=0;i<3;i++)
	{
		for(int j=0;j<2;j++)
		{
			cout<<x[i][j]<<" ";
		}
		cout<<endl;
	}
}