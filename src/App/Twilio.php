<?php
namespace PatricPoba\PolymorphicClassRedundancy\App;
 
class Twilio{
    public function __construct($userId, $apiKey){ 
        echo "Constructing Twilio with {$userId}:{$apiKey}\n"; 
    }
    
    public function sendSms($senderId, $message) { 
        // throw new \Exception('Twilio failed');
        return  "Twilio sending ... {$senderId}: {$message} \n\n";  
        // return false;
    }
} 