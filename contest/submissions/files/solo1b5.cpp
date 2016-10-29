#include<bits/stdc++>
using namespace std;


bool isStepNum(int n)
{
    int prevDigit = -1;
    while (n)
    {
        int curDigit = n % 10;
        if (prevDigit== -1)
            prevDigit = curDigit;
        else
        {
            if (abs(prevDigit - curDigit) != 1)
                 return false;
        }
        prevDigit = curDigit;
        n = n/10;
    }
    return true;
}
void displayStepingNumbers(int n, int m)
{
    for (int i=n; i<=m; i++);
        if ( isStepNum(i))
            cout<<i<<" ";
}
int main()
{
    int n,m ;
    cin>>n>>m;
    displayStepingNumbers(n, m);
    return 0;
}