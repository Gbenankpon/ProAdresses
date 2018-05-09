<?php

namespace ProAddress\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="ProAddress\AppBundle\Repository\PaysRepository")
 */
class Pays
{
    /**
     * @ORM\OneToMany(targetEntity="ProAddress\AppBundle\Entity\Structure", mappedBy="pays", cascade={"remove"})
     */
    private $structures;

    /**
     * @ORM\OneToMany(targetEntity="ProAddress\ServiceBundle\Entity\Service", mappedBy="pays", cascade={"remove"})
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="ProAddress\RecrutementBundle\Entity\Recrutement", mappedBy="pays", cascade={"remove"})
     */
    private $recrutements;

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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=2)
     */
    private $code;


    public function __construct()
    {
        $this->structures = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->recrutements = new ArrayCollection();
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
     * @return Pays
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
     * Set code
     *
     * @param string $code
     *
     * @return Pays
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add structure
     *
     * @param \ProAddress\AppBundle\Entity\Structure $structure
     *
     * @return Pays
     */
    public function addStructure(\ProAddress\AppBundle\Entity\Structure $structure)
    {
        $this->structures[] = $structure;

        return $this;
    }

    /**
     * Remove structure
     *
     * @param \ProAddress\AppBundle\Entity\Structure $structure
     */
    public function removeStructure(\ProAddress\AppBundle\Entity\Structure $structure)
    {
        $this->structures->removeElement($structure);
    }

    /**
     * Get structures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStructures()
    {
        return $this->structures;
    }

    /**
     * Add service
     *
     * @param \ProAddress\ServiceBundle\Entity\Service $service
     *
     * @return Pays
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
     * Add recrutement
     *
     * @param \ProAddress\RecrutementBundle\Entity\Recrutement $recrutement
     *
     * @return Pays
     */
    public function addRecrutement(\ProAddress\RecrutementBundle\Entity\Recrutement $recrutement)
    {
        $this->recrutements[] = $recrutement;

        return $this;
    }

    /**
     * Remove recrutement
     *
     * @param \ProAddress\RecrutementBundle\Entity\Recrutement $recrutement
     */
    public function removeRecrutement(\ProAddress\RecrutementBundle\Entity\Recrutement $recrutement)
    {
        $this->recrutements->removeElement($recrutement);
    }

    /**
     * Get recrutements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecrutements()
    {
        return $this->recrutements;
    }
}
