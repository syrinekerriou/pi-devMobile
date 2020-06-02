<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Message as BaseMessage;
/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\MessageRepository")
 */
class Message extends BaseMessage
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
     *   inversedBy="messages"
     * )
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $sender;

    /**
     * @ORM\OneToMany(
     *   targetEntity="MyBundle\Entity\MessageMetadata",
     *   mappedBy="message",
     *   cascade={"all"}
     * )
     * @var MessageMetadata[]|Collection
     */
    protected $metadata;

    /**
     * Add metadatum
     *
     * @param \MyBundle\Entity\MessageMetadata $metadatum
     *
     * @return Message
     */
    public function addMetadatum(\MyBundle\Entity\MessageMetadata $metadatum)
    {
        $this->metadata[] = $metadatum;

        return $this;
    }

    /**
     * Remove metadatum
     *
     * @param \MyBundle\Entity\MessageMetadata $metadatum
     */
    public function removeMetadatum(\MyBundle\Entity\MessageMetadata $metadatum)
    {
        $this->metadata->removeElement($metadatum);
    }

    /**
     * Get metadata
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
}
