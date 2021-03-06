<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Task extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Task_model');
    }

    /*
     * Listing of task
     */
    function index()
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
            $data['task'] = $this->Task_model->get_all_task();

            $data['_view'] = 'task/index';
            $this->load->view('layouts/main', $data);
        }
    }

    function get_detail($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $data['task'] = $this->Task_model->get_task($id);
            $this->load->model('Status_model');
            $data['status'] = $this->Status_model->get_status($data['task']["status_id"]);
            $data['statuses'] = $this->Status_model->get_all_status();
            $this->load->model('Project_model');
            $data['project'] = $this->Project_model->get_project($data['task']["project_id"]);

            $this->load->model('Wasted_material_model');
            $data['wasted'] = $this->Wasted_material_model->get_all_wasted_materials();

            $this->load->model('Material_model');
            $data['materials'] = $this->Material_model->get_tasks_materials($id);

            $this->load->model('Report_model');
            $data['report'] = $this->Report_model->get_task_reports($id);

            $this->load->model('Workman_model');
            $data['workers'] = $this->Workman_model->get_all_workman();


            $data['_view'] = 'task/detail';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Adding a new task
     */
    function add()
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
            if (isset($_POST) && count($_POST) > 0) {
                $date = DateTime::createFromFormat('m/d/Y h:i A', $this->input->post('deadline'));
                $deadline = $date->format('Y-m-d h:i:s');
                $params = array(
                    'project_id' => $this->input->post('project_id'),
                    'status_id' => $this->input->post('status_id'),
                    'quantity' => $this->input->post('quantity'),
                    'unit' => $this->input->post('unit'),
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'deadline' => $deadline,
                    'quantity_done' => $this->input->post('quantity_done'),
                    'quantity_left' => $this->input->post('quantity_left'),
                );

                $task_id = $this->Task_model->add_task($params);
                redirect('task/index');
            } else {
                $this->load->model('Project_model');
                $data['all_project'] = $this->Project_model->get_all_project();

                $this->load->model('Status_model');
                $data['all_status'] = $this->Status_model->get_all_status();

                $data['_view'] = 'task/add';
                $this->load->view('layouts/main', $data);
            }
        }
    }

    /*
     * Importing a bunch of tasks
     */
    function import($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
            {
                if (isset($_FILES["csv"])) {

                    //if there was an error uploading the file
                    if ($_FILES["csv"]["error"] > 0) {
                        echo "Return Code: " . $_FILES["csv"]["error"] . "<br />";

                    } else {
                        $prevTask = 0;
                        if (($h = fopen($_FILES["csv"]["tmp_name"], "r")) !== false) {
                            $this->load->model('Material_model');
                            // Convert each line into the local $data variable
                            while (($data = fgetcsv($h, 1000, ",")) !== false) {

                                if (strpos($data[1], 'абота') !== false) {
                                    $params = array(
                                        'project_id' => $id,
                                        'status_id' => 2,
                                        'quantity' => $data[4],
                                        'unit' => $data[3],
                                        'name' => $data[2],
                                        'description' => $data[2],
                                        'deadline' => date("Y-m-d h:i:s", time() + 604800),
                                        'quantity_done' => 0,
                                        'quantity_left' => $data[4],
                                    );

                                    $prevTask = $this->Task_model->add_task($params);
                                } else {
                                    if (strpos($data[1], 'атериал') !== false) {
                                        $params = array(
                                            'task_id' => $prevTask,
                                            'name' => $data[2],
                                            'unit' => $data[3],
                                            'quantity' => $data[4],
                                            'quantity_left' => $data[4],
                                        );
                                        $this->Material_model->add_material($params);
                                    }
                                }
                            }

                            // Close the file
                            fclose($h);

                            redirect('project/get_detail/' . $id);
                        }
                    }
                } else {
                    echo "No file selected <br />";
                }
            }
        }
    }

    /*
     * Importing a bunch of tasks
     */
    function export($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
            {
                $data = array(array('код задачи', 'код материала', 'количество'));
                $this->load->model('Wasted_material_model');
                $this->load->model('Report_model');
                $tasks = $this->Task_model->get_projects_task($id);
                foreach ($tasks as $task) {
                    $reports = $this->Report_model->get_task_reports($task['id']);
                    foreach ($reports as $report) {
                        $wmaterials = $this->Wasted_material_model->get_reports_wMaterials($report['id']);
                        foreach ($wmaterials as $wm) {

                            array_push($data, array($id, $wm['material_id'], $wm['amount']));

                        }

                    }
                }
                $filename = "data_export_" . date("Y-m-d") . ".csv";

                header('Content-Type: application/csv; charset=UTF-8');

                header("Content-Disposition: attachment;filename={$filename}");
                $f = fopen('php://output', 'w');

                foreach ($data as $fields) {
                    fputcsv($f, $fields);
                }
                fclose($f);


            }
        }
    }


    /*
     * Editing a task
     */


    function edit($id)
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
            // check if the task exists before trying to edit it
            $data['task'] = $this->Task_model->get_task($id);

            if (isset($data['task']['id'])) {
                if (isset($_POST) && count($_POST) > 0) {
                    $deadline = null;
                    if ($this->input->post('deadline') != null) {
                        $date = DateTime::createFromFormat('m/d/Y h:i A', $this->input->post('deadline'));
                        $deadline = $date->format('Y-m-d h:i:s');
                    }
                    $params = array(
                        'project_id' => $this->input->post('project_id'),
                        'status_id' => $this->input->post('status_id'),
                        'quantity' => $this->input->post('quantity'),
                        'unit' => $this->input->post('unit'),
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                        'deadline' => $deadline ? $deadline : $this->input->post('deadline'),
                        'quantity_done' => $this->input->post('quantity_done'),
                        'quantity_left' => $this->input->post('quantity_left'),
                    );
                    $this->Task_model->update_task($id, $params);
                    redirect('task/index');
                } else {
                    $this->load->model('Project_model');
                    $data['all_project'] = $this->Project_model->get_all_project();

                    $this->load->model('Status_model');
                    $data['all_status'] = $this->Status_model->get_all_status();

                    $data['_view'] = 'task/edit';
                    $this->load->view('layouts/main', $data);
                }
            } else {
                show_error('The task you are trying to edit does not exist.');
            }
        }
    }


    function edit_by_user($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            // check if the task exists before trying to edit it
            $data['task'] = $this->Task_model->get_task($id);

            if (isset($data['task']['id'])) {
                if (isset($_POST) && count($_POST) > 0) {
                    $deadline = null;
                    if ($this->input->post('deadline') != null) {
                        $date = DateTime::createFromFormat('m/d/Y h:i A', $this->input->post('deadline'));
                        $deadline = $date->format('Y-m-d h:i:s');
                    }
                    $params = array(
                        'status_id' => $this->input->post('status_id'),
                        'deadline' => $deadline ? $deadline : $this->input->post('deadline'),
                    );
                    $this->Task_model->update_task($id, $params);
                    redirect('task/get_detail/' . $id);
                } else {
                    $this->load->model('Project_model');
                    $data['all_project'] = $this->Project_model->get_all_project();

                    $this->load->model('Status_model');
                    $data['all_status'] = $this->Status_model->get_all_status();

                    $data['_view'] = 'task/edit';
                    $this->load->view('layouts/main', $data);
                }
            } else {
                show_error('The task you are trying to edit does not exist.');
            }
        }
    }

    /*
     * Deleting task
     */
    function remove($id)
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
            $task = $this->Task_model->get_task($id);

            // check if the task exists before trying to delete it
            if (isset($task['id'])) {
                $this->Task_model->delete_task($id);
                redirect('task/index');
            } else {
                show_error('The task you are trying to delete does not exist.');
            }
        }
    }

}
