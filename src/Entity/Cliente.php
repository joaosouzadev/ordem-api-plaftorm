<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"cliente:get"}},
 *     denormalizationContext={"groups"={"cliente:post"}}
 * )
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cliente:get"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="clientes")
     * @ORM\JoinColumn()
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cliente:get"})
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"cliente:get"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"cliente:get"})
     */
    private $celular;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"cliente:get"})
     */
    private $cep;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"cliente:get"})
     */
    private $rua;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"cliente:get"})
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"cliente:get"})
     */
    private $complemento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"cliente:get"})
     */
    private $bairro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"cliente:get"})
     */
    private $cidade;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordem", mappedBy="cliente")
     */
    private $ordens;

    public function __construct() {
        $this->ordens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getRua(): ?string
    {
        return $this->rua;
    }

    public function setRua(?string $rua): self
    {
        $this->rua = $rua;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function setComplemento(?string $complemento): self
    {
        $this->complemento = $complemento;

        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(?string $cidade): self
    {
        $this->cidade = $cidade;

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
     * @return Collection|Ordem[]
     */
    public function getOrdens(): Collection
    {
        return $this->ordens;
    }

    public function addOrden(Ordem $orden): self
    {
        if (!$this->ordens->contains($orden)) {
            $this->ordens[] = $orden;
            $orden->setCliente($this);
        }

        return $this;
    }

    public function removeOrden(Ordem $orden): self
    {
        if ($this->ordens->removeElement($orden)) {
            // set the owning side to null (unless already changed)
            if ($orden->getCliente() === $this) {
                $orden->setCliente(null);
            }
        }

        return $this;
    }
}
