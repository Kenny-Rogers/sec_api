<?php
  //class for Complainant

class Complainant extends DatabaseObject
{
    protected static $table_name = "complainant";
    protected static $db_field_keys = array('id', 'first_name', 'last_name', 'password',
        'other_names', 'email', 'telephone', 'address');

    public function __construct()
    {
        $this->initialize_db_fields();
    }

}

?>
