#include<bits/stdc++.h>
using namespace std;
int fact(int);

int main()
{
    int i;
    cin>>i;
   i= fact(i);
    cout<<i<<endl;
    return 0;
}
int fact(int j)
{
    static int s=1;
    if(j!=1)
    {
        s = s*(j);
        j--;
        return fact(j);
    }
else
return s;
}