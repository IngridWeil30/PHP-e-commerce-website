<?php
  function connect_db(){
    $session = new session("127.0.0.1", "root", "SECRET", NULL, "pool_php_rush");
    return($session->getdb());
  }

  class session{
    private $host;
    private $username;
    private $passwd;
    private $port;
    private $db;
    private $error = 0;
    private $cdatabase;

    const ERROR_LOG_FILE = "error_log.txt";

    public function __construct($host, $username, $passwd, $port, $db){

      $this->host = $host;
      $this->username = $username;
      $this->passwd = $passwd;
      $this->port = $port;
      $this->db = $db;

      $destination = "mysql:host=" . $this->host . ";dbname=" . $this->db;
      $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      try{
      $this->cdatabase = new PDO($destination, $this->username, $this->passwd, $options);
      }

      catch(PDOException $exceptions){
      $this->error = 1;
      echo "Error connection to DB\n";
      }
      if($this->error == 0){
      }
    }

    public function getdb(){
      return($this->cdatabase);
    }
  }

?>
