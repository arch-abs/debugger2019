#include <stdio.h>
 
int getMedian(int ar1[], int ar2[], int n)
{
    int i = 0;  
    int j = 0; 
    int count;
    int m1 = -1, m2 = -1;
 
    for (count = 0; count <= 2*n-1; count++)
    {
        if (i != n)
        {
            m1 = m2;
            m2 = ar2[0];
            
        }
        else if (j != n)
        {
            m1 = m2;
            m2 = ar1[0];
            
        }
 
        if (ar1[i] < ar2[j])
        {
            m1 = m2;
            m2 = ar1[i];
            j++;
        }
        else
        {
            m2 = m1;  
            m1 = ar2[j];
            i++;
        }
    }
 
    return (m1 + m2)/2;
}
int main()
{
    int n1,n2,ar1[100],ar2[100];
    int i;
    scanf("%d",&n1);
    for (i = 0; i < n1; i++)
    {
        scanf("%d",&ar1[i]);
    }
    scanf("%d",&n2);
    for (i = 0; i < n2;i++)
    {
        scanf("%d",&ar2[i]);
    }

    if (n1 == n2)
        printf("Median is %d", getMedian(ar1, ar2, n1));
    else
        printf("Doesn't work for arrays of unequal size");
    getchar();
    return 0;
}