#include<stdio.h>
int leftRight(int arr[],int n)
{   int i;
    int visited[n];
    for ( i=1; i<n; i++)
    	visited[i]=0;
    for (i=0; i<n; i++)
    {
        if (arr[i] < n)
        {
            if (visited[arr[i]]!=0)
                visited[i]=1;
            else
                visited[n-arr[i]+1]=1;
        }
    }
    for (i=0; i<n; i++)
        if (visited[i] = = 0)
            return 0;
            return 1;
}
void main()
{
    int arr[] = {2,1,5,2,1,5};
    int n = sizeof(arr)/sizeof(arr[0]);
    if (leftRight(arr,n) == 1)
        printf("YES");
    else
        printf("NO");
        return 0;
}