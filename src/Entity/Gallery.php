<?php

namespace App\Entity;

use App\Repository\GalleryRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
#[Vich\Uploadable]
class Gallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[Vich\UploadableField(mapping: 'suite_gallery_images', fileNameProperty: 'imageName', size: 'imageSize', mimeType: 'image/jpeg|image/png')]
    #[Assert\File(mimeTypes: ['image/jpeg', 'image/png'],mimeTypesMessage: 'Le type de l\'image n\'est pas reconnu (Jpeg, JPG, PNG)')]
    private ?File $imageFile;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $imageSize;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $updatedAt;

    #[ORM\ManyToOne(targetEntity: Suite::class, inversedBy: 'gallery')]
    private $suite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

   public function setImageFile(?File $imageFile = null): self
   {
       $this->imageFile = $imageFile;

       if (null !== $imageFile) {
           $this->updatedAt = new DateTimeImmutable();
       }
       return $this;
   }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): self
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    public function getSuite(): ?Suite
    {
        return $this->suite;
    }

    public function setSuite(?Suite $suite): self
    {
        $this->suite = $suite;

        return $this;
    }
}
