<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // contraintes de champs

/**
 * @ORM\Entity(repositoryClass=MedicamentRepository::class)
 */
class Medicament
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=12, max=12, minMessage="le code doit avoir 12 chiffres !")
     */
    private $MED_DepotLegal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MED_NomCommercial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MED_Composition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $MED_Effets;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MED_ContreIndic;

    /**
     * @ORM\Column(type="float")
     */
    private $MED_PrixEchantillon;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="medicaments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MED_Auteur;

    /**
     * @ORM\ManyToOne(targetEntity=Famille::class, inversedBy="medicaments")
     */
    private $MED_Famille;

    /**
     * @ORM\ManyToOne(targetEntity=VoieAdministration::class, inversedBy="Voie_Medic")
     */
    private $voieAdministration;


    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMEDDepotLegal(): ?string
    {
        return $this->MED_DepotLegal;
    }

    public function setMEDDepotLegal(string $MED_DepotLegal): self
    {
        $this->MED_DepotLegal = $MED_DepotLegal;

        return $this;
    }

    public function getMEDNomCommercial(): ?string
    {
        return $this->MED_NomCommercial;
    }

    public function setMEDNomCommercial(string $MED_NomCommercial): self
    {
        $this->MED_NomCommercial = $MED_NomCommercial;

        return $this;
    }

    public function getMEDComposition(): ?string
    {
        return $this->MED_Composition;
    }

    public function setMEDComposition(string $MED_Composition): self
    {
        $this->MED_Composition = $MED_Composition;

        return $this;
    }

    public function getMEDEffets(): ?string
    {
        return $this->MED_Effets;
    }

    public function setMEDEffets(string $MED_Effets): self
    {
        $this->MED_Effets = $MED_Effets;

        return $this;
    }

    public function getMEDContreIndic(): ?string
    {
        return $this->MED_ContreIndic;
    }

    public function setMEDContreIndic(?string $MED_ContreIndic): self
    {
        $this->MED_ContreIndic = $MED_ContreIndic;

        return $this;
    }

    public function getMEDPrixEchantillon(): ?float
    {
        return $this->MED_PrixEchantillon;
    }

    public function setMEDPrixEchantillon(float $MED_PrixEchantillon): self
    {
        $this->MED_PrixEchantillon = $MED_PrixEchantillon;

        return $this;
    }

    /**
     * @return Collection|Constituer[]
     */
    public function getComposants(): Collection
    {
        return $this->Composants;
    }

    public function addComposant(Constituer $composant): self
    {
        if (!$this->Composants->contains($composant)) {
            $this->Composants[] = $composant;
            $composant->setMEDDepotLegal($this);
        }

        return $this;
    }

    public function removeComposant(Constituer $composant): self
    {
        if ($this->Composants->removeElement($composant)) {
            // set the owning side to null (unless already changed)
            if ($composant->getMEDDepotLegal() === $this) {
                $composant->setMEDDepotLegal(null);
            }
        }

        return $this;
    }

    public function getMED_Auteur(): ?User
    {
        return $this->MED_Auteur;
    }

    public function setMED_Auteur(?User $auteur): self
    {
        $this->MED_Auteur = $auteur;

        return $this;
    }

    public function getMEDFamille(): ?Famille
    {
        return $this->MED_Famille;
    }

    public function setMEDFamille(?Famille $MED_Famille): self
    {
        $this->MED_Famille = $MED_Famille;

        return $this;
    }

    public function getVoieAdministration(): ?VoieAdministration
    {
        return $this->voieAdministration;
    }

    public function setVoieAdministration(?VoieAdministration $voieAdministration): self
    {
        $this->voieAdministration = $voieAdministration;

        return $this;
    }
}