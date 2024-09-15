<?php

namespace App\Entity;

use JsonSerializable;

abstract class AbstractEntity implements JsonSerializable
{
    use SerializebleTrait;
    
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
