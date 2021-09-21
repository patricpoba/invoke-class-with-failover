<?php
namespace PatricPoba\PolymorphicClassRedundancy\App;
 

class Nexmo{
    
    public function __construct($userId, $apiKey){ 
        echo "Constructing Nexmo with {$userId}:{$apiKey}\n"; 
    }
    
    public function sendSms($senderId, $message) { 
        // throw new \Exception('Nexmo failed');
        return "Nexmo sending ... {$senderId}: {$message} \n\n";  
        // return false;
    }

} 