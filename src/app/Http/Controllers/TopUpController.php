<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
Use \Carbon\Carbon;
use App\Top_up;
use App\Ussd;
use DB;
use Carbon\Carbon as time;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topuploan(Request $request)
    {
       
        // $input = $request->all();
        // print_r($input);die();

        $Check_number = Ussd::where('msisdn', '=', $request->msisdn)->first();
        $amount = DB::table('top_ups')->where('msisdn', '=', $request->msisdn)->value('Amount');
        $amt_sum = DB::table('top_ups')->where('msisdn', '=' , $request->msisdn )->pluck("Amount")->sum();
        $refNumber = DB::table('ussds')->where('msisdn', '=' , $request->msisdn )->value("refno");
        $created_at = DB::table('ussds')->where('msisdn', '=' , $request->msisdn )->value("created_at");

        // dd($created_at); 
        // print_r($request);die();

        $message = new Top_up;
        $message->msisdn = $request->input('msisdn');
        $message->Amount = $request->input('Amount');
        $message->Description = 'TOPUP';
        $message->confirm = $request->input('confirm');
        // $message->refno = 'test';

        


        // Get the last order id
        $Check_id = DB::table('top_ups')->where('msisdn', '=' , $request->msisdn )->value("id");

            if(!$Check_id){
                $lastId = 0;
            }else{
                $lastId = top_up::orderBy('id', 'desc')->first()->id;
            }
            // Get last 3 digits of last order id
            $lastIncreament = substr($lastId, -3);

            // Make a new order id with appending last increment + 1
            // $message->refno = 'TXT' . date('Ymd') . str_pad($lastIncreament + 1, 3, 0, STR_PAD_LEFT);




            // $input = substr(1, -3);
            $message ->refno = 'LN' . substr(date('Ymd'),2,10) . 'C' . str_pad($lastIncreament + 1, 3, 0, STR_PAD_LEFT);
            // // $message ->refno = 'LN' . Carbon::now('EAT'); 

            // $current_time = 'LN' . Carbon::now('EAT')->toDateTimeString('Y-m-d H:i:s');


            // dd($test);
            // $ngao ->refno = 'LN' . substr(md5(uniqid(rand(), true)),0,10); 
            $todays_date = substr(date('d/m/Y'),0,8);

            // dd($test);

            // $mytime=time::now();
            // $date=$mytime->toRfc850String();
            // $message ->refno = substr($date, 0, strrpos($date, ","));

            // $message->refno = substr( "XYZ" ,mt_rand( 0 ,50 ) ,2 ) .substr( md5( time() ), 1,3);

            // dd($message);
        




        // $message->save();
        if($Check_number){
            $message->save();
            return "Dear Customer your loan topup request for amount Ksh.$message->Amount for loan number  $refNumber on $todays_date  has been received. ";
        }else{
            return "Dear Customer you dont have an existing loan to topup.";
        }

// dd('kkkkkkkkkk');
//         if($message->save()){
//             // return response()->json([
//             //     'responsecode' => '200',
//             //     'response' => 'Success',
//             //     'status' => 'Processing'
    
//             // ]);
//             return "ksh $message->Amount has Successfully been Deposited to account number $message->msisdn.";
//         }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
