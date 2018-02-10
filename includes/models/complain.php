<?php
  //class for Complainant

  class Complain extends DatabaseObject {
    protected static $table_name = "complain";
    protected static $db_field_keys = array('id', 'nature_of_issue', 'location_id', 'complainant_id',
                                              'type_of_issue', 'date_time_of_report' );

    public function __construct(){
      $this->initialize_db_fields();
    }

  }

?>
