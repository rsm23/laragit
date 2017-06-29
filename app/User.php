<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'slug',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * Getting the User's snippets.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function snippets() {
		return $this->hasMany( Snippet::class );
	}

	public function likes() {
		return $this->belongsToMany( 'Snippet', 'snippet_likes', 'user_id', 'snippet_id' )->withTrashed();
	}
}
