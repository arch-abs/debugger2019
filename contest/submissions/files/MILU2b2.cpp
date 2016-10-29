#include<bits/stdc++.h>
using namespace std;

#define NIL -1
#define MAX 100
int lookup[MAX];
/* Function to initialize NIL values in lookup table */
void _initialize()
{
  int i;
  for (i = 0; i < MAX; i++)
    lookup[i] = NIL;
}
/* function for nth Fibonacci number */
int fib(int n)
{
   if (lookup[n]== NIL)
   {
      if (n < 1)
         lookup[n] = n;
      else
         lookup[n] = fib(n) + fib(n-1);
   }
   return lookup[n+1];
}
int main ()
{
  int n;
  cin>>n;
  _initialize();
  cout<<"Fibonacci number is "<<fib(n);
  return 0;
}