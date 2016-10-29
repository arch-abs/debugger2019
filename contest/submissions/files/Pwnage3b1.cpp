#include <bits/stdc++.h>
using namespace std; 
int isDivisibleBy7( int num ){
if( num < 0 )
return isDivisibleBy7( -num );
if( num == 0 | | num == 7 )
return 1;
if( num > 10 )
return isDivisibleBy7( (num/10) - 2*(num%10) );
return 0;}
int main(){
int num;
cin>>num;
if( isDivisibleBy7(num ) )
cout<< "Divisible" ;
else
cout<< "Not Divisible" ;
return 0;}