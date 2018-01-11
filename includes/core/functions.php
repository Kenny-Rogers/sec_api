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

?>