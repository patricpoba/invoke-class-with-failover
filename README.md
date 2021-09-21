# Polymorphic Class Redundancy
The package allows a single class to respond to a request with fallback to other classes (that adhere to the same interface)  in a sequential order.
This is used to provide redundancy for critical components of a software system.


## Example
```php

$pcrResponse = (new PolymorphicClassRedundancy('App\TwilioSms') ) 
        ->constructorParameters('userId', 'apiKey')
        ->addRedundancyClasses(['App\NexmoSms', 'App\ArkeselSms'])
        ->callMethod('sendSms') //classMethod or static
        ->methodParameters('SenderId', 'test message')
        // ->mustNotThrowException() // false, null
        ->failedResponses(false) // false, null
        ->execute();

$pcrResponse = (new CallClassMethodWithRedundacy('App\TwilioSms','userId', 'apiKey' ) )  
        ->addRedundancyClasses(['App\NexmoSms', 'App\ArkeselSms'])
        ->callMethod('sendSms', 'SenderId', 'test message')   
        ->execute();

$pcrResponse 
{
    processedBy: 'App\Nexmo'
    result : 'sms sent'
}
```

```php
https://www.php.net/manual/en/functions.arguments.php#functions.variable-arg-list
function add($a, $b) {
    return $a + $b;
}
echo add(...[1, 2])."\n";
$a = [1, 2];
echo add(...$a);
```

```php
// $args = ['baz'=>'String', 'bar'=>123];
foo(...$args); // equivalent to foo(123, 'String')
```

```php
// Call the $foo->bar() method with 2 arguments
$foo = new foo;
call_user_func_array(array($foo, "bar"), array("three", "four"));

https://www.php.net/manual/en/function.call-user-func-array(Example #1 call_user_func_array() example)
```