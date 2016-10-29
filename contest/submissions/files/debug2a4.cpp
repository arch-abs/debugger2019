 #include<stdio.h>

  #define TOTAL_ELEMENTS (sizeof(array) / sizeof(array[0]))
  int array[] = {23,34,12,17,204,99,16};

  int main()
  {
      int d;

      for(d=0;d <= (TOTAL_ELEMENTS-1);d++)
          printf("%d\n",array[d]);

      return 0;
  }
