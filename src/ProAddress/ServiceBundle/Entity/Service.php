<?php

namespace ProAddress\ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="ProAddress\ServiceBundle\Repository\ServiceRepository")
 */
class Service
{

    /**
     * @ORM\ManyToMany(targetEntity="ProAddress\ServiceBundle\Entity\SCategorie", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    private $scategories;

    /**
     * @ORM\ManyToOne(targetEntity="ProAddress\AppBundle\Entity\Pays", inversedBy="services", cascade={"persist"})
     */
    private $pays;

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
     * @ORM\Column(name="entreprise", type="string", length=255)
     */
    private $entreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=255)
     */
    private $specialite;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;

    /**
     * @var string
     *
     * @ORM\Column(name="nomrespo", type="string", length=255, nullable=true)
     */
    private $nomrespo;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="online", type="boolean", nullable=true)
     */
    private $online;


    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->date = new \DateTime();
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
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return Service
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return string
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set specialite
     *
     * @param string $specialite
     *
     * @return Service
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Service
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return Service
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set detail
     *
     * @param string $detail
     *
     * @return Service
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set nomrespo
     *
     * @param string $nomrespo
     *
     * @return Service
     */
    public function setNomrespo($nomrespo)
    {
        $this->nomrespo = $nomrespo;

        return $this;
    }

    /**
     * Get nomrespo
     *
     * @return string
     */
    public function getNomrespo()
    {
        return $this->nomrespo;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Service
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set online
     *
     * @param boolean $online
     *
     * @return Service
     */
    public function setOnline($online)
    {
        $this->online = $online;

        return $this;
    }

    /**
     * Get online
     *
     * @return bool
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Add scategory
     *
     * @param \ProAddress\ServiceBundle\Entity\SCategorie $scategory
     *
     * @return Service
     */
    public function addScategory(\ProAddress\ServiceBundle\Entity\SCategorie $scategory)
    {
        $this->scategories[] = $scategory;

        return $this;
    }

    /**
     * Remove scategory
     *
     * @param \ProAddress\ServiceBundle\Entity\SCategorie $scategory
     */
    public function removeScategory(\ProAddress\ServiceBundle\Entity\SCategorie $scategory)
    {
        $this->scategories->removeElement($scategory);
    }

    /**
     * Get scategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScategories()
    {
        return $this->scategories;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Service
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
