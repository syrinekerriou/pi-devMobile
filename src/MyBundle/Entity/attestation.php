<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * attestation
 *
 * @ORM\Table(name="attestation")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\attestationRepository")
 */
class attestation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ida", type="integer",nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $ida;


    /**
     * @var string
     *
     * @ORM\Column(name="typea", type="string", length=255)
     */
    private $typea;

    /**
     * @var string
     *
     * @ORM\Column(name="langue", type="string", length=255)
     */
    private $langue;


    /**
     * Get ida
     *
     * @return int
     */
    public function getIda()
    {
        return $this->ida;
    }

    /**
     * Set typea
     *
     * @param string $typea
     *
     * @return attestation
     */
    public function setTypea($typea)
    {
        $this->typea = $typea;

        return $this;
    }

    /**
     * Get typea
     *
     * @return string
     */
    public function getTypea()
    {
        return $this->typea;
    }

    /**
     * Set langue
     *
     * @param string $langue
     *
     * @return attestation
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return string
     */
    public function getLangue()
    {
        return $this->langue;
    }
    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @return \User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param \User $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
}

