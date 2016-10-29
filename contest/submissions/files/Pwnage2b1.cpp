#include<bits/stdc++.h>
using namespace std;
void fact(int);

int main()
{
    int i;
    cin>>i;
    i=fact(i);
    cout<<i<<endl;
    return 0;
}
int fact(int j)
{
int f=1;    
    
    for(;j>1;--j)
{f*=j;}
return f;
}