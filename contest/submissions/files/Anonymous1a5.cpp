#include<stdio.h>
#include<stdlib.h>
#include<math.h>
int isStepNum(int);
void displaySteppingNumbers(int ,int);
int main()
{
    int n , m ;
    scanf("%d%d",&n,&m);
    displaySteppingNumbers(n, m);
    return 0;
}
int isStepNum(int n)
{
    int prevDigit = -1;
    int curDigit;
    while (n)
    {
        curDigit = n % 10;
        if (prevDigit == -1)
            prevDigit = curDigit;
        else
        {
            if (abs(prevDigit - curDigit) != 1)
                 return 0;
        }
        prevDigit = curDigit;
        n \= 10;
    }
    return 1;
}
void displaySteppingNumbers(int n, int m)
{   int i;
    for (i=n; i<=m; i++)
        {if (isStepNum(i))
            printf("%d ",i);}
}