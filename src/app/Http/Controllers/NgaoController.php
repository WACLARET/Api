<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ussd;
use App\Top_up;
use App\Advance;
use App\Http\Resources\Ussddata;
use DB;

class NgaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //This shows all the data in the database 
    public function index()
    {
       $ngao = Ussd::paginate(15); 
       //Return collection of articles as a resource
       return Ussddata::collection( $ngao); 
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
    public function advanceapplication(Request $request, $id)
    {
        // dd($request);


        $input = $request->all();
        print_r($input);die();
        $number = Advance::where('session_id', '=', $request->session_id)->first();
        // $number = Top_up::where('msisdn', '=', $request->msisdn)->first();

        // dd($user);
        $ngao = $request->isMethod('put') ? Ussddata::findOrFail($request->session_id) : new Advance;
        // $ngao = $request->isMethod('put') ? Ussddata::findOrFail($request->session_id) : new Top_up;


        // $ngao->ngao_id = $request->input('ngao_id');
        if($id == 1){
            $ngao->msisdn = $request->input('msisdn');
            $ngao->session_id = $request->input('session_id');
            $ngao->Amount = $request->input('Amount');
            $ngao->id_number = $request->input('id_number');
            $ngao->Description = "ADVANCE";
            $ngao->loanterm = 15;
            $ngao->confirm = $request->input('confirm'); 
            $ngao ->refno = 'LN' . substr(md5(uniqid(rand(), true)),0,10); 
        }else{
            $ngao->msisdn = $request->input('msisdn');
            $ngao->session_id = $request->input('session_id');
            $ngao->Amount = $request->input('Amount');
            $ngao->id_number = $request->input('id_number');
            $ngao->Description = "ADVANCE";
            $ngao->loanterm = 30;
            $ngao->confirm = $request->input('confirm'); 
            $ngao ->refno = 'LN' . substr(md5(uniqid(rand(), true)),0,10); 
        }

        //check mif id exist to generate random refNumber
        $Check_id = DB::table('advances')->where('msisdn', '=' , $request->msisdn )->value("id");

            if(!$Check_id){
                $lastId = 0;
            }else{
                $lastId = Advance::orderBy('id', 'desc')->first()->id;
            }
            // Get last 3 digits of last order id
            $lastIncreament = substr($lastId, -3); 

            $ngao ->refno = 'LN' . substr(date('Ymd'),2,10) . 'D' . str_pad($lastIncreament + 1, 3, 0, STR_PAD_LEFT);
        




        // $ngao->customeridnumber = $request->input('customeridnumber');
        // $ngao->customermobilenumber = $request->input('customermobilenumber');
        // $ngao->loanproduct = $request->input('loanproduct');
        // $ngao->loanamount = $request->input('loanamount');
        // $ngao->loanterm = $request->input('loanterm');
        // $ngao->customerfullnames = $request->input('customerfullnames');
        // $ngao->loanapplicationdate = $request->input('loanapplicationdate');

        // $request->confirm
            if($request->confirm == 1){

                if ($number) {
                    return "Dear Customer you have an Existing Advance request. Thank You.";
                }
                if(!$number){
                    if($ngao->save()){
                        return "Dear Customer your advance request of ksh.$ngao->Amount has been successfully received. Thank You.";
                    }
                }
            }elseif($request->confirm == 2){
                return "Thank you";
            }else{
                return "Please select a valid confirmation. Thank You.";
            }

            }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Shows specific data in the DB
    public function loanterm(Request $request, $id)
    {
        // $input = $request->all();
        // print_r($input);die();

        // dd($request);
        // if($id == 1){

        //     $number = Ussd::where('session_id', '=', $request->session_id)->first();
        // // $number = Top_up::where('msisdn', '=', $request->msisdn)->first();

        // // dd($user);
        // $ngao = $request->isMethod('put') ? Ussddata::findOrFail($request->session_id) : new Ussd;
        // // $ngao = $request->isMethod('put') ? Ussddata::findOrFail($request->session_id) : new Top_up;

        //     $ngao->msisdn = $request->input('msisdn');
        //     $ngao->session_id = $request->input('session_id');
        //     $ngao->Amount = $request->input('Amount');
        //     $ngao->id_number = $request->input('id_number');
        //     $ngao->description = "ADVANCE";
        //     $ngao->loanterm = 15;
        //     $ngao->confirm = $request->input('confirm'); 
        //     $ngao ->refno = 'LN' . substr(md5(uniqid(rand(), true)),0,10); 

        //     //check mif id exist to generate random refNumber
        // $Check_id = DB::table('ussds')->where('msisdn', '=' , $request->msisdn )->value("id");

        // if(!$Check_id){
        //     $lastId = 0;
        // }else{
        //     $lastId = Ussd::orderBy('id', 'desc')->first()->id;
        // }
        // // Get last 3 digits of last order id
        // $lastIncreament = substr($lastId, -3);

        // $ngao ->refno = 'LN' . substr(date('Ymd'),2,10) . 'D' . str_pad($lastIncreament + 1, 3, 0, STR_PAD_LEFT);
    

        //     // $request->confirm
        //     if($request->confirm == 1){

        //         if ($number) {
        //             return "Dear Customer you have an Existing Advance request. Thank You.";
        //         }
        //         if(!$number){
        //             if($ngao->save()){
        //                 return "Dear Customer your advance request of ksh.$ngao->Amount has been successfully received. Thank You.";
        //             }
        //         }
        //     }elseif($request->confirm == 2){
        //         return "Thank you";
        //     }else{
        //         return "Please select a valid confirmation. Thank You.";
        //     }


        // }elseif($id == 2){
        //     return "twooooooooooooooo";
        // }else{
        //     return "noneeeeeeeeeeee";
        // }

        // // $ngao = Ussd::findOrFail($id);

        // // //returns a single data in DB
        // // return new Ussddata($ngao);
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
        $ngao = Ussd::findOrFail($id);

        if($ngao->delete()){

        return new Ussddata($ngao);
        }
    }
}







// if($ngao->save()){
//     return response()->json([
//         'responsecode' => '200',
//         'response' => 'Success',
//         'status' => 'Processing'

//     ]);
// }
// if(!$ngao->save()){
//     return response()->json([
//         'responsecode' => '-1',
//         'response' => 'Failed',
//         'status' => 'Pending loan application'
//     ]);
// }