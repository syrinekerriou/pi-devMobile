<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\FormationRepository")
 */
class Formation
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
     * @ORM\Column(name="nomFormation", type="string", length=255)
     */
    private $nomFormation;

    /**
     * @return string
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="matiere", type="string", length=255)
     */
    private $matiere;

    /**
     * @param int $id
     */
    public function setId($id)
    {

        $this->id = $id;
    }

    /**
     * @param string $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }

    /**
     * @var \MyBundle\Entity\Cours
     *
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\Cours" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="coursId", referencedColumnName="id",onDelete="cascade")
     * })
     */
    private $coursId;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=255)
     */
    private $duree;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;


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
     * Set nomFormation
     *
     * @param string $nomFormation
     *
     * @return Formation
     */
    public function setNomFormation($nomFormation)
    {
        $this->nomFormation = $nomFormation;

        return $this;
    }

    /**
     * Get nomFormation
     *
     * @return string
     */
    public function getNomFormation()
    {
        return $this->nomFormation;
    }


    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Formation
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Formation
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }



    /**
     * Set coursId
     *
     * @param \MyBundle\Entity\Cours $coursId
     *
     * @return Formation
     */
    public function setCoursId(\MyBundle\Entity\Cours $coursId = null)
    {
        $this->coursId = $coursId;

        return $this;
    }

    /**
     * Get coursId
     *
     * @return \MyBundle\Entity\Cours
     */
    public function getCoursId()
    {
        return $this->coursId;
    }
}
