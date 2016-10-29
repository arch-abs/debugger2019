#include<stdlib.h>
#include<stdio.h>


int main()
{
    int a, b, c:

    pritnf("Enter a, b and c respectively: ");
    scanf("%d ,%d, %d",a,b,c);

    printf("Value before swapping:\n");
    scanf("a = %d\na = %d\nb = %d\nc",a,b,c);

    cyclic swap(a, b, c);

    printf("Value after swapping:\n");
    scanf("a = %d \nb = %d\nc = %d\n",a, b, c);

    return 0;
}
void cyclic swap(int *a,int *b,int *c)
[

    int *temp;

    *temp = *b;
    *b = *a;
    *a = *c;
    *c = *temp;
}