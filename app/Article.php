<?php namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    /**
     * @var array
     */
    protected $fillable = [
	    'title',
        'body',
        'published_at'
	    ];

    protected $dates = ['published_at'];

    public function scopePublished($query)
    {
       $query->where('published_at', '<=', Carbon::now());
    }

    /**
     * @param $query
     */
    public function scopeCheckAuthor($query)
    {
        $query->where('user_id', Auth::id());
    }

    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>', Carbon::now());
    }

    public function setPublishedAtAttribute($date)
    {
        if(Carbon::createFromFormat('Y-m-d', $date) > Carbon::now()){
            $this->attributes['published_at'] = Carbon::parse($date); // Carbon::createFromFormat('Y-m-d', $date)
        }
        else{
            $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
        }
       // $this->attributes['published_at'] = Carbon::parse($date); // Carbon::createFromFormat('Y-m-d', $date)
    }

    /**
     * Get the published_at attribute.
     * @param $date
     * @return string
     */
    public function getPublishedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * An article is owned by user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the tags associated with the given article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * Get a list of tag ids associated with article
     *
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }
}
