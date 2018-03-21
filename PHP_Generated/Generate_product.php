<?php

class product{
  protected $name;
  protected $redirection;
  protected $image;
  protected $category;
  protected $price;

  public function __construct($name, $redirection, $image, $category, $price){
    $this->name = $name;
    $this->redirection = $redirection;
    $this->image = $image;
    $this->category = $category;
    $this->price = $price;
    $this->printcontent();
  }

  public function printcontent(){
    echo '<div class="col-sm-4">';
    echo '<div class="panel panel-danger">';
    echo '<div class="panel-heading">'.$this->name.'</div>';
    echo '<div class="panel-body"><img src="'.$this->image.'" class="img-responsive" style="width:100%" alt="Image"></div>';
    echo '<div class="panel-footer">'.$this->category.'-'.$this->price.'</div>';
    echo '</div> </div>';
  }

}
?>
