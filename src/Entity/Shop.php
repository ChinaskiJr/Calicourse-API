<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put", "delete"},
 *     normalizationContext={"groups"={"shop:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"shop:write"}, "swagger_definition_name"="Write"}
 * )
 *  @ORM\Entity(repositoryClass="App\Repository\ShopRepository")
 */
class Shop
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * The name of the shop.
     *
     * @ORM\Column(type="string", length=255),
     * @Groups({"shop:read", "shop:write"})
     */
    private $name;

    /**
     * The articles linked to this shop.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="shop"),
     * @Groups({"shop:read", "shop:write"})
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setShop($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getShop() === $this) {
                $article->setShop(null);
            }
        }

        return $this;
    }
}
