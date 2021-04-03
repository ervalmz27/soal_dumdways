#include <stdio.h>
int main()
{
    int i,j,c;
    printf("\n");
    for( i=1;i<=100;i++){
        for( j=1;j<=i;j++){
 
            if(i % j == 0){
                c++;
            
            }
        }
    if(c == 2) printf("%d\t",i);
    c=0;
    }
}