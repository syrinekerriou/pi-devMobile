<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="fk_user3", columns={"idUser"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idr;

    /**
     * @var string
     *
     * @ORM\Column(name="nomr", type="string", length=255, nullable=false)
     */
    private $nomr;

    /**
     * @var string
     *
     * @ORM\Column(name="sujetr", type="string", length=255, nullable=false)
     */
    private $sujetr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dater", type="date", nullable=false)
     */
    private $dater;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;



    /**
     * Get idr
     *
     * @return integer
     */
    public function getIdr()
    {
        return $this->idr;
    }

    /**
     * Set nomr
     *
     * @param string $nomr
     *
     * @return Reclamation
     */
    public function setNomr($nomr)
    {
        $this->nomr = $nomr;

        return $this;
    }

    /**
     * Get nomr
     *
     * @return string
     */
    public function getNomr()
    {
        return $this->nomr;
    }

    /**
     * Set sujetr
     *
     * @param string $sujetr
     *
     * @return Reclamation
     */
    public function setSujetr($sujetr)
    {
        $this->sujetr = $sujetr;

        return $this;
    }

    /**
     * Get sujetr
     *
     * @return string
     */
    public function getSujetr()
    {
        return $this->sujetr;
    }

    /**
     * Set dater
     *
     * @param \DateTime $dater
     *
     * @return Reclamation
     */
    public function setDater($dater)
    {
        $this->dater = $dater;

        return $this;
    }

    /**
     * Get dater
     *
     * @return \DateTime
     */
    public function getDater()
    {
        return $this->dater;
    }

    /**
     * Set iduser
     *
     * @param \MyBundle\Entity\User $iduser
     *
     * @return Reclamation
     */
    public function setIduser(\MyBundle\Entity\User $iduser = null)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return \MyBundle\Entity\User
     */
    public function getIduser()
    {
        return $this->iduser;
    }
}
