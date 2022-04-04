<?php

namespace App\Entity;

use App\Repository\SuiteRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: SuiteRepository::class)]
#[Vich\Uploadable]
class Suite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'string', length: 255)]
    private string $linkToBookingCom;

    #[Vich\UploadableField(mapping: 'suite_front_images', fileNameProperty: 'frontImageName', size: 'frontImageSize')]
    #[Assert\File(mimeTypes: ['image/jpeg', 'image/png'],mimeTypesMessage: 'Le type de l\'image n\'est pas reconnu (Jpeg, JPG, PNG)')]
    private ?File $frontImageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $frontImageName = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $frontImageSize = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'suite', targetEntity: Gallery::class)]
    private ?ArrayCollection $gallery;

    #[ORM\ManyToOne(targetEntity: Establishment::class, inversedBy: 'suites')]
    #[ORM\JoinColumn(nullable: true)]
    private $establishment;

    public function __construct()
    {
        $this->gallery = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLinkToBookingCom(): ?string
    {
        return $this->linkToBookingCom;
    }

    public function setLinkToBookingCom(string $linkToBookingCom): self
    {
        $this->linkToBookingCom = $linkToBookingCom;

        return $this;
    }

    public function setFrontImageFile(?File $frontImageFile = null): self
    {
        $this->frontImageFile = $frontImageFile;

        if (null !== $frontImageFile) {
            $this->updatedAt = new DateTimeImmutable();
        }
        return $this;
    }

    public function getFrontImageFile(?File $frontImageFile = null): File
    {
        return $this->frontImageFile;
    }

    public function setFrontImageName(?string $frontImageName): self
    {
        $this->frontImageName = $frontImageName;
        return $this;
    }

    public function getFrontImageName(): ?string
    {
        return $this->frontImageName;
    }

    public function setFrontImageSize(?int $frontImageSize): self
    {
        $this->frontImageSize = $frontImageSize;
        return $this;
    }

    public function getFrontImageSize(): ?int
    {
        return $this->frontImageSize;
    }

    /**
     * @return Collection<int, Gallery>
     */
    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    public function addGallery(Gallery $gallery): self
    {
        if (!$this->gallery->contains($gallery)) {
            $this->gallery[] = $gallery;
            $gallery->setSuite($this);
        }

        return $this;
    }

    public function removeGallery(Gallery $gallery): self
    {
        if ($this->gallery->removeElement($gallery)) {
            // set the owning side to null (unless already changed)
            if ($gallery->getSuite() === $this) {
                $gallery->setSuite(null);
            }
        }

        return $this;
    }

    public function getEstablishment(): ?Establishment
    {
        return $this->establishment;
    }

    public function setEstablishment(?Establishment $establishment): self
    {
        $this->establishment = $establishment;

        return $this;
    }
}
