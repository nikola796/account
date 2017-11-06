<?php namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    protected $fillable = [
        'name',
        'comment',
        'type',
        'published_at',
        'group_id',
        'amount'];

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

        if(Carbon::createFromFormat('Y-m-d', $date) > Carbon::now())
        {
            $this->attributes['published_at'] = Carbon::parse($date);
        }
        else{
            $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
        }

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
     * Prepere amount to store in DB save as integer. Make it from float to integer
     * @param $amount
     */
    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = round($amount, 2) * 100;
    }

    /**
     * Prepare amount for send to view. Make it from integer to float
     * @param $value
     * @return float|int
     */
    public function getAmountAttribute($value)
    {
        return ($value / 100);
    }

    /**
     * Get All Account Belongs to Current User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
	}

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    /**
     * Get a list of categories ids associated with fund
     *
     * @return array
     */
    public function getGroupListAttribute()
    {
        return $this->group()->lists('id');
    }

    public function scopeCheckAuthor($query)
    {
        $query->where('user_id', Auth::id());
    }

    public function categories()
    {
        return $this->belongsTo('App\Category');
    }
}
