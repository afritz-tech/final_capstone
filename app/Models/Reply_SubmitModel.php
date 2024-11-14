<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply_SubmitModel extends Model
{
    use HasFactory;

    protected $table = 'hub_comment_reply';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
