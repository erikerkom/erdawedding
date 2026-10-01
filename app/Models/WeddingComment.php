<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
#[Table('wedding_comments')]
#[Fillable(['name', 'presence', 'message', 'ip_address', 'user_agent', 'latitude', 'longitude', 'is_published'])]

class WeddingComment extends Model
{
    //
}
