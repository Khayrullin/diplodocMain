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
     * @method GET
     * @return Response|json
     */
    public function get_data()
    {
        // API Configuration [Return Array: User Token Data]
        $user_data = $this->_apiConfig([
            'methods' => ['GET'],
            'requireAuthorization' => true,
        ]);
        $this->load->model('Manager_model');
        $managerId = $this->Manager_model->get_manager_by_userId($user_data['token_data']['id'])['id'];

        $this->load->model('Project_model');
        $projectId = $this->Project_model->get_managers_project($managerId);

        $this->load->model('Task_model');
        $data['task'] = $this->Task_model->get_projects_task($projectId[0]['id']);

        $this->load->model('Material_model');
        $i = 0;
        foreach ($data['task'] as $t) {
            $data['task'][$i]['materials'] = $this->Material_model->get_tasks_materials($t['id']);
            $i++;
        }

        $this->load->model('Report_model');
        $this->load->model('Wasted_material_model');
        $this->load->model('Workman_model');
        $this->load->model('Status_model');
        $i = 0;
        foreach ($data['task'] as $t) {
            $data['task'][$i]['reports'] = $this->Report_model->get_task_reports($t['id']);
            $data['task'][$i]['status'] = $this->Status_model->get_status($t['id']);
            $j = 0;
            foreach ($data['task'][$i]['reports'] as $r) {
                $data['task'][$i]['reports'][$j]['wmaterials'] = $this->Wasted_material_model->get_reports_wMaterials($r['id']);
                $data['task'][$i]['reports'][$j]['workman_id'] = $this->Workman_model->get_workman($data['task'][$i]['reports'][$j]['workman_id']);
                $data['task'][$i]['reports'][$j]['status'] = $this->Status_model->get_status($data['task'][$i]['reports'][$j]['status_id']);
                $j++;
            }
            $i++;
        }
        $data['task'][0]['all_workers'] = $this->Workman_model->get_all_workman();


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

    /**
     * View User Data
     *
     * @method POST
     * @return Response|json
     */
    public function post_data()
    {
        // API Configuration [Return Array: User Token Data]
        $user_data = $this->_apiConfig([
            'methods' => ['POST'],
            'requireAuthorization' => true,
        ]);

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $params = array(
            'task_id' => $request->task_id,
            'workman_id' => $request->workman_id,
            'amount' => $request->amount,
            'type_of_work' => $request->type_of_work,
            'work_hours' => $request->work_hours,
            'sendtime' => date("Y-m-d H:i:s"),
            'status_id' => 3,
//          'documents' => $request->documents,
        );
        $this->load->model('Report_model');
        $report_id = $this->Report_model->add_report($params);
        $this->load->model('Wasted_material_model');
        $this->load->model('Document_model');

        foreach ($request->materials as $wmaterial) {
            $params = array(
                'material_id' => $wmaterial->id,
                'report_id' => $report_id,
                'amount' => $wmaterial->wasted
            );
            $this->Wasted_material_model->add_wasted_material($params);
        }


        $this->api_return(
            [
                'status' => true,
                "result" => [
                    'message' => $report_id,
                ],

            ],
            200);


    }
}