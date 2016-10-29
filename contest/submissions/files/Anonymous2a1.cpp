#include<stdio.h>
void fact(int *);

int main()
{
    int i;
    scanf("%d",&i);
    fact(&i);
    printf("%d\n", i);
    return 0;
}
void fact(int *j)
{
    static int s=1;
    if(*j!=1)
    {
        s = s*(*j);
        (*j)--;
        fact(j);
    }
   else
    { *j=s;
    }
}