<?php namespace App\Http\Controllers;

use App\Fund;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\FundRequest;
use Carbon\Carbon;
use Request;

class FundsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$funds = Fund::latest('published_at')->published()->get();;

        return view('funds.index', compact('funds'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	   // $groups = Fund::all();
       // foreach ($groups as $group){
       //     $cl_groups[$group['id']] = $group['name'];
      //  }
		return view('funds.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFundRequest $request
     * @return Response
     */
	public function store(FundRequest $request)
	{
	    $input = $request->all();

        $input['added_by'] = 1;

      ///  $input['amount'] = round($input['amount'], 2) * 100;

       // $input['event_data'] = Carbon::now();

        Fund::create($input);

        return redirect('funds');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$fund = Fund::findOrFail($id);

        return view('funds.show', compact('fund'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$fund = Fund::findOrFail($id);

        //$fund['amount'] = ($fund['amount'] / 100);

        return view('funds.edit', compact('fund'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, FundRequest $request)
	{
        $fund = Fund::findOrFail($id);

        $request['added_by'] = 1;

        //$request['amount'] = round($request['amount'], 2) * 100;

        $fund->update($request->all());

        return redirect('funds');
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
