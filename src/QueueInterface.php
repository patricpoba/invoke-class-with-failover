<?php
namespace PatricPoba\PolymorphicClassRedundancy;

// https://www.php.net/manual/en/class.ds-queue.php
interface QueueInterface
{
    /* Constants */
    // const MIN_CAPACITY = 8;

    /* Methods */
    // public function allocate(int $capacity): void;
    // public function capacity(): int;
    // public function clear(): void;
    // public function copy() : self ;
    public function isEmpty(): bool;
    public function peek();
    public function pop();
    public function push($item): void;
    // public function toArray(): array;
    public function size(): int;
}