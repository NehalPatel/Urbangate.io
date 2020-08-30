<?php

namespace App\Helpers\Transformers;

use Illuminate\Support\Collection;

abstract class Transformer
{
    public function transformCollection(Collection $items)
    {

        return  $items->map([$this, 'transform']);

        // return array_map([$this, 'transform'], $items->data);
    }

    public abstract function transform($item);
}
