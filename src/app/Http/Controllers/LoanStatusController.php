<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Status;
use App\Top_up;
use App\Ussd;
use App\Advance;
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
        // $message = new Advance;
        // $message->msisdn = $request->input('msisdn');

        // $message = new Top_up;
        // $message->msisdn = $request->input('msisdn');
        // dd($message);


          //loging to a file

          $end_time = microtime(true);
          $filename = 'api_datalogger_' . date('d-m-y') . '.log';
          $data = 'Time: ' . gmdate("F j, Y, g:i a") . "\n";
          $data .= 'Duration: ' . number_format($end_time - LARAVEL_START, 3) . "\n";
          $data .= 'IP Address: ' . $request->ip() . "\n";
          $data .= 'URL: ' . $request->fullUrl() . "\n";
          $data .= 'Method: ' . $request->method() . "\n";
          $data .= 'Input: ' . $request->getContent() . "\n";

          \File::append(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $data . "\n" . str_repeat("=", 20) . "\n\n");

          try {

              $input = $request->all();




              $number = Advance::where('msisdn', '=', $request->msisdn)->first();
        // dd($number);
        // $ngao = Status::paginate(15);
        // $withdraw = DB::table('top_ups')->get();
        // $withdraw = DB::table('ussds')->value('refno');
        $Status_topups = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->value('status');
        $Status_advance = DB::table('advances')->where('msisdn', '=', $request->msisdn)->value('status');
        $total_topups =  DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->pluck('Amount')->sum();
        $total_advance =  DB::table('advances')->where('msisdn', '=', $request->msisdn)->pluck('Amount')->sum();
        $createdate_advance = DB::table('advances')->where('msisdn', '=', $request->msisdn)->value('created_at');
        $loanterm_advance = DB::table('advances')->where('msisdn', '=', $request->msisdn)->value('loanterm');
        // $total_topups =  DB::table('top_ups')->where('msisdn', '=', 255720711386)->get();
        // dd($loanterm_advance);
        if($loanterm_advance == 15){
            $loanduedate = date('Y-m-d', strtotime($createdate_advance. ' + 15 days'));
        }else{
            $loanduedate = date('Y-m-d', strtotime($createdate_advance. ' + 30 days'));
        }
        // $test = Table::select('name','surname')->where('id', 1)->get();
// dd($createdate_advance, $test);
        $loanbalance = $total_topups + $total_advance;
        // return($withdraw);loanbalance is Ksh.$loanbalance,
        return "Your loan is a CURRENT $Status_advance loan, loan due date $loanduedate ";

    } catch (Exception $e) {

        return 'FAILED';
    }


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
        $checkno_advance = Advance::where('msisdn', '=', $request->msisdn)->first();
//         $Statuses = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->pluck('status')->all();
//         $Amounts = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->pluck('Amount')->all();
//         $Descriptions = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->pluck('Description')->all();
//         $Dates = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->pluck('created_at')->all();
// dd($request);
if($check_number OR $checkno_advance){
            $topup_data = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->get()->toArray();
            $advance_data = DB::table('advances')->where('msisdn', '=', $request->msisdn)->get()->toArray();
            // $createdate_advance = DB::table('advances')->where('msisdn', '=', $request->msisdn)->value('created_at');
            // dd($advance_data);
            // $test = date('Y-m-d', strtotime($createdate_advance));

            // dd($test);
            
            $statement = array(); 

            //return data in table as a mini statement

            $header = "|Date  and time  |Description |Amount|Status|Transaction refno" . "\n";

            foreach ($advance_data as $datastatus) {
                // dd($datastatus->Amount);
                $adv_status = $datastatus->status;
                $adv_amount = $datastatus->Amount;
                $avd_description = $datastatus->description;
                $adv_Date = $datastatus->created_at;
                $adv_refno = $datastatus->refno;
            }
            $header = $header . "|" . $adv_Date . "|" . $avd_description . "|" . $adv_amount ."  |" . $adv_status . "  |" . $adv_refno ."\n";

                foreach ($topup_data as $datastatus) {
                    // dd($datastatus->Amount);
                    $status = $datastatus->status;
                    $amount = $datastatus->Amount;
                    $description = $datastatus->Description;
                    $Date = $datastatus->created_at;
                    $refno = $datastatus->refno;

                $header = $header . "|" . $Date . "|" . $description . "|" . $amount ."  |" . $status . "  |" . $refno ."\n";

                }
                
                return($header);

            }else{
                $header = "|Date  and time  |Description |Amount|Status|Transaction refno" . "\n";
                return $header;
            }
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
