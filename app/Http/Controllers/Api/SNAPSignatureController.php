<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SNAPSignatureController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $data1 = '0837a5d80d7046a482de9aba949a27d6'.'|'.'2020-01-01T00:00:00+07:00';
        $private_key_user = '6Y/ZpAUznaMtvyUc2KUw01H4fR4jr7VHsd8fg65uPNk=';  ///private ini harus di check di db apakah true or not??





        $rsaKey = openssl_pkey_new(array(
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ));
        $privKey = openssl_pkey_get_private($rsaKey);
        openssl_pkey_export($privKey, $pem);


        $binary_signature = '';

        openssl_sign($data1, $binary_signature, $pem, 'SHA256');

        $signature = base64_encode($binary_signature);

        /*
         *  HASIL $binary_signature harusnya di simpan dengan $private_key yang dikirim melalui request
         *  sehingga nextnya di token B2B x-signature akan dicheck
         * */


        DB::table('auth_signatures')->insert([
            'private_key' => $private_key_user,
            'signature_key' =>$signature,
        ]);

        return response()->json([
            'responseCode' => "2007300",
            'responseMessage' => $signature,
        ], 200);


    }
}
