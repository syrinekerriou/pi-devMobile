<?php

namespace MyBundle\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity(repositoryClass="MyBundle\Repository\CoursRepository")
 * @Vich\Uploadable
 */
class Cours
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
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $PDFName;

    /**
     *
     * @Vich\UploadableField(mapping="CoursPDF", fileNameProperty="PDFName")
     *
     * @var File|null
     */
    private $PDFFile;



    /**
     * @ORM\Column(type="datetime")
     *
     * @var DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @param File|UploadedFile $PDFFile
     *
     * @return Cours
     */
    public function setPDFFile(File $PDFFile = null)
    {
        $this->PDFFile = $PDFFile;

        if ($PDFFile)
            $this->updatedAt = new DateTimeImmutable();


    }

    /**
     * @return File|null
     */
    public function getPDFFile()
    {
        return $this->PDFFile;
    }

    /**
     * @param string $PDFName
     *
     * @return Cours
     */
    public function setPDFName($PDFName)
    {
        $this->PDFName = $PDFName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPDFName()
    {
        return $this->PDFName;
    }


    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $imageName;


    /**
     *
     * @Vich\UploadableField(mapping="CoursImage", fileNameProperty="imageName")
     *
     * @var File|null
     */
    private $imageFile;





    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $imageFile
     * @return Cours
     */

    public function setImageFile(File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new DateTimeImmutable();
        }
    }
    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Cours
     */
    public function setImageName(string $imageName)
    {
        $this->imageName = $imageName;
    }


    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }











    /**
     * @var string
     *
     * @ORM\Column(name="titreCours", type="string", length=255, nullable=true)
     */
    private $titreCours;

    /**
     * @var string
     *
     * @ORM\Column(name="matiere", type="string", length=255, nullable=true)
     */
    private $matiere;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=255)
     */
    private $duree;


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
     * Set titreCours
     *
     * @param string $titreCours
     *
     * @return Cours
     */
    public function setTitreCours($titreCours)
    {
        $this->titreCours = $titreCours;

        return $this;
    }

    /**
     * Get titreCours
     *
     * @return string
     */
    public function getTitreCours()
    {
        return $this->titreCours;
    }

    /**
     * Set matiere
     *
     * @param string $matiere
     *
     * @return Cours
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get matiere
     *
     * @return string
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Cours
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }
    public function __toString()
    {
        return (string) $this->getId();
    }
}

