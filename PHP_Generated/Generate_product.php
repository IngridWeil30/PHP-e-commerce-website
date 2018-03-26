<?php

class product{
  protected $name;
  protected $redirection;
  protected $image;
  protected $category;
  protected $price;
  public static $count = 1;

  public function __construct($name, $redirection, $image, $category, $price){
    $this->name = $name;
    $this->redirection = $redirection;
    $this->image = $image;
    $this->category = $category;
    $this->price = $price;
    $this->printcontent();
    ++self::$count;
  }

  public function printcontent(){
   if(self::$count%3 == 0){
      echo '<div class="row">';
   }

   echo '<div class="col-md-4">';

   echo '<div class="panel" style="width:100%;heigth:100px">';

   echo '<div class="panel-heading">'.$this->name.'</div>';

   echo '<div><img src="'.$this->image.'"alt="image" class="productimage"></div>';

   echo '<div class="panel-footer"><table><tr><td class="etiqu_cat">'.$this->category.'</td>';

   echo '<td class="etiqu_price">'.$this->price.'€ /kg</td></tr></table></div>';


   if(self::$count%3 == 0){
     echo '</div>';
   }

   echo '</div> </div>';

}
}
?>
