<?php

namespace App\Entity;

trait SerializebleTrait
{
    public function jsonSerialize() {
        $arr = get_object_vars( $this );

        return $arr;
    }
}
