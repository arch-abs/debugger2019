#include<stdio.h>
#include<stdlib.h>
void fact(int*);

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
    static int s=0;
if(s==0)s=1;
    if((*j)!=1)
    {
        s = s*(*j);
        (*j)= (*j)-1;
         fact(j);
    }
else *j=s;
}