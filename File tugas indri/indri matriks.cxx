#include <stdio.h>
 
int main(void)
{
  int bilangan[2][2];
 
  bilangan[0][0] = 30;
  bilangan[0][1] = 40;
  bilangan[0][2] = 50;
  bilangan[1][0] = 60;
  bilangan[1][1] = 70;
  bilangan[1][2] = 80;
  bilangan[2][0] = 90;
  bilangan[2][1] = 100;
  bilangan[2][2] = 110;
  printf("Isi array bilangan: \n");
  printf("%d, %d  %d \n",bilangan[0][0],bilangan[0][1],bilangan[0][2]);
  printf("%d, %d  %d \n",bilangan[1][0],bilangan[1][1],bilangan[1][2]);
  printf("%d, %d %d \n",bilangan[2][0],bilangan[2][1],bilangan[2][2]);
 
  return 0;
}