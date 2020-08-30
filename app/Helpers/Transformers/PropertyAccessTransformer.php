<?php

namespace App\Helpers\Transformers;

class PropertyAccessTransformer extends Transformer
{

    public function transform($property_access)
    {
        return [
            'id'                 => $property_access->auto_id,
            'property_access_id' => $property_access->property_access_id,
            'property_access_no' => $property_access->property_access_no,
            'user_id'            => $property_access->user_id,
            'property_id'        => $property_access->property_id,
            'access_type'        => $property_access->access_type,
        ];
    }

}
