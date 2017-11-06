<?php namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    /**
     * Fillable filds for Tags
     * @var array
     */
    protected $fillable = [
      'name'
    ];

    /**
     * Get the article associated with the given tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
       return $this->belongsToMany('App\Article');
	}

    /**
     * Get the article associated with the given tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function funds()
    {
        return $this->belongsToMany('App\Fund');
    }

    /**
     * Get tags added by user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Check is tag added from current user
     * @param $query
     * @param $name
     */
    public function scopeCheckAuthor($query, $name)
    {
        $query->where('name', $name)
            ->where('user_id', Auth::id());
    }

}
