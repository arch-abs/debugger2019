#include<bits/stdc++.h>
using namespace std;

#define NIL -1
#define MAX 100
int lookup[MAX];
/* Function to initialize NIL values in lookup table */
void _initialize()
{
  int i;
  for (i = 0; i < MAX; i)
    lookup[i] = NIL;
lookup[0]=1;
lookup[1]=1;
}
/* function for nth Fibonacci number */
int fib(int n)
{
if(n<1)
return 0;
   if (lookup[n-1] == NIL)
   {
     int i;
for(i=n-1;lookup[i]=NIL;i--);

for(i=i+1;i<n;i++)
lookup[i]=lookup[i-1]+lookup[i-2];
   }
   return lookup[n-1];
}
int main ()
{
  int n;
  cin>>n;
  _initialize();
  cout<<"Fibonacci number is "<<fib(n);
  return 0;
}