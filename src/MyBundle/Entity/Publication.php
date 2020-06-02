<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @ORM\Column(name="typep", type="string", length=255)
     */
    private $typep;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionp", type="string", length=10000)
     */
    private $descriptionp;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datep", type="datetime", nullable=false)
     */
    private $datep;



    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typep
     *
     * @param string $typep
     *
     * @return Publication
     */
    public function setTypep($typep)
    {
        $this->typep = $typep;

        return $this;
    }

    /**
     * Get typep
     *
     * @return string
     */
    public function getTypep()
    {
        return $this->typep;
    }

    /**
     * Set descriptionp
     *
     * @param string $descriptionp
     *
     * @return Publication
     */
    public function setDescriptionp($descriptionp)
    {
        $this->descriptionp = $descriptionp;

        return $this;
    }

    /**
     * Get descriptionp
     *
     * @return string
     */
    public function getDescriptionp()
    {
        return $this->descriptionp;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Publication
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set idUser
     *
     * @param \MyBundle\Entity\User $idUser
     *
     * @return Publication
     */
    public function setIdUser(\MyBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \MyBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set datep
     *
     * @param \DateTime $datep
     *
     * @return Publication
     */
    public function setDatep($datep)
    {
        $this->datep = $datep;

        return $this;
    }

    /**
     * Get datep
     *
     * @return \DateTime
     */
    public function getDatep()
    {
        return $this->datep;
    }
}
