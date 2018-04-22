<?php
  //class for Complainant

  class ComplainAction extends DatabaseObject {
    protected static $table_name = "complain_action";
    protected static $db_field_keys = array('id', 'personnel_id', 'type_of_action', 'date_time_of_action',
                                              'details_of_action', 'complain_id');

    public function __construct(){
      $this->initialize_db_fields();
    }

  }

?>
