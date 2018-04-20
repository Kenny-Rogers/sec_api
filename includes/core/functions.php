<?php

    function datetime_to_text($datetime=""){
    //displays the date in a different format
    $unixdatetime = strtotime($datatime);
    return Strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
    }

    function get_displayable_date($date_string=""){
        //gives time from a given string
        $unix_time = strftime('%d %B, %Y', strtotime($date_string));
        return $unix_time;
    }

    //makes a date acceptable to mysql database
    function mysql_date_format($dt=""){
    $mysql_date=strftime("%Y-%m-%d", $dt);
    return  $mysql_date;
    }

    //get the current date
    function get_current_date($type="dt"){
        date_default_timezone_set('Africa/Accra');
        switch ($type) {
            //case only date is requested
            case 'd':
                $date = date("Y-m-d"); 
                return $date;
                break;

            //case date time is requested
            case 'dt':
            default:
                $date_time = date("Y-m-d H:i:s"); 
                return $date_time;
                break;
        }

    }

    function mysql_datetime_format($dt = ""){
    $mysql_date = strftime("%Y-%m-%d %H:%M:%S", $dt);
    return $mysql_date;
    }

?>