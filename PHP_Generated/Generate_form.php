<?php

class form{
  protected $title;
  protected $redirection;
  protected $type;
  protected $is_remember;
  protected $button;

  public function __construct($errors, $title, $redirection, $is_remember, $button, $content,$default){
    $this->title = $title;
    $this->redirection = $redirection;
    $this->type = $type;
    $this->is_remember = $is_remember;
    $this->button = $button;
    $this->errors = $errors;
    $this->printTitle();
    $this->printForm($content,$default);
  }

  public function printTitle(){
    echo '<div class="header">
      <h2>'.$this->title.'</h2>
    </div>';
  }
  public function printForm($content,$default){
    echo'<link rel="stylesheet" type="text/css" href="../../Style/form.css">';
    echo'<form method="post" action="'.$this->redirection.'">';
    $errors = $this->errors;
    include "../../PHP_FUNCTIONS/errors.php";
    $i = 0;
    while($i<count($content)){
      print_Field($content[$i],$content[$i+1],$default[$i/2]);
      $i += 2;
    }
    if($this->is_remember == 1){
      echo
      '<p class="remember_me">
        <label>
          <input type="checkbox" name="remember_me" id="remember_me">
          Remember me
        </label>
      </p>';
    }

    echo'
    <div class="input-group">
			<button type="submit" class="btn" name='.$this->button.'>'.$this->button.'</button>
		</div>';
  }
}

function print_Label($label){
  echo '<label>';
  echo $label;
  echo '</label>';
}

function print_Input($input, $label,$default){
  echo '<input ';
  echo 'type='.$input.' name='.$label.' value='.$default;
  echo '>';
}

function print_Field($label,$input,$default){
  echo '<div class="input-group">';
  print_Label($label);
  print_Input($input, $label,$default);
  echo '</div>';
}
?>
