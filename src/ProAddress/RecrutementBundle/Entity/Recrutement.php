<?php

namespace ProAddress\RecrutementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recrutement
 *
 * @ORM\Table(name="recrutement")
 * @ORM\Entity(repositoryClass="ProAddress\RecrutementBundle\Repository\RecrutementRepository")
 */
class Recrutement
{
    /**
     * @ORM\ManyToOne(targetEntity="ProAddress\AppBundle\Entity\Pays", inversedBy="recrutements", cascade={"persist"})
     * @ORM\JoinColumn(name="pays_id", referencedColumnName="id")
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
     * @ORM\Column(name="date", type="datetime")
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
     * @ORM\Column(name="poste", type="string", length=255)
     */
    private $poste;

    /**
     * @var string
     *
     * @ORM\Column(name="dossier", type="string", length=255)
     */
    private $dossier;

    /**
     * @var string
     *
     * @ORM\Column(name="lieudepot", type="string", length=255)
     */
    private $lieudepot;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expireDate", type="datetime")
     */
    private $expireDate;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuTravail", type="string", length=255)
     */
    private $lieuTravail;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=100)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="telCandidat", type="string", length=100)
     */
    private $telCandidat;

    /**
     * @var string
     *
     * @ORM\Column(name="structure", type="string", length=255)
     */
    private $structure;

    /**
     * @var string
     *
     * @ORM\Column(name="eenvoie", type="string", length=255)
     */
    private $eenvoie;

    /**
     * @var string
     *
     * @ORM\Column(name="envoieEmail", type="string", length=255)
     */
    private $envoieEmail;


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
     * @return Recrutement
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
     * @return Recrutement
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
     * Set poste
     *
     * @param string $poste
     *
     * @return Recrutement
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set dossier
     *
     * @param string $dossier
     *
     * @return Recrutement
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return string
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set lieudepot
     *
     * @param string $lieudepot
     *
     * @return Recrutement
     */
    public function setLieudepot($lieudepot)
    {
        $this->lieudepot = $lieudepot;

        return $this;
    }

    /**
     * Get lieudepot
     *
     * @return string
     */
    public function getLieudepot()
    {
        return $this->lieudepot;
    }

    /**
     * Set expireDate
     *
     * @param \DateTime $expireDate
     *
     * @return Recrutement
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;

        return $this;
    }

    /**
     * Get expireDate
     *
     * @return \DateTime
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Set lieuTravail
     *
     * @param string $lieuTravail
     *
     * @return Recrutement
     */
    public function setLieuTravail($lieuTravail)
    {
        $this->lieuTravail = $lieuTravail;

        return $this;
    }

    /**
     * Get lieuTravail
     *
     * @return string
     */
    public function getLieuTravail()
    {
        return $this->lieuTravail;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Recrutement
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

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Recrutement
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set telCandidat
     *
     * @param string $telCandidat
     *
     * @return Recrutement
     */
    public function setTelCandidat($telCandidat)
    {
        $this->telCandidat = $telCandidat;

        return $this;
    }

    /**
     * Get telCandidat
     *
     * @return string
     */
    public function getTelCandidat()
    {
        return $this->telCandidat;
    }

    /**
     * Set structure
     *
     * @param string $structure
     *
     * @return Recrutement
     */
    public function setStructure($structure)
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * Get structure
     *
     * @return string
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * Set eenvoie
     *
     * @param string $eenvoie
     *
     * @return Recrutement
     */
    public function setEenvoie($eenvoie)
    {
        $this->eenvoie = $eenvoie;

        return $this;
    }

    /**
     * Get eenvoie
     *
     * @return string
     */
    public function getEenvoie()
    {
        return $this->eenvoie;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Recrutement
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
     * Set envoieEmail
     *
     * @param string $envoieEmail
     *
     * @return Recrutement
     */
    public function setEnvoieEmail($envoieEmail)
    {
        $this->envoieEmail = $envoieEmail;

        return $this;
    }

    /**
     * Get envoieEmail
     *
     * @return string
     */
    public function getEnvoieEmail()
    {
        return $this->envoieEmail;
    }
}
