<?php

namespace Acme\PruebaBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Location
{
    /**
* @Assert\NotBlank()
*/
    public $address;

/**
* @Assert\Type("Acme\PruebaBundle\Entity\City")
* @Assert\NotNull()
*/
    public $city;
}