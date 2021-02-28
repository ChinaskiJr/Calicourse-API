<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put", "delete"},
 *     normalizationContext={"groups"={"article:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"article:write"}, "swagger_definition_name"="Write"},
 *     attributes={"order"={"title": "ASC"}}
 * )
 * @ApiFilter(BooleanFilter::class, properties={"bought"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "shop": "exact"
 * })
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"article:read", "shop:read"})
     */
    private $id;

    /**
     * The title of the article.
     *
     * @ORM\Column(type="string", length=255),
     * @Groups({"article:read", "article:write", "shop:read"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Le titre doit faire moins de 255 caractères"
     * )
     */
    private $title;

    /**
     * A little comment about the article (where to find it in the store, quantity ?)
     *
     * @ORM\Column(type="text", length=2048, nullable=true),
     * @Groups({"article:read", "article:write", "shop:read"})
     * @Assert\Length(
     *     max=2048,
     *     maxMessage="Le commentaire doit faire moins de 2048 caractères"
     * )
     */
    private $comment;

    /**
     * A boolean. Has it been bought yet ?
     *
     * @ORM\Column(type="boolean"),
     * @Groups({"article:read", "article:write", "shop:read"})
     */
    private $bought = false;

    /**
     * A boolean. Do we still want it on the list memo ?
     *
     * @ORM\Column(type="boolean"),
     * @Groups({"article:read", "article:write", "shop:read"})
     */
    private $archived = false;

    /**
     * When was this article created ?
     *
     * @ORM\Column(type="datetime"),
     * @Groups({"article:read", "shop:read"})
     */
    private $createdAt;

    /**
     * When was this article last bought ?
     *
     * @ORM\Column(type="datetime", nullable=true),
     * @Groups({"article:read", "article:write", "shop:read"})
     */
    private $boughtAt;

    /**
     * To what shop is this article related ?
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop", inversedBy="articles"),
     * @Groups({"article:read", "article:write"})
     */
    private $shop;

    /**
     * @var MediaObject|null
     *
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @Groups({"article:read", "article:write", "shop:read"})
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     */
    private $image;

    /**
     * Article constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
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

    /**
     * @return MediaObject|null
     */
    public function getImage(): ?MediaObject
    {
        return $this->image;
    }

    /**
     * @param MediaObject|null $image
     */
    public function setImage(?MediaObject $image): void
    {
        $this->image = $image;
    }
}
