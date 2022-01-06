<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Firebase\JWT\JWT;


class CognitoController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');

    }

    /**
     * delete aws cognito's SessionCookie 
     *
     * @param  Request  $request
     * @return Response
     */
    public function logout(Request $request)
    {
        setcookie("AWSELBAuthSessionCookie-0", "", time() - 3600, "/");
        setcookie("AWSELBAuthSessionCookie-1", "", time() - 3600, "/");
        // リダイレクト先のURLへ転送
        $url = 'https://myapp-dowell-test.auth.us-east-2.amazoncognito.com/logout?client_id=6381mbhkoa982us60mlonkhu79&logout_uri=https://atros.ml';
        header('Location: ' . $url, true , 301);
        exit;
        // return redirect('/tasks');

    }

    /**
     * get aws cognito's x-amzn-oidc-data(JWT) 
     *
     * @param  Request  $request
     */
    public function getUserInfo(Request $request) {
        // step 1: Get the key id from JWT headers (the kid field)
        $encoded_jwt = $request->header('x-amzn-oidc-data');
        $jwt_headers = explode('.', $encoded_jwt)[0];
        $decoded_jwt_headers = base64_decode($jwt_headers);
        $decoded_json = json_decode($decoded_jwt_headers);
      
        // step 2: Get the public key from regional endpoint
        $kid = $decoded_json->kid;
        $region = 'us-east-2';
        $url = 'https://public-keys.auth.elb.' . $region . '.amazonaws.com/' . $kid;
        $pub_key = file_get_contents($url);
      
        // step 3: Get the payload
        $result = JWT::decode($encoded_jwt, $pub_key, ['ES256']);
        var_dump($result);

        return $this->redirect(['action' => '/', $result]);

      }

}
