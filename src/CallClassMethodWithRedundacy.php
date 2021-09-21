<?php

namespace PatricPoba\PolymorphicClassRedundancy;
  
class CallClassMethodWithRedundacy
{
    /**
     * Hold data
     *
     * @var Queue
     */
    protected $queue;

    /**
     * Store class that was able to successfully process request
     *
     * @var [type]
     */
    protected $lastClassUsed;

    protected $class;
    
    protected $constructorParameters;
    
    protected $methodToCall;

    protected $methodParameters;

    protected $failedResponses = [];


    public function __construct($class, ...$classConstructorParams)
    {
        $this->queue = new Queue;
        
        $this->queue->push($class); 

        if (count($classConstructorParams)) {
            $this->constructorParameters(...$classConstructorParams);
        } 
    }
  
    public function addRedundancyClasses(array $redundancyClasses)
    {
        foreach ($redundancyClasses as $fallbackClass) {
            $this->queue->push($fallbackClass);
        }

        return $this;
    }
    
    public function constructorParameters(...$params)
    {
        $this->constructorParameters = $params;
        return $this;
    }
    
    public function callMethod(string $methodName, ...$methodParameters)
    {
        $this->methodToCall = $methodName;

        if (count($methodParameters)) {
            $this->methodParameters(...$methodParameters); 
        }

        return $this;
    }

    public function methodParameters(...$params)
    {
        $this->methodParameters = $params;
        return $this;
    }

    public function failedResponses(...$params)
    {
        $this->failedResponses = $params;
        return $this;
    }

    public function getLastClassUsed()
    {
        return $this->lastClassUsed;
    }

    public function execute()
    {
        $result = null; 

        while(! $this->queue->isEmpty()){
            try {
                $this->lastClassUsed = $nextClass = $this->queue->pop() ;

                $result = (new $nextClass(...$this->constructorParameters) )
                    ->{$this->methodToCall}(...$this->methodParameters) ; 

                // check if response indicates a failure
                if ( in_array($result, $this->failedResponses, true) ) {
                    continue;
                }else{
                    // method call was succesful, stop loop
                    break; 
                }

            } catch (\Exception $exception) { 
                //throw exception if this is the last class in the queue.
                if ($this->queue->isEmpty()) {
                    throw $exception;
                }
            } 
        }

        return $result;
    }


}
