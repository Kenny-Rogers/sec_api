<?php
  //class for Complainant

  class Personnel extends DatabaseObject {
    protected static $table_name = "personnel";
    protected static $db_field_keys = array('id', 'first_name', 'last_name', 'other_names',
                                              'rank', 'staff_no','sec_id' );

    public function __construct(){
      $this->initialize_db_fields();
    }

    
  }

?>
