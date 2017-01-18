<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SnippetLike extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'snippet_id'];
}
