<?php namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\GroupRequest;
use Auth;
use Illuminate\Http\Request;

class GroupsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = Auth::user()->groups;



		foreach ($groups as $gr)
        {
            $accounts[$gr['name']] = $gr->accounts()->published()->get();
        }

        //dd($accounts);

        return view('groups.index', compact('accounts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        $groups = Auth::user()->groups()->lists('name', 'id');
        //$groups[0] = 'test';
        //dd($groups);
		return view('groups.create', compact('groups'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param GroupRequest $request
     * @param Group $group
     * @return Response
     */
	public function store(GroupRequest $request, Group $group)
	{

        $group->createGroup($request);

        session()->flash('flash_message', 'Групата бе съдадена успешно');


        return redirect('groups');
	    //dd($request->input());
	}

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return Response
     * @internal param int $id
     */
	public function show(Group $group)
	{
	    $accounts = $group->accounts()->published()->get();

	    $group_name = $group->name;

		return view('groups.show', compact('accounts', 'group_name'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
