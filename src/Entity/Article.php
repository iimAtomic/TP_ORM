<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createDate = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    /**
     * @var Collection<int, Illustration>
     */
    #[ORM\OneToMany(targetEntity: Illustration::class, mappedBy: 'article_illustration')]
    private Collection $illustrations;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AfpDispatch $afpDispatch = null;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'articles')]
    private Collection $tags;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'articles')]
    private Collection $article_tag;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'article_tag')]
    private Collection $articles;

    public function __construct()
    {
        $this->illustrations = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->article_tag = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTimeInterface $createDate): static
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, Illustration>
     */
    public function getIllustrations(): Collection
    {
        return $this->illustrations;
    }

    public function addIllustration(Illustration $illustration): static
    {
        if (!$this->illustrations->contains($illustration)) {
            $this->illustrations->add($illustration);
            $illustration->setArticleIllustration($this);
        }

        return $this;
    }

    public function removeIllustration(Illustration $illustration): static
    {
        if ($this->illustrations->removeElement($illustration)) {
            // set the owning side to null (unless already changed)
            if ($illustration->getArticleIllustration() === $this) {
                $illustration->setArticleIllustration(null);
            }
        }

        return $this;
    }

    public function getAfpDispatch(): ?AfpDispatch
    {
        return $this->afpDispatch;
    }

    public function setAfpDispatch(?AfpDispatch $afpDispatch): static
    {
        $this->afpDispatch = $afpDispatch;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addArticle($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getArticleTag(): Collection
    {
        return $this->article_tag;
    }

    public function addArticleTag(self $articleTag): static
    {
        if (!$this->article_tag->contains($articleTag)) {
            $this->article_tag->add($articleTag);
        }

        return $this;
    }

    public function removeArticleTag(self $articleTag): static
    {
        $this->article_tag->removeElement($articleTag);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(self $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->addArticleTag($this);
        }

        return $this;
    }

    public function removeArticle(self $article): static
    {
        if ($this->articles->removeElement($article)) {
            $article->removeArticleTag($this);
        }

        return $this;
    }
}
