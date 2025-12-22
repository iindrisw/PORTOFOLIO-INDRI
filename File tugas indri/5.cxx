#include <stdio.h>
int main(int argc, char *argv[])
{
	int uangsaku=25000;
	int uangkas=5000;
	int tabungan=7000;
	printf("saya selalu di beri uang oleh ibu sebesar %i",uangsaku);
	printf(" sebesar %i saya sisihkan untuk menabung dan",tabungan);
	printf("sebesar %i membasay uang kas, jadi sisa uang saku",tabungan);
	printf("yang bisa saya gunakan untuk membeli makan dan minuman adalah sebesar %i-%i-%i=%i",uangsaku,tabungan,uangkas,uangsaku-tabungan-uangkas);
}