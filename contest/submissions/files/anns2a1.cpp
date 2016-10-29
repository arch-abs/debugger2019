#include<stdio.h>
 static int s=0;
int fact(int);
int main()
{
    int i;
    scanf("%d",&i);
    fact(&i);
    printf("%d\n", i);
    return 0;
}
int fact(int *j)
{
    if(j!=1)
    {
        s = s*(*j);
        *j--;
         fact(&j);
     }
  return s;
}