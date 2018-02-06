<?php

  //class for Complainant

  class Location extends DatabaseObject {
    protected static $table_name = "location";
    protected static $db_field_keys = array('id', 'geo_lat', 'geo_long', 'team_id', 'last_updated');

    public function __construct(){
      $this->initialize_db_fields();
    }

    //set the last_update_time
    public function set_update_time(){
      //setting the time zone
      $time = get_current_date('dt');
      $this->set_field('last_updated', $time);
    }
  }

?>
