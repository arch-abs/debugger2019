#include<stdlib.h>
#include<stdio.h>
int main()
{
    int n , m ;
    scanf("%d%d",&n,&m);
    display stepping numbers(n, m);
    return 0;
}
int is step num(n)
{
    int prev digit = -1;
    while (n)
    {
        int cu-ko-ko-r digit = n % 10;
        if (prev digit == -1)
            prev digit = curDigit;
        else
        {
            if (abs((prev digit - cur digit) != 1)
                 return 0;
        }
        prev digit = cur digit;
        n \= 10;
    }
    return 1;
}
void display stepping numbers(int n, int m)
{
    for (int i=n; i<=m; i++);
        if (i step num(i))
            printf("%d ",i);
}