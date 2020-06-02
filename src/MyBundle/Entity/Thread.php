<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Thread as BaseThread;

/**
 * Thread
 *
 * @ORM\Table(name="thread")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\ThreadRepository")
 */
class Thread extends BaseThread
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
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $createdBy;

    /**
     * @ORM\OneToMany(
     *   targetEntity="MyBundle\Entity\Message",
     *   mappedBy="thread"
     * )
     * @var Message[]|Collection
     */
    protected $messages;

    /**
     * @ORM\OneToMany(
     *   targetEntity="MyBundle\Entity\ThreadMetadata",
     *   mappedBy="thread",
     *   cascade={"all"}
     * )
     * @var ThreadMetadata[]|Collection
     */
    protected $metadata;

    /**
     * Remove message
     *
     * @param \MyBundle\Entity\Message $message
     */
    public function removeMessage(\MyBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Add metadatum
     *
     * @param \MyBundle\Entity\ThreadMetadata $metadatum
     *
     * @return Thread
     */
    public function addMetadatum(\MyBundle\Entity\ThreadMetadata $metadatum)
    {
        $this->metadata[] = $metadatum;

        return $this;
    }

    /**
     * Remove metadatum
     *
     * @param \MyBundle\Entity\ThreadMetadata $metadatum
     */
    public function removeMetadatum(\MyBundle\Entity\ThreadMetadata $metadatum)
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
