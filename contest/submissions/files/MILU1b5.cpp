using namespace std;
#include<iostream>
#include<math>
void displaySteppingNumbers(int n, int m);
boolean isStepNum(int n);
int main()
{
    int n,m;
    cin>>n>>m;
    displaySteppingNumbers(n,m);
    return 0;
}
int isStepNum(int n)
{
    int prevDigit = -1;
    while (n)
    {
        int curDigit = n % 10;
        if (prevDigit == -1)
            prevDigit = curDigit;
        else
        {
            if (abs(prevDigit - curDigit) != 1)
                 return 0;
        }
        prevDigit = curDigit;
        n /= 10;
    }
    return 1;
}
void displaySteppingNumbers(int n, int m)
{
    for (int i=n; i<=m; i++)
       { if (isStepNum(i))
            cout << i <<" ";
        }
}