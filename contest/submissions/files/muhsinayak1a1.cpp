#include <stdio.h>
#include <stdllib.h>

int max(int a[30],int n)
{
  int max=0,i;
   for(i=0;i<n;i++)
       {
         if(a[i]>max)	
            {
            	max=a[i];
			}
	   }
	   return max;	
}

void bucket_sort(int a[30],int n){
  int bucket=max(a,n);
  int b[30],i,k,j=0;=-1;
  for(i=0;i<=bucket;i++)
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
int a[30];
scanf("%d",&n);
for(i=0;i<n;i++)
scanf("%d",&a[i]);
bucket_sort(a,n);
for(i=0;i<n;i++)
printf(" %d",a[i]);
return 0;
}
