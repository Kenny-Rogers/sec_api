<?php
  //class for system_user

  class PatrolTeam extends DatabaseObject {
    protected static $table_name = "patrol_team";
    protected static $db_field_keys = array('id', 'date_created', 'leader_id', 'team_name',
                                              'password', 'expiration', 'status');

    public function __construct(){
      $this->initialize_db_fields();
    }
  }

?>
