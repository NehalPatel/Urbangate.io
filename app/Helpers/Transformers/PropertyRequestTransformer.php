<?php

namespace App\Helpers\Transformers;

class PropertyRequestTransformer extends Transformer
{

    public function transform($request_permission)
    {
        return [
            'id'                    => $request_permission->auto_id,
            'request_permission_id' => $request_permission->request_permission_id,
            'request_permission_no' => $request_permission->request_permission_no,
            'user_id'               => $request_permission->user_id,
            'society_id'            => $request_permission->society_id,
            'wing_id'               => $request_permission->wing_id,
            'property_id'           => $request_permission->property_id,
            'request_type'          => $request_permission->request_type,
            'requested_at'          => $request_permission->requested_at,
            'request_status'        => $request_permission->status,
        ];
    }

}
