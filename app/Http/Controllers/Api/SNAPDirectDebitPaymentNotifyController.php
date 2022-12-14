<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SNAPDirectDebitPaymentNotifyController extends Controller
{
 /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        /**
         * pastikan header token sudah sesuai dan terdaftar pada data NGI
         * jika tidak sesuai return error
         */

        $validator = Validator::make($request->all(), [
            'originalReferenceNo'     => 'required',
            'amount'     => 'required',
            'value'     => 'required',
            'currency'     => 'required',
            'latestTransactionStatus'     => 'required',
            ]);

            /**
             * dari originalReferenceNo lakukan pencarian pada table transaksi
             * pastikan amount valuenya sama dan transaksi status yang yang dikirim tidak null
             * transaksi status harus sesuai dengan standard BI jg
             * gunakan try catch jika ~transaksi exception maka response juga harus disesuaikan dengan standard BI
             *
             * 
          *  if(ERRORRR jika originalReferenceNo tidak terdaftar misalkan maka return 400) {
          *      return response()->json([
          *          'responseCode' => "4007300",
          *          'responseMessage' => "Successful",
          *          'accessToken'   => $tokennya,
          *          'tokenType' => "Bearer",
          *          'expiresIn' => "900",
          *          'additionalInfo' => "{}",
          *      ], 400);
          *  }
            */


        return response()->json([
            'responseCode' => "2007300",
            'approvalCode' => "approvalCode",
            'responseMessage'   => "Request has been processed successfully",
        ], 200);


    }}
