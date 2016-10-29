#include<iostream.h>
#include<stdio.h>
#include<conio.h>
void bucketSort(float arr[],int n)
{
    Vector float b[n];
    for(int i=0;i<n;i++)
     {
      int bi=n*arr[i]; 
      b[bi]-push_back(arr[i]);
    } 
   for(int i=0;i<n;i++)
       sort(b[i].begin(), b[i].end()); 
     int index=0;
    for(int i=0;i<n;i++)
      for(int j=0;j<b[i].sizeof();j++)
          arr(index++)=b[i][j];
}


int main()
{
    float arr[]={0.897,0.565,0.656,0.1234,0.665,0.3434};
    int n=sizeof(arr)/sizeof(arr[0]);
    bucketSort(arr,n);

    cout<<"Sorted array is "<<endl;
    for(int i=0;i<n;i++)
       cout<<arr[i]<< " ";
    return 0;
}
