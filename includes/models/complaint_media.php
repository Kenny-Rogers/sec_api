<?php
  //class for Complainant

class ComplaintMedia extends DatabaseObject
{
    protected static $table_name = "complaint_media";
    protected static $db_field_keys = array('id', 'complaint_id', 'media_type', 'media_name');

    public function __construct()
    {
        $this->initialize_db_fields();
    }

}


?>