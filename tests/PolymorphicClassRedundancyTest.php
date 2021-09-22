<?php

use PHPUnit\Framework\TestCase;
use PatricPoba\PolymorphicClassRedundancy\CallClassMethodWithRedundacy;

class PolymorphicClassRedundancyTest extends TestCase
{
    /**
     * Undocumented variable
     *
     * @var CallClassMethodWithRedundacy
     */
    protected $classInstance;

    protected $mainClass = 'App\SomeClass';

    protected $methodParams = ['argument1', 'argument2'];

    public function setUp() : void
    {  
        $this->classInstance = new CallClassMethodWithRedundacy(
            $this->mainClass,
            ...$this->methodParams
        );
    }
   
    public function test_constructor_params_are_pushed_to_queue()
    {
        $this->assertSame(
            $this->mainClass, 
            $this->classInstance->getQueue()->pop() 
        );
    }

    public function test_method_params_passed_via_constructor_are_set_successfuly()
    { 
        $this->assertSameSize($this->methodParams, $this->classInstance->getConstructorParameters() );

        $this->assertEqualsCanonicalizing($this->methodParams, $this->classInstance->getConstructorParameters() );
    }

    public function test_redundancy_classes_are_present_in_queue()
    {
        $newClasses = [ 'App\SecondClass', 'App\ThirdClass' ];

        $this->classInstance->addRedundancyClasses($newClasses);

        $queueItems = $this->classInstance->getQueue()->toArray();
        
        // if both arrays are same, the interection should produe an empty array
        $this->assertTrue( !empty(array_intersect($newClasses, $queueItems)) );
    }
}
