#include<bits/stdc++.h>
using namespace std;
 bool leftRight(int arr[],int n)
{
    int visited[n] ;
    for (int i=0; i<n; i++)
    	visited[i]=0;
    for (int i=0; i<n; i++)
    {
        if (arr[i] < n)
        {
            if (visited[arr[i]] == 0)
                visited[arr[i]] = 1;
            else
                visited[n-arr[i]-1] = 1;
        }
    }
    for (int i=0; i<n; i++)
        if (visited[i] == 0)
            return false;
 
    return true;
}
int main()
{
    int arr[] = {2, 1, 5, 2, 1, 5};
    int n = sizeof(arr)/sizeof(arr[0]);
    if (leftRight(arr, n) == true)
        cout << "YES";
    else
        cout << "NO";
    return 0;
}