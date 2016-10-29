#include<stdio.h>
void fact(int);

int main()
{
    int i;
    scanf("%d",&i);
    fact(&i);
    printf("%d\n", i);
    return 0;
}
static int s=1;
void fact(int *j)
{
   
    if(*j!=1)
    {
        s = s**j;
        *j--;
        //*j=s;
        fact(j);
    }
}