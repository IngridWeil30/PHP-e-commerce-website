function arrayIsEqual(a, b){

      total = 0;
      for (var i = 0; i <= a.length - 1; i++) {
          total += a[i];
      }
      for (var i = 0; i <= b.length - 1; i++) {
          total -= b[i];
      }
      if (total==0){
        return 1;
      }
      else{
        return;
      }
  }

// var a = [3, 3];
// var b = [3, 4];
// if (arrayIsEqual(a,b))
// console.log("True");
// else
// console.log("False");
