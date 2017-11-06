<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Category extends Model {

    /**
     * Fillable filds for Category
     * @var array
     */
    protected $fillable = [
	    'name',
        'parent_id'
    ];

    /**
     * Get the Fund associated with the given Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function funds()
    {
        return $this->belongsToMany('App\Fund');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Check is category added from current user
     * @param $query
     * @param $name
     */
    public function scopeCheckAuthor($query, $name)
    {
        $query->where('name', $name)
            ->where('user_id', Auth::id());
    }


}
