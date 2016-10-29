#inlcude<bits/stdc++.h>
using namespace std;
 
void generateSquare(int n)
{
int magicSquare[n][n];
memset(magicSquare, 0, sizeof(magicSquare));
int i = n/2; int j = n-1;
for (int num=1; num<= n*n; )
{if (i==-1 && j==n) //3rd condition
   {j = n-2;i = 0;
    }
else{
if(j == n)
j = 0;
if (i < 0)
i=n-1;
}
if (magicSquare[i][j]) //2nd condition
{j -=2;
i++;
continue;
}
else
magicSquare[i][j] = num++; //set number
j++;  i--; //1st condition
}
    cout<<"The Magic Square for n="<<n<<":\nSum of each row or column :"<<n*(n*n+1)/2<<endl;
    for(i=0; i<n; i++)
    {
        for(j=0; j<n; j++)
            cout<< magicSquare[i][j]<<" ";
        cout<<endl;
    }
}
 
int main()
{
    int n ;
    cin>>n;
    generateSquare(n);
    return 0;
}
