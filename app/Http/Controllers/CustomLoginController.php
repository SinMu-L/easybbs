<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class CustomLoginController extends Controller
{
    public function index(Request $request){
        $code = $request->get('code');
        // 用code 获取 access_token
        $client_id = env('GITHUB_CLIENT_ID');
        $client_secret = env('GITHUB_CLIENT_SECRET');
        $getParams = "client_id={$client_id}&client_secret={$client_secret}&code={$code}";
        $url = 'https://github.com/login/oauth/access_token?'.$getParams;
        // TODO 对接github OAtuh App, 将对接流程变得优雅一些
        // https://docs.github.com/zh/apps/oauth-apps/building-oauth-apps/authorizing-oauth-apps#web-application-flow
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->post($url);
            $data = $response->json();
            if (array_key_exists('error',$data)){
                return 'error: ' . $data['error'];
            }
            $access_token = $data['access_token'];
            // 获取用户数据
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. $access_token
            ])->get('https://api.github.com/user');
            $user = $response->json();
            // 若此用户已注册，则登录，否则就直接登录
            $existsed = User::where('name','=',$user['login'])->first();
            if (!$existsed){
                $newUser = User::create([
                    'name' => $user['login'],
                    'email' => '',
                    'password'=>bcrypt($user['id'])
                ]);
            }
            Auth::login($newUser);
            return redirect('/')->with('success','注册成功');

        }catch (\Exception $e){
            $error= $e->getMessage();
            return $error;
        }

    }

    /**
     * 返回一个数组
     * ["content" => response body,
     * "error" => error info,
     * "responseCode" => 200]
     * @return array
     * @param string $url   请求的url
     * @param string $body  请求的body，可以是二进制也可以是json
     * @param string $method    请求方法，默认为 GET
     * @param array $headers    请求headers，期待是一个键值对数组
     * @param bool $certPath    请求证书，默认不使用证书
     */
    function request( $url, $body = "", $method = "GET", $headers = [], $certPath = false )
    {
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_INFILESIZE => -1,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => true,
        ];

        if( $body != "" ) {
            $options[CURLOPT_POSTFIELDS] = $body;
        }
        if( $method === "POST" ) {
            $options[CURLOPT_POST] = true;
        } else if(  $method !== "GET" ) {
            $options[ CURLOPT_CUSTOMREQUEST ] = $method;
        }

        if ( count($headers) )
        {
            $dataHeaders = [];
            foreach ($headers as $key => $value)
                $dataHeaders[] = $key . ': ' . $value;

            $options[ CURLOPT_HTTPHEADER ] = $dataHeaders;
        }

        if ( $certPath )
            $options[CURLOPT_CAINFO] = $certPath;

        $result = [];
        $result["error"] = false;
        $result["content"] = null;

        try
        {
            if (!$curl = curl_init())
                throw new Exception('Unable to initialize cURL');

            if (!curl_setopt_array($curl, $options))
                throw new Exception(curl_error($curl));

            $response = curl_exec($curl);
            if(  $response === false )
                throw new Exception( curl_error($curl) );

            $result["responseCode"] = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
            $headerSize = curl_getinfo( $curl, CURLINFO_HEADER_SIZE );
            $result["content"] = substr( $response, $headerSize );

            if( !$result["content"] )
                $result["content"] = "";

            $result["header"] = substr( $response, 0, $headerSize );

            curl_close($curl);
        }
        catch ( Exception $e )
        {
            $result["error"] = "CURL error: " . $e->getMessage();
        }

        return $result;
    }
}
