<?php

namespace App;

class Snippet extends Model
{
    protected $primaryKey = 'slug';
    protected $keyType = 'string';
    /**
     * A snippet belongs to a user whether he is an
     * actual user or an anonymous user
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * A snippet may have multiple forks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forks()
    {
        return $this->hasMany(Snippet::class, 'forked_slug');
    }

    /**
     * A snippet may be forked from another snippet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originalSnippet()
    {
        return $this->belongsTo(Snippet::class, 'forked_slug');
    }

    /**
     * Determine if the current snippet is a fork.
     *
     * @return boolean
     */
    public function isAFork()
    {
        return $this->forked_slug;
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'snippet_likes')->withTrashed();
    }
}
