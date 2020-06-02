<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_pub", columns={"idPublication"}), @ORM\Index(name="fk_user1", columns={"idUser"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idc;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionc", type="string", length=255, nullable=false)
     */
    private $descriptionc;

    /**
     * @var string
     *
     * @ORM\Column(name="typec", type="string", length=255, nullable=true)
     */
    private $typec;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datec", type="date", nullable=false)
     */
    private $datec;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPublication", type="integer", nullable=false)
     */
    private $idpublication;

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
     * Get idc
     *
     * @return integer
     */
    public function getIdc()
    {
        return $this->idc;
    }

    /**
     * Set descriptionc
     *
     * @param string $descriptionc
     *
     * @return Commentaire
     */
    public function setDescriptionc($descriptionc)
    {
        $this->descriptionc = $descriptionc;

        return $this;
    }

    /**
     * Get descriptionc
     *
     * @return string
     */
    public function getDescriptionc()
    {
        return $this->descriptionc;
    }

    /**
     * Set typec
     *
     * @param string $typec
     *
     * @return Commentaire
     */
    public function setTypec($typec)
    {
        $this->typec = $typec;

        return $this;
    }

    /**
     * Get typec
     *
     * @return string
     */
    public function getTypec()
    {
        return $this->typec;
    }

    /**
     * Set datec
     *
     * @param \DateTime $datec
     *
     * @return Commentaire
     */
    public function setDatec($datec)
    {
        $this->datec = $datec;

        return $this;
    }

    /**
     * Get datec
     *
     * @return \DateTime
     */
    public function getDatec()
    {
        return $this->datec;
    }

    /**
     * Set idpublication
     *
     * @param integer $idpublication
     *
     * @return Commentaire
     */
    public function setIdpublication($idpublication)
    {
        $this->idpublication = $idpublication;

        return $this;
    }

    /**
     * Get idpublication
     *
     * @return integer
     */
    public function getIdpublication()
    {
        return $this->idpublication;
    }

    /**
     * Set iduser
     *
     * @param \MyBundle\Entity\User $iduser
     *
     * @return Commentaire
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
