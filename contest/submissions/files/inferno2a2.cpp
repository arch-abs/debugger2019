#include<stdio.h>
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
if(n==NIL)
     { if (n < =1)
         lookup[n] = n;
      else
         lookup[n] = fib(n-2) + fib(n-1);}
   else
   return lookup[n];
}
int main ()
{
  int n;
  scanf("%d",&n);
  _initialize();
  printf("Fibonacci number is %d ", fib(n-1));
  return 0;
}