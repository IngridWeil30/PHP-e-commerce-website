function range(min,max,interval){
var array = [];
if (interval == null){
  for(var number = min; number <= max; number++){
    array.push(number);
  }
}
else {
  if (interval>0){
    for(var number = min; number < max; number){
      array.push(number);
      number += interval;
    }
  }
  else if(interval<0){
    for(var number = min; number >= max; number){
      array.push(number);
      number += interval;
    }
  }
}
return (array);
}
// console.log(range(1, 10, 2));
// console.log(range(19, 22));
// console.log(range(5, 2, -1));
