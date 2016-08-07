<?php

namespace Acme\PruebaBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
* @author Fran Moreno <franmomu@gmail.com>
*/

/**
* Acme\PruebaBundle\Entity\Province
*
* @ORM\Table(name="main_province")
* @ORM\Entity(repositoryClass="Acme\PruebaBundle\Entity\ProvinceRepository")
*/
class Province
{
    /**
* @var integer $id
*
* @ORM\Column(name="id", type="integer")
* @ORM\Id
* @ORM\GeneratedValue(strategy="AUTO")
*/
    protected $id;

    /**
* @var string $name
*
* @ORM\Column(name="name", type="string", length=255)
*/
    protected $name;

    /**
* @var string $slug
*
* @ORM\Column(name="slug", type="string", length=255, unique=true)
*/
    protected $slug;

    /**
* @ORM\ManyToOne(targetEntity="Acme\PruebaBundle\Entity\Country", inversedBy="provinces")
* @ORM\JoinColumn(name="country_id", referencedColumnName="id")
*/
    protected $country;

    /**
* @ORM\OneToMany(targetEntity="Acme\PruebaBundle\Entity\City", mappedBy="province")
*/
    protected $cities;

    /**
* Constructor
*/
    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Province
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Province
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set country
     *
     * @param \Acme\PruebaBundle\Entity\Country $country
     * @return Province
     */
    public function setCountry(\Acme\PruebaBundle\Entity\Country $country = null)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \Acme\PruebaBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add cities
     *
     * @param \Acme\PruebaBundle\Entity\City $cities
     * @return Province
     */
    public function addCitie(\Acme\PruebaBundle\Entity\City $cities)
    {
        $this->cities[] = $cities;
    
        return $this;
    }

    /**
     * Remove cities
     *
     * @param \Acme\PruebaBundle\Entity\City $cities
     */
    public function removeCitie(\Acme\PruebaBundle\Entity\City $cities)
    {
        $this->cities->removeElement($cities);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCities()
    {
        return $this->cities;
    }
}