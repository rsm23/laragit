<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * A channel could have many snippets
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function snippets()
    {
        return $this->hasMany(Snippet::class);
    }
}
