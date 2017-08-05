<?php

namespace AppBundle\Service;
use Faker\Factory;

//The main idea to crete this class as a service
// and inject it to the command by dependency injection
// which is the good way yo treat OOP in symfony
// but here with this example I want to show the standard OOP
// I will do dependency injection with the other class - the Format Exporter


/**
 * Class  GenerateOffer.
 * User: Petar Georgiev
 *
 */
class GenerateOffer
{
    /**  */
    private $faker;

    /**
     * AppBundle __construct method.
     *
     */
    public function __construct()
    {
        $this->faker = Factory::create('en_US');
    }

    /**
     * AppBundle generateOffer method.
     *
     */
    private function generateOffer()
    {
        return $this->faker->realText(50);
    }

    /**
     * AppBundle generateOffer method.
     *
     */
    public function printOffer()
    {
       return $this->generateOffer();
    }
}
