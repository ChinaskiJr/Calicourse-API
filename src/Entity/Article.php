<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put", "delete"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * The title of the article.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * A little comment about the article (where to find it in the store, quantity ?)
     *
     * @ORM\Column(type="text", length=2048, nullable=true)
     */
    private $comment;

    /**
     * A boolean. Has it been bought yet ?
     *
     * @ORM\Column(type="boolean")
     */
    private $bought;

    /**
     * A boolean. Do we still want it on the list memo ?
     *
     * @ORM\Column(type="boolean")
     */
    private $archived;

    /**
     * When was this article created ?
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * When was this article last bought ?
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $boughtAt;

    /**
     * To what shop is this article related ?
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop", inversedBy="articles")
     */
    private $shop;

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

    public function getBought(): ?bool
    {
        return $this->bought;
    }

    public function setBought(bool $bought): self
    {
        $this->bought = $bought;

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBoughtAt(): ?\DateTimeInterface
    {
        return $this->boughtAt;
    }

    public function setBoughtAt(?\DateTimeInterface $boughtAt): self
    {
        $this->boughtAt = $boughtAt;

        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment): void
    {
        $this->comment = $comment;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }
}
