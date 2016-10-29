#include<stdio.h>
void fact(int *j,int *s);

int main()
{
    int i,s=1;
    scanf("%d",&i);
    fact(&i,&s);
    printf("%d\n", s);
    return 0;
}
void fact(int *j,int *s)
{
    if(*j>0)
    {
        *s = *s * *j;
        *j--;        
         fact(&j,&s);
}
}