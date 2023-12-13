# InvokeWithFailOver (new name)
The package allows a single class to respond to a request with fallback to other classes (that adhere to the same interface)  in a sequential order.
This is used to provide redundancy for critical components of a software system.


# Example of Use Case
**PROBLEM**: Assuming you have three classes which implement the same interface for sending sms.
You may decide to use one class (eg Twilio) to send sms at run time. 

But what if that class (Twilio) fails?

**SOLUTION**: You may want the another class to be called automatically to process the request.
This can be used to add redundancy to critical components of sofware whose failure may be costly

**NOTE**: if a class throws an exception, it is deemed to have failed to process the method call.

This is demostrated below.
```php
namespace App;

interface SmsDriver class {
    public sendSms($senderId, $apiKey);
}

class Twilio implements SmsDriver{
    public function __construct($senderId){  
        //  some logic here
    }
    public function sendSms($message) { 
        // "Send sms with Twilio ... ";  
    }
}

class Nexmo implements SmsDriver{
    public function __construct($senderId){  
        //  some logic here
    }
    public function sendSms($message) { 
        // "Send sms with Nexmo ... ";  
    }
}

class Arkesel implements SmsDriver{
    public function __construct($senderId){ 
        //  some logic here
    }
    public function sendSms( $message) { 
        // "Send sms with Arkesel ... ";  
    }
}
```

The follow demonstrates how all the three classes can be used automatically
```php
$results = (new CallClassMethodWithRedundacy('App\TwilioSms','userId', 'apiKey' )) 
        ->addRedundancyClasses(['App\NexmoSms', 'App\ArkeselSms'])
        ->callMethod('sendSms', 'SenderId', 'test message')   
        ->execute();

# An alternate more expressive form would be done this way -

$results = (new PolymorphicClassRedundancy('App\TwilioSms') ) 
        ->constructorParameters('userId', 'apiKey')
        ->addRedundancyClasses(['App\NexmoSms', 'App\ArkeselSms']) 
        ->methodParameters('SenderId', 'test message') 
        ->failedResponses(false, null) // many can be added
        ->execute();
```


To know which class proceseed the request run code this way : 
```php
$methodCall = new CallClassMethodWithRedundacy('App\TwilioSms','userId', 'apiKey' );

$results = $methodCall->addRedundancyClasses(['App\NexmoSms', 'App\ArkeselSms'])
        ->callMethod('sendSms', 'SenderId', 'test message')   
        ->execute();

// the code below returns the full class name eg 'PatricPoba\PolymorphicClassRedundancy\App\Twilio'
$methodCall->getLastClassUsed(); 

TODO:
Rename CallClassMethodWithRedundacy to InvokeClassWithFailover or InvokeClassWithRedundacy or InvokeClassWithBackup
```
 
