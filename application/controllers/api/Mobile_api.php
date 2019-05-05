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
        $this->load->model('Document_model');
        $i = 0;
        foreach ($data['task'] as $t) {
            $data['task'][$i]['reports'] = $this->Report_model->get_task_reports($t['id']);
            $data['task'][$i]['status'] = $this->Status_model->get_status($t['id']);
            $j = 0;
            foreach ($data['task'][$i]['reports'] as $r) {
                $data['task'][$i]['reports'][$j]['wmaterials'] = $this->Wasted_material_model->get_reports_wMaterials($r['id']);
                $data['task'][$i]['reports'][$j]['workman_id'] = $this->Workman_model->get_workman($data['task'][$i]['reports'][$j]['workman_id']);
                $data['task'][$i]['reports'][$j]['status'] = $this->Status_model->get_status($data['task'][$i]['reports'][$j]['status_id']);
                $data['task'][$i]['reports'][$j]['documents'] = $this->Document_model->get_documents($r['id']);
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
        $documents = '';


        $this->load->model('Wasted_material_model');
        $this->load->model('Document_model');
        $this->load->model('Material_model');
        $this->load->model('Workman_model');
        $this->load->model('Report_model');


        foreach ($request->data as $report) {
            $rep = $report;
            $params = array(
                'task_id' => $rep->task_id,
                'workman_id' => $rep->workman_id,
                'amount' => $rep->amount,
                'type_of_work' => $rep->type_of_work,
                'work_hours' => $rep->work_hours,
                'sendtime' => date("Y-m-d H:i:s"),
                'status_id' => 3,
            );

            $report_id = $this->Report_model->add_report($params);


            if (isset($rep->documents)) {
                foreach ($rep->documents as $doc) {
                    $params = array(
                        'report_id' => $report_id,
                        'name' => $doc->name,
                        'data' => $doc->photo,
                    );
                    $this->Document_model->add_document($params);
                }
            }
            if (isset($rep->materials)) {
                foreach ($rep->materials as $wmaterial) {
                    if ($wmaterial->wasted != 0) {
                        $params = array(
                            'material_id' => $wmaterial->id,
                            'report_id' => $report_id,
                            'amount' => $wmaterial->wasted
                        );
                        $this->Wasted_material_model->add_wasted_material($params);


                        $data['material'] = $this->Material_model->get_material(intval($wmaterial->id));


                        $params = array(
                            'quantity_left' => intval($data['material']['quantity_left']) - intval($wmaterial->wasted)
                        );
                        $this->Material_model->update_material($wmaterial->id, $params);
                    }

                }
            }

            $data['workman'] = $this->Workman_model->get_workman($rep->workman_id);
            $params = array(
                'unpaid_hours' => intval($data['workman']['unpaid_hours']) + intval($rep->work_hours)
            );
            $this->Workman_model->update_workman($rep->workman_id, $params);

        }


        $this->api_return(
            [
                'status' => true,
                "result" => [
                    'message' => 'Saved Successfully',
                ],

            ],
            200);
    }
}