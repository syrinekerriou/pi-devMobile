<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="fk_commande", columns={"idcommande"})})
 * @ORM\Entity
 */
class Livraison
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idlivraison", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlivraison;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcommande", referencedColumnName="idcommande")
     * })
     */
    private $idcommande;




    /**
     * Get idlivraison
     *
     * @return integer
     */
    public function getIdlivraison()
    {
        return $this->idlivraison;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Livraison
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
     * Set idcommande
     *
     * @param \MyBundle\Entity\Commande $idcommande
     *
     * @return Livraison
     */
    public function setIdcommande($idcommande)
    {
        $this->idcommande = $idcommande;

        return $this;
    }

    /**
     * Get idcommande
     *
     * @return \MyBundle\Entity\Commande
     */
    public function getIdcommande()
    {
        return $this->idcommande;
    }
}
