<?php
// src/AppBundle/Entity/User.php

namespace MyBundle\Entity;

use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="BibliothequeBundle\Repository\BibliothequeRepository")
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbp", type="integer", nullable=true)
     */
    private $nbp;
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenaissance", type="date", nullable=true)
     */
    private $datenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="section", type="string", length=255, nullable=true)
     */
    private $section;

    /**
     * @var string
     *
     * @ORM\Column(name="circuit", type="string", length=255, nullable=true)
     */
    private $circuitscolaire;

    /**
     * @var string
     *
     * @ORM\Column(name="diplome", type="string", length=255, nullable=true)
     */
    private $diplome;

    /**
     * @var string
     *
     * @ORM\Column(name="formation", type="string", length=255, nullable=true)
     */
    private $formation;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrheure", type="integer", nullable=true)
     */
    private $nbrheure;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=255, nullable=true)
     */
    private $specialite;

    /**
     * @var integer
     *
     * @ORM\Column(name="frais", type="float", precision=10, scale=0, nullable=true)
     */
    private $frais;

    /**
     * @var float
     *
     * @ORM\Column(name="salaire", type="float", precision=10, scale=0, nullable=true)
     */
    private $salaire;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     *
     * @return User
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set section
     *
     * @param string $section
     *
     * @return User
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set diplome
     *
     * @param string $diplome
     *
     * @return User
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * Get diplome
     *
     * @return string
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * Set nbrheure
     *
     * @param integer $nbrheure
     *
     * @return User
     */
    public function setNbrheure($nbrheure)
    {
        $this->nbrheure = $nbrheure;

        return $this;
    }

    /**
     * Get nbrheure
     *
     * @return integer
     */
    public function getNbrheure()
    {
        return $this->nbrheure;
    }

    /**
     * Set specialite
     *
     * @param string $specialite
     *
     * @return User
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
     * Set frais
     *
     * @param float $frais
     *
     * @return User
     */
    public function setFrais($frais)
    {
        $this->frais = $frais;

        return $this;
    }

    /**
     * Get frais
     *
     * @return float
     */
    public function getFrais()
    {
        return $this->frais;
    }

    /**
     * Set salaire
     *
     * @param float $salaire
     *
     * @return User
     */
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;

        return $this;
    }

    /**
     * Get salaire
     *
     * @return float
     */
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * Set circuitscolaire
     *
     * @param string $circuitscolaire
     *
     * @return User
     */
    public function setCircuitscolaire($circuitscolaire)
    {
        $this->circuitscolaire = $circuitscolaire;

        return $this;
    }

    /**
     * Get circuitscolaire
     *
     * @return string
     */
    public function getCircuitscolaire()
    {
        return $this->circuitscolaire;
    }

    /**
     * Set formation
     *
     * @param string $formation
     *
     * @return User
     */
    public function setFormation($formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return string
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Set nbp
     *
     * @param integer $nbp
     *
     * @return User
     */
    public function setNbp($nbp)
    {
        $this->nbp = $nbp;

        return $this;
    }

    /**
     * Get nbp
     *
     * @return integer
     */
    public function getNbp()
    {
        return $this->nbp;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}
