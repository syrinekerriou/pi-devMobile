<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExamCours
 *
 * @ORM\Table(name="exam_cours")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\ExamCoursRepository")
 */
class ExamCours
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
     * @var \MyBundle\Entity\Cours
     *
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cours", referencedColumnName="id",onDelete="cascade")
     * })
     */
    private $cours;

    /**
     * @var \MyBundle\Entity\Exam
     *
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\Exam")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exam", referencedColumnName="id",onDelete="cascade")
     * })
     */
    private $exam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ExamCours
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
     * Set cours
     *
     * @param \MyBundle\Entity\Cours $cours
     *
     * @return ExamCours
     */
    public function setCours(\MyBundle\Entity\Cours $cours = null)
    {
        $this->cours = $cours;

        return $this;
    }

    /**
     * Get cours
     *
     * @return \MyBundle\Entity\Cours
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * Set exam
     *
     * @param \MyBundle\Entity\Exam $exam
     *
     * @return ExamCours
     */
    public function setExam(\MyBundle\Entity\Exam $exam = null)
    {
        $this->exam = $exam;

        return $this;
    }

    /**
     * Get exam
     *
     * @return \MyBundle\Entity\Exam
     */
    public function getExam()
    {
        return $this->exam;
    }
}
