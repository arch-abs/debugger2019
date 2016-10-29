#include<stdio.h>
#include<stdlib.h>

void fact(int *);
 int s=1;
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
    
    if((*j)!=0)
    {
        s = s*(*j);
        (*j)--;
        fact(&j);   
    }
 *j=s;
}