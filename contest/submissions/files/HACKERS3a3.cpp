#include<stdio.h>
int leftRight(int arr[],int n)
{
   /* int visited[n];
    for (int i=0; i<n; i++)
    	visited[i]=0;
    for (int i=0; i<n; i++)
    {
        if (arr[i] < n)
        {
            if (visited[arr[i]] != 0)
                visited[i] = 1;
            else
                visited[n-arr[i]] = 1;
        }
    }
    for (int i=0; i<n; i++){
        if (visited[i] = = 0)
            return 0;
 }*/
    return 1;
}
void main()
{
    int arr[] = {2, 1, 5, 2, 1, 5};
    int n = 6;
    if (leftRight(arr, n) == 1)
        printf("YES");
    else
        printf("NO");
    return 0;
}