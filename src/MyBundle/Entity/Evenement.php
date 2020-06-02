<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
     * @var string
     *
     * @ORM\Column(name="nomevent", type="string", length=255)
     */
    private $nomevent;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \MyBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEnseignant", referencedColumnName="id",onDelete="cascade")
     * })
     */
    private $idEnseignant;


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
     * @return Evenement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getNomevent()
    {
        return $this->nomevent;
    }

    /**
     * @param string $nomevent
     */
    public function setNomevent($nomevent)
    {
        $this->nomevent = $nomevent;
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
     * Set description
     *
     * @param string $description
     *
     * @return Evenement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Set idEnseignant
     *
     * @param \MyBundle\Entity\User $idEnseignant
     *
     * @return Evenement
     */
    public function setIdEnseignant(\MyBundle\Entity\User $idEnseignant = null)
    {
        $this->idEnseignant = $idEnseignant;

        return $this;
    }

    /**
     * Get idEnseignant
     *
     * @return \MyBundle\Entity\User
     */
    public function getIdEnseignant()
    {
        return $this->idEnseignant;
    }
}
