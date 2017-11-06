<?php namespace App\Http\Controllers;

use App\Account;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\AccountRequest;
use Auth;
use Illuminate\Http\Request;

class AccountsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $accounts = Auth::user()->accounts()->latest('published_at')->published()->get();
	   // dd($accounts);

		return view('accounts.index', compact('accounts'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $groups = Auth::user()->groups()->lists('name', 'id');
        //dd($groups);

		return view('accounts.create', compact('groups'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param AccountRequest $request
     * @return Response
     */
	public function store(AccountRequest $request)
	{
	    //dd($request);

        Auth::user()->accounts()->create($request->all());

        session()->flash('flash_message', 'Your article has been created');
        session()->flash('flash_message_important', true);

        return redirect('accounts');

	}

    /**
     * Display the specified resource.
     *
     * @param Account $account
     * @return Response
     * @internal param Article $article
     * @internal param int $id
     */
	public function show(Account $account)
	{
	    //dd($account);
		return view('accounts.show', compact('account'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Account $account
     * @return Response
     * @internal param int $id
     */
	public function edit(Account $account)
	{
        $groups = Auth::user()->groups()->lists('name', 'id');

        if($account->user_id == Auth::id()){
            return view('accounts.edit', compact('account', 'groups'));
        }
        else{
            return redirect()->back()->withInput()->withErrors('forbidden');
        }
	}

    /**
     * Update the specified resource in storage.
     *
     * @param AccountRequest $request
     * @param Account $account
     * @return Response
     * @internal param int $id
     */
	public function update(Account $account, AccountRequest $request)
	{
		$account->update($request->all());

        session()->flash('flash_message', 'Your article has been updated');

        return redirect('accounts');
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

//    private function createAccount(AccountRequest $request)
//    {
//
//	}

}
