<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;

    protected $table = 'hub_comment';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getReply()
    {
        return $this->belongsTo(User::class, 'comment_id');
    }
}
