#include<stdlib.h>
#include<stdio.h>
void displaysteppingnumbers(int n,int m);
int istepNum(int n);
int main()
{
    int n,m ;
    scanf("%d%d",&n,&m);
    displaysteppingnumbers(n, m);
    return 0;
}
int istepNum(int n)
{
    int prevDigit = -1;
    while(n)
    {
        int curDigit = n%10;
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
    return 0;
}
void displaysteppingnumbers(int n, int m)
{
    for (int i=n; i<=m; i++);
        if (istepNum(i))
            printf("%d ",i);
}