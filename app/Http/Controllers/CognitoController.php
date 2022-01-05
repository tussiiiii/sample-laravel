<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


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
        $url = 'https://myapp-dowell-test.auth.us-east-2.amazoncognito.com/logout?client_id=6381mbhkoa982us60mlonkhu79&logout_uri=https://atros.ml/';
        header('Location: ' . $url, true , 301);
        exit;
        // return redirect('/tasks');

    }

}
