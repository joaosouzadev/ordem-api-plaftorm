<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrdemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *      "get"={"path"="ordens"},
 *      "post"={"path"="ordens"}
 *     },
 *     itemOperations={
 *      "get"={"path"="ordens/{id}"},
 *      "put"={"path"="ordens/{id}"},
 *      "delete"={"path"="ordens/{id}"}
 *     },
 *     normalizationContext={"groups"={"ordem:get", "cliente:get", "ordemServico:get"}},
 *     denormalizationContext={"groups"={"ordem:post", "ordemServico:post"}}
 * )
 * @ORM\Entity(repositoryClass=OrdemRepository::class)
 */
class Ordem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ordem:get"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ordens")
     * @ORM\JoinColumn()
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="ordens")
     * @ORM\JoinColumn()
     * @Groups({"cliente:get", "ordem:post"})
     */
    private $cliente;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"ordem:get", "ordem:post"})
     */
    private $situacao;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"ordem:get", "ordem:post"})
     */
    private $dataEntrada;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"ordem:get"})
     */
    private $hash;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Groups({"ordem:get", "ordem:post"})
     */
    private $valor;

    /**
     * @ORM\Column(type="text", precision=15, scale=2, nullable=true)
     * @Groups({"ordem:get", "ordem:post"})
     */
    private $observacoes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ordem:get", "ordem:post"})
     */
    private $equipamento;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrdemServico", mappedBy="ordem", cascade="all", orphanRemoval=true)
     * @Groups({"ordemServico:get", "ordemServico:post"})
     */
    private $servicos;

    public function __construct() {
        $this->servicos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSituacao(): ?string
    {
        return $this->situacao;
    }

    public function setSituacao(string $situacao): self
    {
        $this->situacao = $situacao;

        return $this;
    }

    public function getDataEntrada(): ?\DateTimeInterface
    {
        return $this->dataEntrada;
    }

    public function setDataEntrada(?\DateTimeInterface $dataEntrada): self
    {
        $this->dataEntrada = $dataEntrada;

        return $this;
    }

    public function getEquipamento(): ?string
    {
        return $this->equipamento;
    }

    public function setEquipamento(?string $equipamento): self
    {
        $this->equipamento = $equipamento;

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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection|OrdemServico[]
     */
    public function getServicos(): Collection
    {
        return $this->servicos;
    }

    public function addServico(OrdemServico $servico): self
    {
        if (!$this->servicos->contains($servico)) {
            $this->servicos[] = $servico;
            $servico->setOrdem($this);
        }

        return $this;
    }

    public function removeServico(OrdemServico $servico): self
    {
        if ($this->servicos->removeElement($servico)) {
            // set the owning side to null (unless already changed)
            if ($servico->getOrdem() === $this) {
                $servico->setOrdem(null);
            }
        }

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(?string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(?string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getObservacoes(): ?string
    {
        return $this->observacoes;
    }

    public function setObservacoes(string $observacoes): self
    {
        $this->observacoes = $observacoes;

        return $this;
    }
}
