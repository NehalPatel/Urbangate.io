<?php

namespace App\Helpers\Transformers;

class PropertyTransformer extends Transformer{

    public function transform($property)
    {
        return [
            'id'            	=> $property->auto_id,
            'property_id'   	=> $property->property_id,
            'property_no'   	=> $property->property_no,
            'society_id'   		=> $property->society_id,
            'wing_id'   		=> $property->wing_id,
            'property_number'   => $property->property_number,
            'type'          	=> $property->type,
        ];
    }

}