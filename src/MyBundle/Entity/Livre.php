<?php

namespace MyBundle\Entity;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;




/**
 * Livre
 *
 * @ORM\Table(name="livre")
 * @ORM\Entity(repositoryClass="BibliothequeBundle\Repository\BibliothequeRepository")
 * @Vich\Uploadable
 */
class Livre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idlivre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlivre;

    /**
     * @param int $idlivre
     */
    public function setIdlivre($idlivre)
    {
        $this->idlivre = $idlivre;
    }

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="nomlivre", type="string", length=255, nullable=false)
     */
    private $nomlivre;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="auteurlivre", type="string", length=255, nullable=false)
     */
    private $auteurlivre;

    /**
     * @var \DateTime
     * @Assert\NotBlank
     * @ORM\Column(name="datelivre", type="date", nullable=false)
     */
    private $datelivre;

    /**
     * @var integer
     * @Assert\NotBlank
     * @ORM\Column(name="prixlivre", type="integer", precision=10, scale=0, nullable=false)
     */
    private $prixlivre;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="contenu", type="string", length=255, nullable=false)
     */
    private $contenu;

    /**
     * @var integer
     * @Assert\NotBlank
     * @ORM\Column(name="quantitelivre", type="string", nullable=true)
     */
    private $quantitelivre;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="livre", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;




    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */

    public function setImageFile(File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            //$this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageName(string $imageName)
    {
        $this->imageName = $imageName;
    }

    public function getImageName()
    {
        return $this->imageName;
    }









    /**
     * @return int
     */
    public function getQuantitelivre()
    {
        return $this->quantitelivre;
    }

    /**
     * @param int $quantitelivre
     */
    public function setQuantitelivre($quantitelivre)
    {
        $this->quantitelivre = $quantitelivre;
    }



    /**
     * Get idlivre
     *
     * @return integer
     */
    public function getIdlivre()
    {
        return $this->idlivre;
    }

    /**
     * Set nomlivre
     *
     * @param string $nomlivre
     *
     * @return Livre
     */
    public function setNomlivre($nomlivre)
    {
        $this->nomlivre = $nomlivre;

        return $this;
    }

    /**
     * Get nomlivre
     *
     * @return string
     */
    public function getNomlivre()
    {
        return $this->nomlivre;
    }

    /**
     * Set auteurlivre
     *
     * @param string $auteurlivre
     *
     * @return Livre
     */
    public function setAuteurlivre($auteurlivre)
    {
        $this->auteurlivre = $auteurlivre;

        return $this;
    }

    /**
     * Get auteurlivre
     *
     * @return string
     */
    public function getAuteurlivre()
    {
        return $this->auteurlivre;
    }

    /**
     * Set datelivre
     *
     * @param \DateTime $datelivre
     *
     * @return Livre
     */
    public function setDatelivre($datelivre)
    {
        $this->datelivre = $datelivre;

        return $this;
    }

    /**
     * Get datelivre
     *
     * @return \DateTime
     */
    public function getDatelivre()
    {
        return $this->datelivre;
    }

    /**
     * Set prixlivre
     *
     * @param float $prixlivre
     *
     * @return Livre
     */
    public function setPrixlivre($prixlivre)
    {
        $this->prixlivre = $prixlivre;

        return $this;
    }

    /**
     * Get prixlivre
     *
     * @return integer
     */
    public function getPrixlivre()
    {
        return $this->prixlivre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Livre
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

}
