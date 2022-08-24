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
    private string $alias;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $title;

    /**
     * @var array|ArrayCollection|Collection
     * @ORM\ManyToMany(targetEntity="Purchase", cascade={"persist", "remove"})
     * @ORM\JoinTable(
     *     name="purchase_types_purchases",
     *     joinColumns={@ORM\JoinColumn(name="purchase_type_alias", referencedColumnName="alias")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="purchase_id", referencedColumnName="id")}
     * )
     */
    private array|ArrayCollection|Collection $purchases;

    public function __construct(string $alias, string $title)
    {
        $this->alias = $alias;
        $this->title = $title;
        $this->purchases = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
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
