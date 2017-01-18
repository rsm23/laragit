<?php

namespace App;

class Snippet extends Model
{
    protected $primaryKey = 'slug';
    protected $keyType = 'string';

    /**
     * A snippet belongs to a user whether he is an
     * actual user or an anonymous user.
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
        return $this->hasMany(self::class, 'forked_slug');
    }

    /**
     * A snippet may be forked from another snippet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originalSnippet()
    {
        return $this->belongsTo(self::class, 'forked_slug');
    }

    /**
     * Determine if the current snippet is a fork.
     *
     * @return bool
     */
    public function isAFork()
    {
        return $this->forked_slug;
    }

    /**
     * A Snippet may have multiple likes.
     *
     * @return mixed
     */
    public function likes()
    {
        return $this->belongsToMany('App\User', 'snippet_likes')->withTrashed();
    }

    /**
     * A Snippet belongs to one channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function channel()
    {
        return $this->hasOne(Channel::class, 'channel_id');
    }
}
