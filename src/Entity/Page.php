<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank(
     *     message="Vous ne pouvez pas saisir un titre vide."
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 40,
     *      minMessage = "Votre titre doit contenir au minimum {{ limit }} caractères.",
     *      maxMessage = "Votre titre ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message="Veuillez saisir un contenu."
     * )
     * @Assert\Length(
     *      min = 5,
     *      minMessage = "Votre contenu doit contenir au minimum {{ limit }} caractères.",
     * )
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgSrc;

    /**
     * @ORM\Column(type="integer")
     */
    private $authorId;

    /**
     * @ORM\Column(type="date")
     */
    private $publishedDate;

    public function __construct()
    {
        $this->publishedDate = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImgSrc(): ?string
    {
        return $this->imgSrc;
    }

    public function setImgSrc(string $imgSrc): self
    {
        $this->imgSrc = $imgSrc;

        return $this;
    }

    public function getAuthorId(): ?int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    public function setPublishedDate($publishedDate): self
    {
        $this->publishedDate = $publishedDate;

        return $this;
    }
}
