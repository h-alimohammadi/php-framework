<?php

namespace App\Http\Request;

use System\Request\Request;

class UserCommentRequest extends Request
{
    public function rules(){
            return [
                'comment' => 'required|max:500',
             ];
    }
}