<?php
/**
 * Created by PhpStorm.
 * User: habar
 * Date: 06.04.2019
 * Time: 12:08
 */

class Demo extends CI_Controller
{

    public function registration()
    {
        // API key
        $apiKey = 'CODEX@123';


// API URL
        $url = 'http://diplodoc.ru/api/authentication/registration/';

// User account info
        $userData = array(
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'login_pass',
            'phone' => '123-456-7890'
        );

// Create a new cURL resource
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $apiKey));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);

        $result = curl_exec($ch);

// Close cURL resource
        curl_close($ch);

        echo print_r($result);
    }


    /**
     * @return object
     */
    public function login()
    {

        // API key
        $apiKey = 'CODEX@123';

// API auth credentials
        $apiUser = "admin";
        $apiPass = "1234";

// API URL
        $url = 'http://diplodoc.ru/api/authentication/login/';

// User account login info
        $userData = array(
            'email' => 'john@example.com',
            'password' => 'login_pass'
        );

// Create a new cURL resource
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $apiKey));
        curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);

        $result = curl_exec($ch);

// Close cURL resource
        curl_close($ch);

        echo print_r($result);


    }

    /**
     * @return object
     */
    public function get()
    {
        // API key
        $apiKey = 'CODEX@123';

// API auth credentials
        $apiUser = "admin";
        $apiPass = "1234";


        $user = array(
            "id" => "1",
            "first_name" => "First",
            "insertion" => "",
            "last_name" => "Last"
        );

        $this->session->userdata = $user;


// Specify the ID of the user
        $userID = 1;

// API URL
        $url = 'http://diplodoc.ru/api/authentication/user/' . $userID;

// Create a new cURL resource
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $apiKey));
     //   curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");

        $result = curl_exec($ch);

// Close cURL resource
        curl_close($ch);
        echo print_r($result);
    }

    /**
     * @return object
     */
    public function update()
    {

        // API key
        $apiKey = 'CODEX@123';

// API auth credentials
        $apiUser = "admin";
        $apiPass = "1234";

// Specify the ID of the user
        $userID = 1;

// API URL
        $url = 'http://diplodoc.ru/api/authentication/user/';

// User account info
        $userData = array(
            'id' => 1,
            'first_name' => 'John2',
            'last_name' => 'Doe2',
            'email' => 'john2@example.com',
            'password' => 'user_new_pass',
            'phone' => '545-856-3439'
        );

// Create a new cURL resource
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array('X-API-KEY: ' . $apiKey, 'Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($userData));

        $result = curl_exec($ch);

// Close cURL resource
        curl_close($ch);
        echo print_r($result);
    }

}