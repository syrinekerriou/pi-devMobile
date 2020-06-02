<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="fk_user4", columns={"idUser"})})
 * @ORM\Entity(repositoryClass="serviceBundle\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ids", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ids;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

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
     * Get ids
     *
     * @return integer
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param int $ids
     */
    public function setIds($ids)
    {
        $this->ids = $ids;
    }


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Service
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Service
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
     * Set iduser
     *
     * @param \MyBundle\Entity\User $iduser
     *
     * @return Service
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


    /**
     * @var \attestation
     *
     * @ORM\ManyToOne(targetEntity="attestation")
     * @ORM\JoinColumn(name="ida", referencedColumnName="ida")
     */
    private $ida;

    /**
     * Get ida
     *
     * @return \MyBundle\Entity\attestation
     */
    public function getIda()
    {
        return $this->ida;
    }

    /**
     * Set ida
     *
     * @param \MyBundle\Entity\attestation $ida
     * @return Service
     */
    public function setIda(\MyBundle\Entity\attestation $ida = null)
    {
        $this->ida = $ida;
        return $this;
    }




}
