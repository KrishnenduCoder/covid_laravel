<?php
namespace App\lib;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;
use GuzzleRetry\GuzzleRetryMiddleware;
use GuzzleHttp\HandlerStack;
use http\Env;
use \Session;

class CovidApi
{
    private $apiAuthKey;
    private $baseApiUri = 'http://localhost:8080/';
    private $loginEmail = 'ksett.digiswift@gmail.com';
    private $loginPassword = 123456;
    const RETRY_ATTEMPT_NUM = 2;
    const RETRY_ON_HTTP_CODE = array(400, 404, 503);

    /**
     * Authenticate COVID-19 API to get x-access-token
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function apiAuthenticate()
    {
        try
        {
            $url =  $this->baseApiUri . 'login';

            $client = new Client();
            $response = $client->request('POST', $url, [
                'form_params' => array('email' => $this->loginEmail, 'password' => $this->loginPassword)
            ]);

            if($response->getStatusCode() === 200 && $response->getReasonPhrase() === 'OK')
            {
                //$responseData = $response->getBody()->read(1024);
                $responseArr = json_decode($response->getBody(), true);

                if(json_last_error() === JSON_ERROR_NONE && $responseArr['success'] === true)
                {
                    $sessionID = uniqid(\env('UNIQUID_PREFIX'));
                    session(['api_auth_token' => $responseArr['data']['token']]);
                    session(['_session_id' => $sessionID]);
                    session(['_session_time' => date('Y-m-d H:i:s')]);
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        catch(\Exception $e)
        {
            return false;
        }
    }

    /**
     * Request COVID-19 API
     * @param String $urlEndPoint
     * @param null $args
     * @return bool
     */
    public function apiGET(String $urlEndPoint, $args = null)
    {
        if(!$args) $url = $this->baseApiUri . $urlEndPoint;
        else $url = $this->baseApiUri . $urlEndPoint . '/' . $args;

        try
        {
            $stack = HandlerStack::create();
            $stack->push(GuzzleRetryMiddleware::factory([
                'max_retry_attempts' => self::RETRY_ATTEMPT_NUM,
                'retry_on_status' => self::RETRY_ON_HTTP_CODE,
            ]));

            $client = new Client();
            $promise = $client->requestAsync('GET', $url, [
                'headers' => [
                    'User-Agent' => 'Covid-Project Agent',
                    'Accept'     => 'application/json',
                    'x-access-token' => session()->get('api_auth_token'),
                ],
                'handler' => $stack
            ]);

            $response = $promise->wait();

            if($response->getStatusCode() === 200 && $response->getReasonPhrase() === 'OK')
            {
                //$responseData = $response->getBody()->getContents();
                $responseArr = json_decode($response->getBody(), true);

                if(json_last_error() === JSON_ERROR_NONE && $responseArr['success'] === true) return $responseArr['data'];
                else return false;
            }
            else
            {
                return false;
            }
        }
        catch(\Exception $e)
        {
            return false;
        }
    }
}