#include<bits/stdc++.h>
using namespace std;
void fact(int*);

int main()
{
    int i;
    cin>>i;
    fact(&i);
    cout<<i<<endl;
    return 0;
}
void fact(int *j)
{
    static int s=1;
    if((*j)!=1)
    {
        s = s*(*j);
        (*j)--;
        fact(j);
    }
    *j=s;
}