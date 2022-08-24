<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly="true")
 * @ORM\Table(name="purchase_types")
 */
class PurchaseType
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @var array|ArrayCollection|Collection
     * @ORM\ManyToMany(targetEntity="Purchase", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     name="purchase_types_purchases",
     *     joinColumns={@ORM\JoinColumn(name="purchase_type_name", referencedColumnName="name")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="purchase_id", referencedColumnName="id")}
     * )
     */
    private array|ArrayCollection|Collection $purchases;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->purchases = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array|ArrayCollection|Collection
     */
    public function getPurchases(): array|ArrayCollection|Collection
    {
        return $this->purchases;
    }

    /**
     * @param Purchase $purchase
     */
    public function addPurchase(Purchase $purchase): void
    {
        $this->purchases->add($purchase);
    }
}
