<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly="true")
 * @ORM\Table(name="purchases")
 */
class Purchase
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $url;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $photo;

    public function __construct(int $id, string $name, string $url, string $photo)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->photo = $photo;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
