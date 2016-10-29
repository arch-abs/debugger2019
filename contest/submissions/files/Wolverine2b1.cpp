#include<bits/stdc++.h>
using namespace std;
void fact(int *j);

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
    static int s=*j;
    if(*j!=1)
    {   
        (*j)--;
        s = s**j;
       
        fact(j);
    }
   *j=s;
}