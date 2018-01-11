<?php
  //class for Complainant

  class Secretariat extends DatabaseObject {
    protected static $table_name = "secretariat";
    protected static $db_field_keys = array('id', 'name', 'type', 'region');

    public function __construct(){
      $this->initialize_db_fields();
    }

    
  }

?>
