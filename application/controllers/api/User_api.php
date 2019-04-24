<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/API_Controller.php';

class User_api extends API_Controller
{
    public function __construct()
    {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }

    /**
     * Simple API
     *
     * @link : api/v1/simple
     */
    public function simple_api()
    {
        header("Access-Control-Allow-Origin: *");
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST', 'GET'], // Request Execute Only POST and GET Method
        ]);
    }

    /**
     * API Limit
     *
     * @link : api/v1/limit
     */
    public function api_limit()
    {
        /**
         * API Limit
         * ----------------------------------
         * @param: {int} API limit Number
         * @param: {string} API limit Type (IP)
         * @param: {int} API limit Time [minute]
         */
        $this->_APIConfig([
            'methods' => ['POST'],
            /**
             * Number limit, type limit, time limit (last minute)
             */
            'limit' => [15, 'ip', 'everyday']
        ]);
    }

    /**
     * API Key without Database
     */
    public function api_key()
    {
        /**
         * Use API Key without Database
         * ---------------------------------------------------------
         * @param: {string} Types
         * @param: {string} API Key
         */
        $this->_APIConfig([
            'methods' => ['POST'],
            // 'key' => ['header', '123456'],
            // API Key with Database
            'key' => ['header'],
            // Add Custom data in API Response
            'data' => [
                'is_login' => false,
            ],
        ]);
        // Data
        $data = array(
            'status' => 'OK',
            'data' => [
                'user_id' => 12,
            ]
        );
        /**
         * Return API Response
         * ---------------------------------------------------------
         * @param: API Data
         * @param: Request Status Code
         */
        if (!empty($data)) {
            $this->api_return($data, '200');
        } else {

            $this->api_return(['status' => false, 'error' => 'Invalid Data'], '404');
        }
    }

    /**
     * Login User with API
     */
    public function login()
    {
        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
        ]);
        $debug = true;
        if ($debug) {
            if ($this->ion_auth->login($this->input->post('login'), $this->input->post('password'))) {

                $group = 'manager';
                if ($this->ion_auth->in_group($group)) {

                    $user = $this->ion_auth->user()->result()[0];
                    $payload = [
                        'id' => $user->id,
                        'other' => $user->email
                    ];

                    $this->load->library('authorization_token');

                    $token = $this->authorization_token->generateToken($payload);
                    // return data
                    $this->api_return(
                        [
                            'status' => true,
                            "result" => [
                                'token' => $token,
                            ],
                        ],
                        200);
                } else {
                    $this->ion_auth->logout();
                    $this->api_return(
                        [
                            'status' => true,
                            "result" => [
                                'message' => 'Access Denied for non-workers',
                            ],

                        ],
                        401);
                }
            } else {
                $this->api_return(
                    [
                        'status' => true,
                        "result" => [
                            'message' => "Invalid Email or Password",
                        ],

                    ],
                    401);
            }
        } else {

            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $email = $request->login;
            $pass = $request->password;

            if ($this->ion_auth->login($email, $pass)) {

                $group = 'manager';
                if ($this->ion_auth->in_group($group)) {

                    $user = $this->ion_auth->user()->result()[0];
                    $payload = [
                        'id' => $user->id,
                        'other' => $user->email
                    ];

                    $this->load->library('authorization_token');

                    $token = $this->authorization_token->generateToken($payload);
                    // return data
                    $this->api_return(
                        [
                            'status' => true,
                            "result" => [
                                'token' => $token,
                            ],
                        ],
                        200);
                } else {
                    $this->ion_auth->logout();
                    $this->api_return(
                        [
                            'status' => true,
                            "result" => [
                                'message' => 'Access Denied for non-workers',
                            ],

                        ],
                        401);
                }
            } else {
                $this->api_return(
                    [
                        'status' => true,
                        "result" => [
                            'message' => "Invalid Email or Password",
                        ],

                    ],
                    401);
            }

    }


}

/**
 * View User Data
 *
 * @method POST
 * @return Response|void
 */
public
function view()
{
    header("Access-Control-Allow-Origin: *");
    // API Configuration [Return Array: User Token Data]
    $user_data = $this->_apiConfig([
        'methods' => ['POST'],
        'requireAuthorization' => true,
    ]);
    // return data
    $this->api_return(
        [
            'status' => true,
            "result" => [
                'user_data' => $user_data['token_data']
            ],
        ],
        200);
}
}