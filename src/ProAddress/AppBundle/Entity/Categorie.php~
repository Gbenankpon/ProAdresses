<?php

namespace ProAddress\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="ProAddress\AppBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\OneToMany(targetEntity="ProAddress\AppBundle\Entity\Structure", mappedBy="categorie", cascade={"remove"})
     * @ORM\JoinColumn(name="structure_id", referencedColumnName="id")
     */
    private $structures;

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
        $this->structures = new ArrayCollection();
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
     * Add structure
     *
     * @param \ProAddress\AppBundle\Entity\Structure $structure
     *
     * @return Categorie
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
}
