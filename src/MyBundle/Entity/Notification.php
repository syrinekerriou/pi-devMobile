<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Entity\NotificationInterface;
use Mgilet\NotificationBundle\Model\Notification as NotificationModel;

/**
 * Notification
 * @ORM\Entity
 * @package Acme\Entity
 */
class Notification extends NotificationModel implements NotificationInterface
{
}

