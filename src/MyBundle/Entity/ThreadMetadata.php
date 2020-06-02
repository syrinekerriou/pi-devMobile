<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\ThreadMetadata as BaseThreadMetadata;

/**
 * ThreadMetadata
 *
 * @ORM\Table(name="thread_metadata")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\ThreadMetadataRepository")
 */
class ThreadMetadata extends BaseThreadMetadata
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


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
     * @ORM\ManyToOne(
     *   targetEntity="MyBundle\Entity\Thread",
     *   inversedBy="metadata"
     * )
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $participant;
}
