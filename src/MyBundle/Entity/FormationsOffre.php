<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormationsOffre
 *
 * @ORM\Table(name="formations_offre")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\FormationsOffreRepository")
 */
class FormationsOffre
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
     * @var \MyBundle\Entity\Formation
     *
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\Formation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFormation", referencedColumnName="id",onDelete="cascade")
     * })
     */
    private $idFormation;

    /**
     * @var \MyBundle\Entity\Offre
     *
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\Offre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idOffre", referencedColumnName="id",onDelete="cascade")
     * })
     */
    private $idOffre;


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
     * Set idFormation
     *
     * @param \MyBundle\Entity\Formation $idFormation
     *
     * @return FormationsOffre
     */
    public function setIdFormation(\MyBundle\Entity\Formation $idFormation = null)
    {
        $this->idFormation = $idFormation;

        return $this;
    }

    /**
     * Get idFormation
     *
     * @return \MyBundle\Entity\Formation
     */
    public function getIdFormation()
    {
        return $this->idFormation;
    }

    /**
     * Set idOffre
     *
     * @param \MyBundle\Entity\Offre $idOffre
     *
     * @return FormationsOffre
     */
    public function setIdOffre(\MyBundle\Entity\Offre $idOffre = null)
    {
        $this->idOffre = $idOffre;

        return $this;
    }

    /**
     * Get idOffre
     *
     * @return \MyBundle\Entity\Offre
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }
}
