 #include<stdio.h>

  #define TOTAL_ELEMENTS 7
  int array[] = {23,34,12,17,204,99,16};

  int main()
  {
      int d;

      for(d=-1;d <= (TOTAL_ELEMENTS-2);d++)
          printf("%d\n",array[d+1]);

      return 0;
  }