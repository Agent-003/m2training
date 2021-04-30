<?php

namespace Training\TestOM\Model;

class PlayWithTest
{

    private $testObject;
    private $testFactory;
    private $manager;

    public function __construct(
        \Training\TestOM\Model\Test $testObject,
        \Training\TestOM\Model\TestFactory $testFactory,
        \Training\TestOM\Model\ManagerCustomImplementation $manager
    ) {
        $this->testObject = $testObject;
        $this->testFactory = $testFactory;
        $this->manager = $manager;
    }

    public function run()
    {
        $this->testObject->log();

        $customArrayList = ['item1' => 'first ', 'item2' => 'second'];
        
        $newTestObject = $this->testFactory->create([
            'arrayList' => $customArrayList,
            'manager' => $this->manager
        ]);

        $newTestObject->log();
    }
}
