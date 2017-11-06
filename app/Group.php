<?php namespace App;


use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $fillable = [
        'name',
        'group_id'
    ];


    public function accounts()
    {
        return $this->hasMany('App\Account');
    }

    /**
     * Get tags added by user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeCheckAuthor($query, $name)
    {
        $query->where('name', $name)
            ->where('user_id', Auth::id());
    }

    public function createGroup($request)
    {
        $group_id = $request->input('group_id');

        if($group_id == '')
        {
            /*DB::statement('LOCK TABLE groups WRITE; UPDATE groups SET rgt = rgt + 2 ;
                           UPDATE groups SET lft = lft + 2 ;
                           INSERT INTO groups(name, lft, rgt, user_id) VALUES('.$request->input('name').', 1, 2, '.Auth::id().');
                           UNLOCK TABLES;');*/
            //dd( $request->input('name'));

            DB::transaction(function ($request) use ($request) {

                //dd($name);
                DB::update('UPDATE groups SET rgt = rgt + 2 WHERE rgt');

                DB::update('UPDATE groups SET lft = lft + 2 WHERE lft');

                DB::table('groups')->insert(['name' => $request->input('name'), 'lft' => 1, 'rgt' => 2, 'user_id' => Auth::id(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            });


        }
        else{

            DB::transaction(function ($request) use ($request) {
                $lft = DB::table('groups')->select('lft')
                    ->where('id', '=', $request->input('group_id'))
                    ->where('user_id', '=', Auth::id())
                    ->get();
               // dd($lft[0]->lft);
                /*DB::select('SELECT @myLeft := lft FROM groups
                           WHERE id = '.$request->input('group_id'));*/

                DB::update('UPDATE groups SET rgt = rgt + 2 WHERE rgt > ' . $lft[0]->lft);

                DB::update('UPDATE groups SET lft = lft + 2 WHERE lft > ' . $lft[0]->lft);

                DB::insert('INSERT INTO groups(name, lft, rgt, user_id, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?)', [$request->input('name'), ($lft[0]->lft + 1), ($lft[0]->lft + 2), Auth::id(), Carbon::now(), Carbon::now()]);
                //DB::table('groups')->insert(['name' => $request->input('name'), 'lft' => '@myLeft' +1, 'rgt' => '@myLeft' +2, 'user_id' => Auth::id()]);
            });

           /* DB::statement('LOCK TABLE groups WRITE;

                           SELECT @myRight := rgt FROM groups
                           WHERE id = '.$group_id.';
                           UPDATE groups SET rgt = rgt + 2 WHERE rgt > @myRight;
                           UPDATE groups SET lft = lft + 2 WHERE lft > @myRight;

                           INSERT INTO groups(name, lft, rgt, user_id) VALUES('.$request->input('name').', @myRight + 1, @myRight + 2, '.Auth::id().');

                           UNLOCK TABLES;');*/
        }


       // return $check;
    }
}
