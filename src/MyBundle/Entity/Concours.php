<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concours
 *
 * @ORM\Table(name="concours", indexes={@ORM\Index(name="fk_user5", columns={"idUser"})})
 * @ORM\Entity
 */
class Concours
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcn", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcn;

    /**
     * @var string
     *
     * @ORM\Column(name="test", type="string", length=255, nullable=false)
     */
    private $test;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecn", type="date", nullable=false)
     */
    private $datecn;

    /**
     * @var string
     *
     * @ORM\Column(name="section", type="string", length=255, nullable=false)
     */
    private $section;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     */
    private $iduser;


}

