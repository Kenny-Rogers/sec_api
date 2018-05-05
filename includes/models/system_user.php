<?php
  //class for system_user

  class SystemUser extends DatabaseObject {
    protected static $table_name = "system_user";
    protected static $db_field_keys = array('id', 'personnel_id', 'status', 'role',
                                            'user_name', 'password'/*, 'rep_id'*/);

    public function __construct(){
      $this->initialize_db_fields();
    }
  }

?>
