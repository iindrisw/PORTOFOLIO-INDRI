#include <iostream>
using namespace std;

int main() {

    for (int i = 1; i <= 10; i++) {
        // cetak i buah "*"
        for (int j = i; j <= i; j++) {
            cout << " ";
        }
        for (int s = i; s <= 10; s++) {
            cout <<"  "<<s;
        }

        cout<<endl;
    }
}
