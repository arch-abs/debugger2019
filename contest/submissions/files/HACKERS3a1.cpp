#include <stdio.h> 
int isDivisibleBy7( int num ){
/*if( num < 0 )
return isDivisibleBy7( --num );
if( num = = 0 | | num = = 7 )
return 1;
if( num < 10 )
return 0;
return (num%7 );*/
if(num%7==0)
return 1;
else
return 0;}
int main(){
int num;
scanf("%d",&num);
if( isDivisibleBy7(num ) )
printf( "Divisible" );
else
printf( "Not Divisible" );
return 0;}