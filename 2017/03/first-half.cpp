/**
 * By Kadda-senpai
 */

#include <stdio.h>

int main (void)
{

int a=1,b=1,c=1,d=1;
int r; //row
int input,output=0;
int i,j,n=0;

printf("Gib eine natuerliche Zahl ein: ");
scanf("%d", &input);

if (input==1)
	{
	printf("\nDie Loesung ist: %d",output);
	}
else
	{
	for(r=0;;r++)
		{
		a=a+2*n+1;
		b=b+2*(n+1)+1;
		c=c+2*(n+2)+1;
		d=d+2*(n+3)+1;

		for(i=0;i<=r+1;i++)
			{
			if(input==a+i|| input==b+i||input==c+i||input==d+i||input==a-i||input==b-i||input==c-i||input==d-i)
				{
				output=r+i+1;
				printf("\nDie Loesung ist: %d",output);
				break;
				}
			}

		if(output==r+i+1)
		{
		break;
		}

		n=n+4;
		}
	}

 	return 0 ;
}
