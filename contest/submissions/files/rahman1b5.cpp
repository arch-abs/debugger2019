#include<bits/stdc++.h>
using namespace std;

int main()
{
    int n=1 , m=2 ;
    cin>>n>>m;
    displaySteppingNumbers(1, 2);
    return 0;
}
bool isStepNum(n=1)
{
    int prevDigit = -1;
    while (n)
    {
        int curDigit = n % 10;
        if (prevDigit == -1)
            prevDigit = curDigit;
        else
        {
            if (abs((prevDigit - curDigit) != 1)
                 return false;
        }
        prevDigit = curDigit;
        n /= 10;
    }
    return true;
}
void displayStepingNumbers(int n, int m)
{
    for (int i=n; i<=m; i++);
        if (iStepNum(i))
            cout << i <<" ";
}