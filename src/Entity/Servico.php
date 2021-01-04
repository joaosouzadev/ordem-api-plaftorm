<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ServicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"servico:get", "swagger_definition_name"="servico_leitura"}},
 *     denormalizationContext={"groups"={"servico:post", "swagger_definition_name"="servico_escrita"}}
 * )
 * @ORM\Entity(repositoryClass=ServicoRepository::class)
 */
class Servico
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"servico:get", "servico:post"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="servicos")
     * @ORM\JoinColumn()
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"servico:get", "servico:post"})
     */
    private $descricao;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Groups({"servico:get", "servico:post"})
     */
    private $valor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrdemServico", mappedBy="servico")
     */
    private $ordensServicos;

    public function __construct() {
        $this->ordensServicos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|OrdemServico[]
     */
    public function getOrdensServicos(): Collection
    {
        return $this->ordensServicos;
    }

    public function addOrdensServico(OrdemServico $ordensServico): self
    {
        if (!$this->ordensServicos->contains($ordensServico)) {
            $this->ordensServicos[] = $ordensServico;
            $ordensServico->setServico($this);
        }

        return $this;
    }

    public function removeOrdensServico(OrdemServico $ordensServico): self
    {
        if ($this->ordensServicos->removeElement($ordensServico)) {
            // set the owning side to null (unless already changed)
            if ($ordensServico->getServico() === $this) {
                $ordensServico->setServico(null);
            }
        }

        return $this;
    }
}
