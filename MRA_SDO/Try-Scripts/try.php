<?php

function callAPI($method, $url, $data)
{
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'candidateid: test@mra.mw',
      'APIKEY: 3fdb48c5-336b-47f9-87e4-ae73b8036a1c',
      'Content-Type: application/json',
   ));

   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // EXECUTE:
   $result = curl_exec($curl);

   var_dump($result);

   if(!$result){die("Connection-Failure");}

   curl_close($curl);

   return $result;
}

callAPI("POST","https://www.mra.mw/sandbox/programming/challenge/webservice/Taxpayers/add",false);


?>