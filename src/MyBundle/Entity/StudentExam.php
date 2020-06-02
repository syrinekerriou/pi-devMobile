<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudentExam
 *
 * @ORM\Table(name="student_exam")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\StudentExamRepository")
 */
class StudentExam
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
     * @var \MyBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="student", referencedColumnName="id",onDelete="cascade")
     * })
     */
    private $student;

    /**
     * @var \MyBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="MyBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exam", referencedColumnName="id",onDelete="cascade")
     * })
     */
    private $exam;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float")
     */
    private $note;


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
     * Set note
     *
     * @param float $note
     *
     * @return StudentExam
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }



    /**
     * Set student
     *
     * @param \MyBundle\Entity\User $student
     *
     * @return StudentExam
     */
    public function setStudent(\MyBundle\Entity\User $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \MyBundle\Entity\User
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set exam
     *
     * @param \MyBundle\Entity\User $exam
     *
     * @return StudentExam
     */
    public function setExam(\MyBundle\Entity\User $exam = null)
    {
        $this->exam = $exam;

        return $this;
    }

    /**
     * Get exam
     *
     * @return \MyBundle\Entity\User
     */
    public function getExam()
    {
        return $this->exam;
    }
}
