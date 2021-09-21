<?php
namespace PatricPoba\PolymorphicClassRedundancy\App;
  
class Arkesel{
    
    public function __construct($userId, $apiKey){ 
        echo "Constructing Arkesel with {$userId}:{$apiKey}\n"; 
    }
    
    public function sendSms($senderId, $message) { 
        // throw new \Exception('Arkesel failed');
        return "Arkesel sending ... {$senderId}: {$message} \n\n";  
    }

} 