<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Status;
use App\Top_up;
use DB;

class LoanStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function loanstatus(Request $request) 
    {
        // dd($request);
        // print_r($request);die();
        $message = new Status;
        $message->customeridnumber = $request->input('customeridnumber');
        $message->customermobilenumber = $request->input('customermobilenumber');
        
        // dd($message);
        // $ngao = Status::paginate(15);
        $withdraw = DB::table('top_ups')->get();
        // $withdraw = DB::table('ussds')->value('refno');
        // $withdraw = DB::table('top_ups')->value('status');
        dd($withdraw);
        // $test = Table::select('name','surname')->where('id', 1)->get();
// dd($withdraw);
        // return($withdraw);
        return "Your loan is  $withdraw loan ";
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
    public function ministatement(Request $request)
    {
        // $input = $request->all();
        // print_r($input);die();
        //request the number on ussd
        $statement = new Top_up;
        $statement->msisdn = $request->input('msisdn');
        //check if number exixts to pull statement
        $check_number = Top_up::where('msisdn', '=', $request->msisdn)->first();
//         $Statuses = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->pluck('status')->all();
//         $Amounts = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->pluck('Amount')->all();
//         $Descriptions = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->pluck('Description')->all();
//         $Dates = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->pluck('created_at')->all();
// dd($request);
if($check_number){
            $data = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->get()->toArray();

            // dd($data['status']);
            $statement = array(); 

            $header = "|Date  and time  |Description |Amount|Status|Transation refno" . "\n";

        

                foreach ($data as $datastatus) {
                    // dd($datastatus->Amount);
                    $status = $datastatus->status;
                    $amount = $datastatus->Amount;
                    $description = $datastatus->Description;
                    $Date = $datastatus->created_at;
                    $refno = $datastatus->refno;
                    // dd($refno);
                    // $date = date_create($status->created_at);
                // foreach ($Amounts as $Amount){
                //     $amount = $Amount;

                // }
                // foreach ($Descriptions as $Description){
                //     $description = $Description;
                //     // dd($description);
                // }
                // foreach ($Dates as $Date){
                //     $Date = $Date;
 
                // }


                    $header = $header . "|" . $Date . "|" . $description . "|" . $amount ."  |" . $status . "  |" . $refno ."\n";
                }

                return($header);

            }else{
                $header = "|Date  and time  |Description |Amount|Status|Transation refno" . "\n";
                return $header;
            }


    //     $withdraw = DB::table('top_ups')->value('Amount');

    //     // dd($withdraw);
    //    return "You have a Balance of KSH.$withdraw. Thank you";
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
