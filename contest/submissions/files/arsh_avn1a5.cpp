#include<stdlib.h>
#include<stdio.h>
int main()
{
    int n , m ;
    scanf("%d%d",&n,&m);
    displaySteppingNumbers(n, m);
    return 0;
}
int StepNum(n)
{
    int prevDigit = -1;
 int curDigit = n % 10;
    while (n)
    {
       
        if (prevDigit == -1)
            prevDigit = curDigit;
        else
        {
            if (abs(prevDigit - curDigit) != 1)
                 return 0;
        }
        prevDigit = curDigit;
        n = n/10;
    }
}
void displaySteppingNumbers(int n, int m)
{
   int i;
    for (i=n; i<=m; i++)
     {   if (i==StepNum(i))
            printf("%d ",i);
}
}