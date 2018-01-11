<?php
  //class for system_user

  class DeploymentPlan extends DatabaseObject {
    protected static $table_name = "deployment_plan";
    protected static $db_field_keys = array('id', 'secretariat_id', 
                                            'date_created', 'schedule_for_date');

    public function __construct(){
      $this->initialize_db_fields();
    }
  }

?>
