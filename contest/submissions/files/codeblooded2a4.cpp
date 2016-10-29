 #include<stdio.h>
#include<stdlib.h>
int array[] = {23,34,12,17,204,99,16};
  #define TOTAL_ELEMENTS 1
  

  int main()
  {
      int d;

      for(d=-1;d <= (TOTAL_ELEMENTS+4);d++)
          printf("%d\n",array[d+1]);

      return 0;
  }
