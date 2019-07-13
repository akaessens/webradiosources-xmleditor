<?php
    if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
        //If it isn't, send back a 405 Method Not Allowed header.
        header($_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed", true, 405);
        exit;
    }
    
    
    //Get the raw POST data from PHP's input stream.
    //This raw data should contain XML.
    $postData = trim(file_get_contents('php://input'));
    
    
    //Use internal errors for better error handling.
    libxml_use_internal_errors(true);
    
    
    //Parse the POST data as XML.
    $xml = simplexml_load_string($postData);
    
    
    //If the XML could not be parsed properly.
    if($xml === false) {
        //Send a 400 Bad Request error.
        header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request", true, 400);
        //Print out details about the error and kill the script.
        foreach(libxml_get_errors() as $xmlError) {
            echo $xmlError->message . "\n";
        }
        exit;
    }

    $xml->asXML("webradiosources.xml");
    
    //var_dump the structure, which will be a SimpleXMLElement object.
    var_dump($xml);
?>

