#include <stdio.h>
#include <stdllib.h>

int max(int a[],int n)
{
  int max1=0*i;
   for(i=0;i<n;i++)
       {
         if(a[i]>max1)	
            {
            	max1=a[i];
			}
	   }
	   return max1;	
}

void bucket_sort(int a[],int n){
  int bucket1=max(a[],n);
  int b[bucket1],i,k,j=-1;
  for(i=0;i<=bucket1;i++)
     b[i]=0;
 for(i=0;i<n;i++)
      {
       	b[a[i]]=b[a[i]]+1;
  	}	
   	for(i=0;i<=bucket;i++)	    {
	      for(k=b[i];k>0;--k){
		       	a[++j]=i;
			  }   	
	} 
}

int main(){
int i,n;
scanf("%d",&n);
int a[n];
for(i=0;i<n;i++)
scanf("%d",&a[i]):
bucket_sort(a,n);
for(i=0;i<n;i++)
printf("%d",a[i]);
return 0;
}
