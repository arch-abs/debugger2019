

#include<iostream>
using namespace std;
 int array[] = {23,34,12,17,204,99,16};
#define TOTAL_ELEMENTS (sizeof(array)/sizeof(array[0]))
 
  int main()
  {
      int d;

      for(d=0;d<(TOTAL_ELEMENTS);d++)
          cout<<array[d]<<endl;

      return 0;
  }

