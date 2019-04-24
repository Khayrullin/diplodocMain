<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/API_Controller.php';

class Mobile_api extends API_Controller
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
     * View User Data
     *
     * @method POST
     * @return Response|json
     */
    public function get_dashboard()
    {
        // API Configuration [Return Array: User Token Data]
        $user_data = $this->_apiConfig([
            'methods' => ['POST'],
            'requireAuthorization' => true,
        ]);


        $this->load->model('Manager_model');
        $managerId = $this->Manager_model->get_manager_by_userId($user_data['token_data']['id'])['id'];

        $this->load->model('Project_model');
        $projectId = $this->Project_model->get_managers_project($managerId);

        $this->load->model('Task_model');
        $data['task'] = $this->Task_model->get_projects_task($projectId[0]['id']);
        $out = array_values($data['task']);
        json_encode($out);
        // return data
        $this->api_return(
            [
                'status' => true,
                "result" => $out

            ],
            200);
    }
}