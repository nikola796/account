<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{

    protected $fillable = [
        'name',
        'comment',
        'type',
        'added_by',
        'published_at',
        'depth',
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

    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = round($amount, 2) * 100;
    }

    public function getAmountAttribute($value)
    {
        return ($value / 100);
    }

}
