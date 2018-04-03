var string = "";
for(var number = 1; number <= 20; number++){
  var changed = 0;
  if(number % 3 == 0){
    string += "Fizz";
    changed = 1;
  }
  if(number % 5 == 0){
    string += "Buzz";
    changed = 1;
  }
  if(changed == 0){
    string += number;
  }
  if(number<20){
    string += ", ";
  }
}
console.log(string);
