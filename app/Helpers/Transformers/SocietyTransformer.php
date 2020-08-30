<?php

namespace App\Helpers\Transformers;

class SocietyTransformer extends Transformer{

    public function transform($society)
    {
        return [
            'id'            => $society->auto_id,
            'society_id'    => $society->society_id,
            'society_no'    => $society->society_no,
            'name'          => $society->name,
            'full_name'     => $society->full_name,
            'area'          => $society->area,
            'city'          => $society->city,
            'state'         => $society->state,
            'country'       => $society->country,
            'pincode'       => $society->pincode,
        ];
    }


}