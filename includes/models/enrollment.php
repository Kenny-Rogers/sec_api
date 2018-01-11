<?php
  //class for system_user

  class Enrollment extends DatabaseObject {
    protected static $table_name = "enrollment";
    protected static $db_field_keys = array('id', 'dep_plan_id', 'pat_team_id', 'jurisdiction');

    public function __construct(){
      $this->initialize_db_fields();
    }
  }

?>
