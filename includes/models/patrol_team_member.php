<?php
  //class for system_user

  class PatrolTeamMember extends DatabaseObject {
    protected static $table_name = "patrol_team_member";
    protected static $db_field_keys = array('id', 'personnel_id', 'patrol_team_id');

    public function __construct(){
      $this->initialize_db_fields();
    }
  }

?>
