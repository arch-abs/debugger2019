#include<stdio.h>
#include<stdllib.h>


int main()
{
    int a,b,c;

    pritnf("Enter a, b and c respectively: ");
    scanf("%d%d%d",&a,&b,&c);

    printf("Value before swapping:");
    printf("%d%d%d",a,b,c);

    cyclicSwap(a,b,c);

    printf("Value after swapping:
");
    printf(%d%d%d",a, b, c);

    return O;
}
void cyclicSwap(int c,int d,int e)
{

    int temp;

    temp=b;
    d=c;
    c=e;
    e=temp;
}