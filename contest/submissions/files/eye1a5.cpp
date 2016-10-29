#include<stdlib.h>
#include<stdio.h>
void displaySteppingNumbers(int n, int m);
int main()
{
    int n , m ;
    scanf("%d%d",&n,&m);
    displaySteppingNumbers(n, m);
    return 0;
}
int isStepNum(n)
{
    int prevDigit = -1;
    while (n)
    {
        int curDigit = n % 10;
        if (prevDigit == -1)
            prevDigit = curDigit;
        else
        {
            if (abs(prevDigit - curDigit) != 1)
                 return 0;
        }
        prevDigit = curDigit;
        n /= 10;
    }
    return 1;
}
void displaySteppingNumbers(int n, int m)
{
    for (int i=n; i<=m; i++);
        if (isStepNum(i))
            printf("%d ",&i);
}