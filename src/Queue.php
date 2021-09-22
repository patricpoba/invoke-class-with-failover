<?php
namespace PatricPoba\PolymorphicClassRedundancy;

use Exception;
use PatricPoba\PolymorphicClassRedundancy\QueueInterface;
 
class Queue implements QueueInterface
{ 
    private $dataStore;
     
    public function __construct()
    {
        $this->dataStore = [];
    }
  
    public function size(): int
    {
        return count($this->dataStore);
    }
  
    public function isEmpty(): bool
    {
        return empty($this->dataStore);
    }

    public function peek()
    {
        return current($this->dataStore);
    }

    public function pop()
    {
        if ($this->isEmpty()) {
	        throw new Exception("Queue is empty");
	    }
        
        return array_shift($this->dataStore);
    }

    public function push($newItem): void
    { 
        $this->dataStore[] = $newItem;
    } 

    public function toArray() : array
    {
        return $this->dataStore;
    }
}