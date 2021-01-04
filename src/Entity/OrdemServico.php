<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrdemServicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"ordemServico:get", "swagger_definition_name"="ordem_servico_leitura"}},
 *     denormalizationContext={"groups"={"ordemServico:post", "swagger_definition_name"="ordem_servico_escrita"}}
 * )
 * @ORM\Entity(repositoryClass=OrdemServicoRepository::class)
 */
class OrdemServico
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ordemServico:get"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Servico", inversedBy="ordensServico")
     * @ORM\JoinColumn()
     * @Groups({"ordemServico:get", "ordemServico:post"})
     */
    private $servico;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ordem", inversedBy="servicos")
     * @ORM\JoinColumn()
     */
    private $ordem;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"ordemServico:get", "ordemServico:post"})
     */
    private $descricao;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Groups({"ordemServico:get", "ordemServico:post"})
     */
    private $valor;

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

    public function getOrdem(): ?Ordem
    {
        return $this->ordem;
    }

    public function setOrdem(?Ordem $ordem): self
    {
        $this->ordem = $ordem;

        return $this;
    }

    public function getServico(): ?Servico
    {
        return $this->servico;
    }

    public function setServico(?Servico $servico): self
    {
        $this->servico = $servico;

        return $this;
    }
}
