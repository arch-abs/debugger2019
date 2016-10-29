#include<bits/stdc++.h>
using namespace std;

int getMedian(int ar1[], int ar2[], int n)
{
    int i = 0;  
    int j = 0; 
    int count;
    int m1 = -1, m2 = -1;
 
    for (count = 0; count <(2*n-1); count++)
    {
        if (i != n)
        {
            m1 = m2;
            m2 = ar2[i];
            break;
        }
        else if (j != n)
        {
            m1 = m2;
            m2 = ar1[j];
            break;
        }
 
        if (ar1[i] < ar2[j])
        {
            m1 = m2;
            m2 = ar1[j];
           j++;
        }
        else
        {
            m2 = m1;  
            m1 = ar2[i];
            i++;
        }
    }
 
    return (m1 + m2)/2;
}
int main()
{
    int n1,n2,ar1[100],ar2[100];
    int i;
    cin>>n1;
    for (i = 0; i < n1; ++i)
    {
        cin>>ar1[i];
    }
    cin>>n2;
    for (i = 0; i < n2; ++i)
    {
        cin>>ar2[i];
    }

    if (n1 == n2)
        printf("Median is %d", getMedian(ar1, ar2, n1));
    else
        printf("Doesn't work for arrays of unequal size");
    getchar();
    return 0;
}