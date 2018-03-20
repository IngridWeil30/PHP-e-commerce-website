<?php
class form{
  protected $title;
  protected $redirection;
  protected $type;
  protected $is_remember;
  protected $button;


  public function __construct($title, $redirection, $is_remember, $button, $content){
    $this->title = $title;
    $this->redirection = $redirection;
    $this->type = $type;
    $this->is_remember = $is_remember;
    $this->button = $button;
    $this->printTitle();
    $this->printForm($content);
  }

  public function printTitle(){
    echo '<div class="header">
      <h2>'.$this->title.'</h2>
    </div>';
  }
  public function printForm($content){
    echo'<link rel="stylesheet" type="text/css" href="Style/form.css">';
    echo'<form method="post" action="'.$this->redirection.'">';
    $i = 0;
    while($i<count($content)){
      print_Field($content[$i],$content[$i+1]);
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
			<button type="submit" class="btn" name="login_user">'.$this->button.'</button>
		</div>';
  }
}

function print_Label($label){
  echo '<label>';
  echo $label;
  echo '</label>';
}

function print_Input($input, $label){
  echo '<input ';
  echo 'type='.$input.' name='.$label.'';
  echo '>';
}

function print_Field($label,$input){
  echo '<div class="input-group">';
  print_Label($label);
  print_Input($input, $label);
  echo '</div>';
}
?>
