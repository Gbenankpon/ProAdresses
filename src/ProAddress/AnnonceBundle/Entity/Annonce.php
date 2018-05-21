<?php

namespace ProAddress\AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="ProAddress\AnnonceBundle\Repository\AnnonceRepository")
 */
class Annonce
{

    /**
     * @ORM\ManyToOne(targetEntity="ProAddress\AnnonceBundle\Entity\ACategorie", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    private $acategorie;

    /**
     * @ORM\ManyToOne(targetEntity="ProAddress\AppBundle\Entity\Pays", inversedBy="annonces", cascade={"persist"})
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text")
     */
    private $detail;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration", type="datetime", nullable=true)
     */
    private $expiration;


    public function __construct()
    {
        $this->date = new \DateTime();
        $this->pays = new ArrayCollection();
       // $this->acategories = new ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Annonce
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set detail
     *
     * @param string $detail
     *
     * @return Annonce
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
     * Set prix
     *
     * @param integer $prix
     *
     * @return Annonce
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return Annonce
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
     * Set expiration
     *
     * @param \DateTime $expiration
     *
     * @return Annonce
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * Get expiration
     *
     * @return \DateTime
     */
    public function getExpiration()
    {
        return $this->expiration;
    }


    /**
     * Set acategorie
     *
     * @param \ProAddress\AnnonceBundle\Entity\ACategorie $acategorie
     *
     * @return Annonce
     */
    public function setAcategorie(\ProAddress\AnnonceBundle\Entity\ACategorie $acategorie)
    {
        $this->acategorie = $acategorie;

        return $this;
    }

    /**
     * Get acategorie
     *
     * @return \ProAddress\AnnonceBundle\Entity\ACategorie
     */
    public function getAcategorie()
    {
        return $this->acategorie;
    }
    

    /**
     * Add pay
     *
     * @param \ProAddress\AppBundle\Entity\Pays $pay
     *
     * @return Annonce
     */
    public function addPay(\ProAddress\AppBundle\Entity\Pays $pay)
    {
        $this->pays[] = $pay;

        return $this;
    }

    /**
     * Remove pay
     *
     * @param \ProAddress\AppBundle\Entity\Pays $pay
     */
    public function removePay(\ProAddress\AppBundle\Entity\Pays $pay)
    {
        $this->pays->removeElement($pay);
    }

    /**
     * Get pays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set pays
     *
     * @param \ProAddress\AppBundle\Entity\Pays $pays
     *
     * @return Annonce
     */
    public function setPays(\ProAddress\AppBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }
}
