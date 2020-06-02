<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\ParticipationRepository")
 */
class Participation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idUser;

    /**
     * @var \MyBundle\Entity\Evenement
     *
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEvent", referencedColumnName="id", nullable=true)
     * })
     */
    private $idEvent;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Participation
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idEvent
     *
     * @param \MyBundle\Entity\Evenement $idEvent
     *
     * @return Participation
     */
    public function setIdEvent(\MyBundle\Entity\Evenement $idEvent )
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    /**
     * Get idEvent
     *
     * @return \MyBundle\Entity\Evenement
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }
}
