<?php

namespace ProAddress\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * SCategorie
 *
 * @ORM\Table(name="scategorie")
 * @ORM\Entity(repositoryClass="ProAddress\ServiceBundle\Repository\SCategorieRepository")
 */
class SCategorie
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;


    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Add service
     *
     * @param \ProAddress\ServiceBundle\Entity\Service $service
     *
     * @return Categorie
     */
    public function addService(\ProAddress\ServiceBundle\Entity\Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \ProAddress\ServiceBundle\Entity\Service $service
     */
    public function removeService(\ProAddress\ServiceBundle\Entity\Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set services
     *
     * @param \ProAddress\ServiceBundle\Entity\Service $services
     *
     * @return SCategorie
     */
    public function setServices(\ProAddress\ServiceBundle\Entity\Service $services = null)
    {
        $this->services = $services;

        return $this;
    }
}
