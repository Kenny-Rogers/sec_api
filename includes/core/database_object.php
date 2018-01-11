<?php //require_once (LIB_PATH.DS.'core'.DS.'database.php');
//includes all common methods called on all database objects returned on a query
// 'static::[attribute or method]' is used to access the info of the calling object
// that is static but not this object's info


class DatabaseObject
{
    //the fields of the database record of a table and
    //thier corresponding field values
    protected $db_fields = array();
    protected $auto_number_id = true;

    //creates the keys in $db_fields array and map them to ""
    protected function initialize_db_fields()
    {
        //cleaning the attributes for queries
        global $database;
        $sanitized_fields = array();
        foreach (static::$db_field_keys as $key) {
            $sanitized_fields[] = $database->escape_value($key);
        }
        //initializes all the db fields of the object to an empty string
        $this->db_fields = array_fill_keys($sanitized_fields, "");
        $this->set_field('id', 0);
    }


    //used to create a new object by instantiating an object
    //and saving it to the database
    public function create()
    {
        global $database;
        //gets all the attributes of the calling class
        $sql="INSERT INTO ".static::$table_name."( ";
        $sql.=join(", ", array_keys($this->db_fields));
        $sql.=") VALUES( '";
        $sql.=join("', '", array_values($this->db_fields));
        $sql.=" ')";
        if ($database->query($sql)) {
            $this->set_field('id', $database->insert_id());
            return true;
        } else {
            return false;
        }
    }

    //used to update an object by setting the info in the db to
    //the new info on the object and saving it to the database
    public function update()
    {
        global $database;
        $attribute_pairs=array();
        $id = $this->get_field('id');
        unset($this->db_fields['id']);
        foreach ($this->db_fields as $key => $value) {
            if ($value == '') {
                $attribute_pairs[]="{$key}=NULL";
            } else {
                $insert_value = $database->escape_value($value);
                $attribute_pairs[]="{$key}='{$insert_value}'";
            }
        }
        $this->db_fields['id'] = $id;
        $sql="UPDATE ".static::$table_name." SET ";
        $sql.=join(", ", $attribute_pairs);
        $sql.=" WHERE id=".$database->escape_value($this->get_field('id'));
        //echo $sql;
        $database->query($sql);
        return($database->affected_rows())? true : false;
    }
    
    //used to delete a record
    public function delete()
    {
        global $database;

        $sql="DELETE FROM ".static::$table_name." WHERE id=".$database->escape_value($this->id);
        $sql.=" LIMIT 1";
        $database->query($sql);
        return($database->affected_rows()==1)? true : false;
    }

    //returns all records stored in the table specified in the child class
    public static function find_all()
    {
        return self::find_by_sql("SELECT * FROM ".static::$table_name);
    }

    //returns all records stored in the table specified in the child class
    public static function find_all_with($condition="")
    {
        return self::find_by_sql("SELECT * FROM ".static::$table_name." WHERE ".$condition);
    }

    //returns array of a record by id
    public static function find_by_id($id=0)
    {
        global $database;
        $result_array=self::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id=".$database->escape_value($id)." LIMIT 1");
        //returns the first element in the array
        return !empty($result_array)?array_shift($result_array):false;
    }

    //returns an array of  objects based on a specific query
    public static function find_by_sql($sql="")
    {
        //accesing the $database object created in the 'database.php' file
        //and calling the class method query
        global $database;
        $result_set=$database->query($sql);
        //an array of objects
        $object_array=array();
        //for every record fetched from the db,
        //an object is created and it's attributes are assigned
        while ($row=$database->fetch_array($result_set)) {
            $object_array[]=self::instantiate($row);
        }
        //print_r($object_array);
        return $object_array;
    }

    //returns the count of the records in a table
    public static function count_all()
    {
        global $database;
        $sql="SELECT COUNT(*) FROM ".static::$table_name;
        $result_set=$database->query($sql);
        $row=$database->fetch_array($result_set);
        return array_shift($row);
    }

    //sets all the properties of a record from the database
    //to the fields of an object of the subclass
    private static function instantiate($query_record)
    {
        //creates a new record
        $object=new static;
        foreach ($query_record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                //assigns the value of $query_record[$attribute] to $object->db_fields['attribute']
                $object->set_field($attribute, $value);
            }
        }
        //return the populated record
        return $object;
    }

    //checks if the object has the given attribute
    private function has_attribute($attribute)
    {
        return array_key_exists($attribute, $this->db_fields);
    }

    /* set the value for a field of the record
      @params
    */
    public function set_field($table_field, $value)
    {
        $this->db_fields[$table_field] = $value;
    }

    /* set the values for all fields of the record
      @params
    */
    public function set_fields($field_value_array)
    {
      foreach ($field_value_array as $table_field => $value) {
        $this->set_field($table_field, $value);
      }
    }

    //get the value for a field
    public function get_field($table_field)
    {
        return $this->db_fields[$table_field];
    }

    public function get_array(){
        return $this->db_fields;
    }
}
