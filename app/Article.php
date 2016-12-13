<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	protected $fillable = [
	    'title',
        'body',
        'published_at',
        'user_id'
	    ];

    protected $dates = ['published_at'];

    public function scopePublished($query)
    {
       $query->where('published_at', '<=', Carbon::now());
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
     * An article is owned by user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
