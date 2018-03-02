<?php
  //class for Complainant

  class Announcement extends DatabaseObject {
    protected static $table_name = "announcement";
    protected static $db_field_keys = array('id', 'title', 'message', 'image', 'author', 'date_published' );

    public function __construct(){
      $this->initialize_db_fields();
    }

  }

?>
