#include<bits/stdc++.h>
using namespace std;

int main()
{
    int n , m ;
    cin>>n>>m;
    displaySteppingNumbers(n, m);
    return 0;
}
bool is StepNum(n)
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
        if (!StepNum(i))
            cout << i <<" ";
}