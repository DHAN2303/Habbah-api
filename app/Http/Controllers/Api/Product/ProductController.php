<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OAuthV1;
use App\Models\Product;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function listProduct()
    {
        return [Product::all()];

    }

    public function getProductById($id){

        $product = Product::find($id);

        return ['product'=>$product];
    }
    public function createProduct(Request $request)
    {
        $validatedData = $request->validate([
            'sku' => 'required|max:255',
            'ref_sku' => 'required|max:255',
            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'slug' => 'required|unique:products|max:255',
            'is_discount_applied' => 'required|max:255',
            'is_active' => 'required|max:255',
            'description_ar' => 'required|max:255',
            'description_en' => 'required|max:255',
            'quantity' => 'required|max:255',
            'price' => 'required|max:255',
        ]);

        if(Product::create($validatedData)){
        return response()->json(['massage:'=>'Product has been created successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }

    public function updateProduct(Product $product, Request $request)
    {
        $validatedData = $request->validate([
            'sku' => 'required|max:255',
            'ref_sku' => 'required|max:255',
            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'is_discount_applied' => 'required|max:255',
            'is_active' => 'required|max:255',
            'description_ar' => 'required|max:255',
            'description_en' => 'required|max:255',
            'quantity' => 'required|max:255',
            'price' => 'required|max:255',
        ]);

        if($product->update($validatedData)){
            return response()->json(['massage:'=>'Product has been updated successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }


    }



    public function deleteProduct(Product $product)
    {
        if($product->delete()){
            return response()->json(['massage:'=>'Product has been deleted successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }
    }

    public function register(Request $request)
    {
//        $validation = $request->validate([
//            'name' => 'required',
//            'email' => 'required',
//            'password' => 'required',
//        ]);

//        $userData = User::where('email',$request->email)->first();
//        if($userData != null){
//            return $userData;
//        }else{
//            $user = new User;
//            $user->name = $request->input('name');
//            $user->email = $request->input('email');
//            $user->device_token = $request->input('device_token', '');
//            $user->password = Hash::make($request->input('password'));
//            $user->api_token = str_random(60);
//            $user->integrate_id = $request->input('integrate_id');
            //$user->phone = $request->input('phone');
//            $user->save();


            $current_timestamp = Carbon::now()->timestamp; // Produces something like 1552296328

        $baseUrl = "https://6982375-sb1.restlets.api.netsuite.com/app/site/hosting/restlet.nl";

//            $base = rawurlencode("https://6982375-sb1.restlets.api.netsuite.com/app/site/hosting/restlet.nl") . "&"
//                .rawurlencode("oauth_consumer_key="
//                    . rawurlencode("cbb3fa2032bcb70547ea25b7a2b3e944fff998b697c4b9e1b6084a82129c69f2")
//                    . "&oauth_nonce=" . rawurlencode(sha1(str_random(32)))
//                    . "&oauth_signature_method=" . rawurlencode("HMAC-SHA256")
//                    . "&oauth_timestamp=" . $current_timestamp
//                    . "&oauth_version=1.0" );
//
//            $key = rawurlencode("d021e4531789602b754c8df004d42f0dbc27b74a7d043f7763c0c3ad11b0ed26") . '&'
//                . rawurlencode("c843feb7d110c5643f8c63ce6f83237498085f413356786c388873f76ceaef5b");
//            $signature = base64_encode(hash_hmac('sha256', $base, $key, true));
//
//            $headers = ['Authorization' =>
//                'OAuth realm="6982375_SB1",
//                 oauth_consumer_key="cbb3fa2032bcb70547ea25b7a2b3e944fff998b697c4b9e1b6084a82129c69f2",
//                 oauth_consumer_secret="d021e4531789602b754c8df004d42f0dbc27b74a7d043f7763c0c3ad11b0ed26",
//                 oauth_token="52999a7589a4a232f66929c606e61fa6d4aaee799d0208f90d9e83f912b18c7b",
//                 oauth_token_secret="c843feb7d110c5643f8c63ce6f83237498085f413356786c388873f76ceaef5b",
//                 oauth_signature_method="HMAC-SHA256",
//                 oauth_timestamp="'.$current_timestamp.'",
//                 oauth_nonce="'.sha1(str_random(32)).'",
//                 oauth_version="1.0",
//                 oauth_signature="'.$signature.'"'];


        $client = new Client();

        OAuthV1::setConsumerKey("cbb3fa2032bcb70547ea25b7a2b3e944fff998b697c4b9e1b6084a82129c69f2", "d021e4531789602b754c8df004d42f0dbc27b74a7d043f7763c0c3ad11b0ed26");
        $oa = OAuthV1::getInstance();

        $oa->setToken("52999a7589a4a232f66929c606e61fa6d4aaee799d0208f90d9e83f912b18c7b", "c843feb7d110c5643f8c63ce6f83237498085f413356786c388873f76ceaef5b");
        $oa->setParams(["script"=>"202", "deploy"=>1]);
        $result = $oa->sign("POST", $baseUrl, $current_timestamp, sha1(Str::random(32)));

        $options['form_params'] = [
            "recordtype" => "customer",
            "externalid" => 12
        ];

        $options['headers'] = ["Authorization" => $result. ' realm="6982375_SB1"'];

        dd($options);

        $response = $client->request(strtoupper('post'), $baseUrl, $options);

        $body = (string)$response->getBody();
        $body = json_decode($body, true);



        $response = $client->request('post',
            'https://6982375-sb1.restlets.api.netsuite.com/app/site/hosting/restlet.nl?script=202&deploy=1',
            [
                'headers' => $headers,
                'form_params' => [
                    "recordtype" => "customer",
                    "externalid" => 12
                ]
            ]);

            return $response;

//            $defaultRoles = $this->roleRepository->findByField('default', '1');
//            $defaultRoles = $defaultRoles->pluck('name')->toArray();
//            $user->assignRole($defaultRoles);
//        }

        return $this->sendResponse($user, 'User retrieved successfully');
    }

    public function trandata(Request $request)
    {



        $details = [[
            'amt'=> "100552.0",
            'action'=> "1",
            'password'=> "1oR12tD#IrC1j#@",
            'id'=> "1Vl693XRjWVv1tz",
            'currencyCode'=>"682",
            'trackId'=> random_int(10000000000,90000000000),
            'responseURL'=> "https://apps.apple.com/us/app/%D8%AA%D8%B1%D9%83%D9%8A-%D9%84%D9%84%D8%B0%D8%A8%D8%A7%D8%A6%D8%AD/id1115628569",
            'errorURL'=> "https://play.google.com/store/apps/details?id=com.digishapes.turkieshop&hl=ar&gl=US"
        ]];

        //return $details;
        $jsonDetails = json_encode($details);

        $working = json_decode('[{
        "amt": "10000.0",
  "action": "1",
  "password": "1oR12tD#IrC1j#@",
  "id": "1Vl693XRjWVv1tz",
  "currencyCode": "682",
  "trackId": "6841258741346605",
"responseURL":"https://apps.apple.com/us/app/%D8%AA%D8%B1%D9%83%D9%8A-%D9%84%D9%84%D8%B0%D8%A8%D8%A7%D8%A6%D8%AD/id1115628569",
"errorURL":"https://play.google.com/store/apps/details?id=com.digishapes.turkieshop&hl=ar&gl=US"
}]');

        $working1 ='[{
        "amt": "10000.0",
  "action": "1",
  "password": "1oR12tD#IrC1j#@",
  "id": "1Vl693XRjWVv1tz",
  "currencyCode": "682",
  "trackId": "684975346605",
"responseURL":"https://apps.apple.com/us/app/%D8%AA%D8%B1%D9%83%D9%8A-%D9%84%D9%84%D8%B0%D8%A8%D8%A7%D8%A6%D8%AD/id1115628569",
"errorURL":"https://play.google.com/store/apps/details?id=com.digishapes.turkieshop&hl=ar&gl=US"
}]';

        $str = $jsonDetails;

        $en = $this->encryptAES(($working1), 11372990452411372990452411372990);

        $de = $this->decryptAES($en, 11372990452411372990452411372990);

        dd($details, $str, strtoupper($en), $de, json_encode($working), $working );


    }

    function encryptAES($str,$key)
    {
        $str = $this->pkcs5_pad($str);
        $ivlen = openssl_cipher_iv_length($cipher="AES-256-CBC");
        $iv="PGKEYENCDECIVSPC";
        $encrypted = openssl_encrypt($str, "AES-256-CBC",$key,  OPENSSL_ZERO_PADDING, $iv);
        $encrypted = base64_decode($encrypted);
        $encrypted = unpack('C*', ($encrypted));
        $encrypted=$this->byteArray2Hex($encrypted);
//        $encrypted = urlencode($encrypted);
        return $encrypted;
    }

    function decryptAES ($code, $key)
    {
        $code = $this->hex2ByteArray(trim($code));
        $code=$this->byteArray2String($code);
        $iv = "PGKEYENCDECIVSPC";
        $code = base64_encode($code);
        $decrypted = openssl_decrypt($code, 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING,
            $iv);
        return $this->pkcs5_unpad($decrypted);
    }

    private static function pkcs5_pad($text)
    {
        $blocksize = 16;
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    private static function pkcs5_unpad($text)
    {
        $block = 16;
        $pad = ord($text[(strlen($text)) - 1]);
        $len = strlen($text);
        $pad = ord($text[$len-1]);
        return substr($text, 0, strlen($text) - $pad);
    }


//    function pkcs5_pad ($text) {
//        $blocksize = openssl_cipher_iv_length($cipher='AES-256-CBC');
//        $pad = $blocksize - (strlen($text) % $blocksize);
//        return $text . str_repeat(chr($pad), $pad);
//    }
//
//    function pkcs5_unpad($text) {
//        $pad = ord($text[strlen($text)-1]);
//        if ($pad > strlen($text)) {
//            return false;
//        }
//        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
//            return false;
//        }
//        return substr($text, 0, -1 * $pad);
//    }

    function byteArray2Hex($byteArray) {
        $chars = array_map("chr", $byteArray);
        $bin = join($chars);
        return bin2hex($bin);
    }

    function hex2ByteArray($hexString) {
        $string = hex2bin($hexString);
        return unpack('C*', $string);
    }

    function byteArray2String($byteArray) {
        $chars = array_map("chr", $byteArray);
        return join($chars);
    }


}



