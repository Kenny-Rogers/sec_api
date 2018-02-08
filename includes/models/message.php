<?php
//static class to send text messages
class Message{
  // text message api information
  private static $api = "http://api.mytxtbox.com/v3/messages/send?";
  private static $client_id = "dnymazlw";
  private static $client_secret = "hqynfckc";
  private static $registered_delivery = "true";
  private static $from = "GH-POLICE";

  public static function send_message($number="", $message=""){
    //send text message $message to $number
    //encode test message
    $encoded_message = urlencode($message);

    //parameterized string for sending message
    $send_string = self::$api."From=".self::$from."&To={$number}".
                  "&Content={$encoded_message}"."&ClientId=".self::$client_id.
                  "&ClientSecret=".self::$client_secret."&RegisteredDelivery=".
                  self::$registered_delivery;

    //initialising library for data transfer
    $curl = curl_init();
    curl_setopt_array( $curl,
        array( CURLOPT_URL => $send_string, CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "GET"));

    //executing the transfer
    $response = curl_exec($curl);

    //fetching error if any
    $error = curl_error($curl);

    if($error){
      echo "CURL ERROR #:". $error;
    } else {
      return $response;
    }
   }
}

?>
