#include <stdio.h>
void namakelasku()
{
	printf("Indri setiawati \n");
	printf(" XI MIPA 3 \n");
}
void BMI()
{
	float bb, tb, bmi;
	printf("\n\nMasukan berat badan(kg): ");
	scanf("%f", &bb);
	printf("\nMasukan tinggi badan(m): ");
	scanf("%f", &tb);
	bmi = bb / (tb * tb);
	printf("BMI=%.2f\n\n", bmi);
	if (bmi <= 18.5)
	{
		printf("\nanda dalam kategiru kurus\n");
	}
	else if (bmi <= 24)
	{
		printf("\nanda dalan kategori normal\n");
	}
	else if (bmi <= 29)
	{
		printf("\nanda dalam kategori kelebihan berat\n");
	}
	else
	{
		printf("/nanda dalam kategori kegemukan\n");
	}
}
void main()
{
	namakelasku();
	int i;
	for (i = 1; i <= 10; i++)
	{
		BMI();
	}
}