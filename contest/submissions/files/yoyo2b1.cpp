#include<bits/stdc++.h>
using namespace std;
void fact(int *);

int main()
{
    int i;
    cin>>i;
    int f=fact(i);
    cout<<f<<endl;
    return 0;
}
int fact(int j)
{
 if(j==1)
 return 1;
else
return fact(j)*fact(j-1);
}
  