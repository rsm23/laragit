<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class SnippetLike extends Model {
	use SoftDeletes;
	protected $fillable = [ 'user_id', 'snippet_id' ];

    /**
     * Snippets sorted by descending likes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeMostLiked() {
        return $this->select( 'snippet_id' )
            ->orderBy( DB::raw( 'count(snippet_id)' ), 'DESC' )
            ->groupBy( 'snippet_id' );
    }
}
