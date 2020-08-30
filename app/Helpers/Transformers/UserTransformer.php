<?php

namespace App\Helpers\Transformers;

class UserTransformer extends Transformer
{

    public function transform($user)
    {
        return [
            'id'         => $user->auto_id,
            'user_id'    => $user->user_id,
            'user_no'    => $user->user_no,
            'full_name'  => $user->full_name,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
            'mobile'     => $user->mobile,
            'type'       => $user->type,
            'photo'      => $user->photo,
        ];
    }

}
