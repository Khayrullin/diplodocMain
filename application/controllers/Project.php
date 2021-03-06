<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Project extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
    }

    /*
     * Listing of project
     */
    function index()
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {

            $data['project'] = $this->Project_model->get_all_project();

            $this->load->model('Manager_model');
            $data['manager'] = $this->Manager_model->get_all_manager();

            $data['_view'] = 'project/index';
            $this->load->view('layouts/main', $data);
        }
    }

    function get_employers_projects()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {

            $this->data['user'] = $this->ion_auth->user()->result();

            $this->load->model('Employer_model');
            $data['employer'] = $this->Employer_model->get_employer_by_user($this->data['user'][0]->id);


            $employer_id =$data['employer'][0]['id'];
            $data['project'] = $this->Project_model->get_employers_projects($employer_id);

            $this->load->model('Manager_model');
            $data['manager'] = $this->Manager_model->get_all_manager();

            $this->load->model('ion_auth_model');
            $data['users'] = $this->ion_auth_model->getUsers();


            $data['_view'] = 'project/employers_projects';
            $this->load->view('layouts/main', $data);
        }
    }
    

    function get_detail($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {

            $data['project'] = $this->Project_model->get_project($id);
            $this->load->model('Status_model');
            $data['status'] = $this->Status_model->get_all_status();


            $this->load->model('Task_model');
            $data['task'] = $this->Task_model->get_projects_task($id);

            $data['_view'] = 'project/detail';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Adding a new project
     */
    function add()
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {

            if (isset($_POST) && count($_POST) > 0) {
                $params = array(
                    'manager_id' => $this->input->post('manager_id'),
                    'employer_id' => $this->input->post('employer_id'),
                    'name' => $this->input->post('name'),
                );

                $project_id = $this->Project_model->add_project($params);
                redirect('project/index');
            } else {
                $this->load->model('Manager_model');
                $data['all_manager'] = $this->Manager_model->get_all_manager();

                $this->load->model('Employer_model');
                $data['all_employer'] = $this->Employer_model->get_all_employer();

                $data['_view'] = 'project/add';
                $this->load->view('layouts/main', $data);
            }
        }
    }

    /*
     * Editing a project
     */
    function edit($id)
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {

            // check if the project exists before trying to edit it
            $data['project'] = $this->Project_model->get_project($id);

            if (isset($data['project']['id'])) {
                if (isset($_POST) && count($_POST) > 0) {
                    $params = array(
                        'manager_id' => $this->input->post('manager_id'),
                        'employer_id' => $this->input->post('employer_id'),
                        'name' => $this->input->post('name'),
                    );

                    $this->Project_model->update_project($id, $params);
                    redirect('project/index');
                } else {
                    $this->load->model('Manager_model');
                    $data['all_manager'] = $this->Manager_model->get_all_manager();

                    $this->load->model('Employer_model');
                    $data['all_employer'] = $this->Employer_model->get_all_employer();

                    $data['_view'] = 'project/edit';
                    $this->load->view('layouts/main', $data);
                }
            } else {
                show_error('The project you are trying to edit does not exist.');
            }
        }
    }

    /*
     * Deleting project
     */
    function remove($id)
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {

            $project = $this->Project_model->get_project($id);

            // check if the project exists before trying to delete it
            if (isset($project['id'])) {
                $this->Project_model->delete_project($id);
                redirect('project/index');
            } else {
                show_error('The project you are trying to delete does not exist.');
            }
        }
    }

}
