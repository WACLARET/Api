<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Status;
use DB;

class LoanStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index(Request $request) 
    {
        $message = new Status;
        $message1->msisdn = $request->input('msisdn');
        $message->customermobilenumber = $request->input('customermobilenumber');
        
        dd($message1);
        // $ngao = Status::paginate(15);
        $withdraw = DB::table('statuses')->value('loanbalance');
        // dd($withdraw);
        // $test = Table::select('name','surname')->where('id', 1)->get();
// dd($withdraw);
        // return($withdraw);
        return "Your loanbalance for account number $message->customermobilenumber id number $message->customeridnumber is $withdraw ";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();
        // print_r($input);die();
        
        $message = new Status;

        $message->customeridnumber = $request->input('customeridnumber');
        $message->customermobilenumber = $request->input('customermobilenumber');
        $message->loanproduct = $request->input('loanproduct');
        $message->loanamount = $request->input('loanamount');
        $message->loanbalance = $request->input('loanbalance');
        $message->loanstatus = $request->input('loanstatus');
        $message->reference = $request->input('reference');
        $message->loanduedate = $request->input('loanduedate');
        $message->loanterm = $request->input('loanterm');
        $message->customerfullnames = $request->input('customerfullnames');
        $message->loanapplicationdate = $request->input('loanapplicationdate');

        if($message->save()){
            // return response()->json([
            //     'responsecode' => '200',
            //     'response' => 'Success',
            //     'status' => 'Processing'
    
            // ]);
            return 'Successfully Deposited.';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
