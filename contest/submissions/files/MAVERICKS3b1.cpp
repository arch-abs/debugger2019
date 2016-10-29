#include <stdio.h> 
#include<iostream>
using namespace std;
int isDivisibleBy7( int num )
{
if(num%7==0)
return 1;
else
return 0;
}
int main()
{
int num,i;
scanf("%d",&num);
i= isDivisibleBy7(num);
if( i )
cout<< "Divisible" ;
else
cout<< "Not Divisible" ;
return 0;
}