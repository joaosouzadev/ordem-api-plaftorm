<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"post"},
 *     normalizationContext={
 *          "groups"={"read"}
 *     }
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $senha;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cliente", mappedBy="user")
     */
    private $clientes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordem", mappedBy="user")
     */
    private $ordens;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Servico", mappedBy="user")
     */
    private $servicos;

    public function __construct() {
        $this->clientes = new ArrayCollection();
        $this->ordens = new ArrayCollection();
        $this->servicos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        return $this->senha;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken($confirmationToken): void
    {
        $this->confirmationToken = $confirmationToken;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @return Collection|Cliente[]
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->setUser($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getUser() === $this) {
                $cliente->setUser(null);
            }
        }

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
            $orden->setUser($this);
        }

        return $this;
    }

    public function removeOrden(Ordem $orden): self
    {
        if ($this->ordens->removeElement($orden)) {
            // set the owning side to null (unless already changed)
            if ($orden->getUser() === $this) {
                $orden->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Servico[]
     */
    public function getServicos(): Collection
    {
        return $this->servicos;
    }

    public function addServico(Servico $servico): self
    {
        if (!$this->servicos->contains($servico)) {
            $this->servicos[] = $servico;
            $servico->setUser($this);
        }

        return $this;
    }

    public function removeServico(Servico $servico): self
    {
        if ($this->servicos->removeElement($servico)) {
            // set the owning side to null (unless already changed)
            if ($servico->getUser() === $this) {
                $servico->setUser(null);
            }
        }

        return $this;
    }
}
