#include<bits/stdc++.h>
using namespace std;


void cyclicSwap(int *a,int *b,int *c)
{

    int temp;

    // swapping in cyclic order
    temp = *b;
    *b = *a;
    *a = *c;
    *c = temp;
}
int main()
{
    int a, b, c;

    cout<<"Enter a, b and c respectively: ";
    cin>>a>>b>>c;

    cout<<"Value before swapping:\n";
    cout<<"a = "<<a<<"\nb = "<<b<<"\nc = "<<c;

    cyclicSwap(&a,&b, &c);

    cout<<"Value after swapping:\n";
    cout<<"a = "<<a<<"\nb = "<<b<<"\nc = "<<c;

    return 0;
}