<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName', size: 'imageSize')]
    #[Assert\File(mimeTypes: [
        'image/jpeg',
        'image/png',
    ], mimeTypesMessage: 'Le type de l\'image n\'est pas reconnu (Jpeg, JPG, PNG)', maxSize: 5, maxSizeMessage: 'the max size of an image is 5MB')]
    private ?File $imageFile;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $imageSize;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $updatedAt;

    #[ORM\ManyToOne(targetEntity: Gallery::class, inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private $gallery;

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param UploadedFile|File|null $imageFile
     * @return $this
     */
    public function setImageFile(File|UploadedFile|null $imageFile = null): self
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

    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    public function setGallery(?Gallery $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }
}
