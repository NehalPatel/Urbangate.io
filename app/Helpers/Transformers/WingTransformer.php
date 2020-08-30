<?php

namespace App\Helpers\Transformers;

class WingTransformer extends Transformer{

    public function transform($wing)
    {
        return [
            'id'            => $wing->auto_id,
            'wing_id'       => $wing->wing_id,
            'wing_no'       => $wing->wing_no,
            'name'          => $wing->name,
        ];
    }

}