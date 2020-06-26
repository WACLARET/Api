<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Top_up;
use App\Ussd;
use DB;

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

        // dd($Check_number); 
        // print_r($request);die();

        $message = new Top_up;
        $message->msisdn = $request->input('msisdn');
        $message->Amount = $request->input('Amount');
        $message->Description = 'TOPUP';
        $message->confirm = $request->input('confirm');
        // $message->refno = 'test';
        $message ->refno = 'TOP' . substr(md5(uniqid(rand(), true)),0,10);

        // $message->refno = substr( "XYZ" ,mt_rand( 0 ,50 ) ,2 ) .substr( md5( time() ), 1,3);

        // dd($message);
        




        // $message->save();
        if($Check_number){
            $message->save();
            return "Loan topup for amount KSH.$message->Amount has been topped for loan amount KSH.$amt_sum ";
        }else{
            return "You dont have an existing loan to topup.";
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
