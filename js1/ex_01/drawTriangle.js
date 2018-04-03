function drawTriangle(size){
  for(var i = 0; i < size; i++){
    var string = "$";
    for(y=0; y<i; y++){
      string += "$";
    }
    console.log(string);
  }
}
drawTriangle(6);
