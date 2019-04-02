<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Project extends CI_Controller{
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
        $data['project'] = $this->Project_model->get_all_project();
        
        $data['_view'] = 'project/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new project
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'manager_id' => $this->input->post('manager_id'),
				'employer_id' => $this->input->post('employer_id'),
				'name' => $this->input->post('name'),
            );
            
            $project_id = $this->Project_model->add_project($params);
            redirect('project/index');
        }
        else
        {
			$this->load->model('Manager_model');
			$data['all_manager'] = $this->Manager_model->get_all_manager();

			$this->load->model('Employer_model');
			$data['all_employer'] = $this->Employer_model->get_all_employer();
            
            $data['_view'] = 'project/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a project
     */
    function edit($id)
    {   
        // check if the project exists before trying to edit it
        $data['project'] = $this->Project_model->get_project($id);
        
        if(isset($data['project']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'manager_id' => $this->input->post('manager_id'),
					'employer_id' => $this->input->post('employer_id'),
					'name' => $this->input->post('name'),
                );

                $this->Project_model->update_project($id,$params);            
                redirect('project/index');
            }
            else
            {
				$this->load->model('Manager_model');
				$data['all_manager'] = $this->Manager_model->get_all_manager();

				$this->load->model('Employer_model');
				$data['all_employer'] = $this->Employer_model->get_all_employer();

                $data['_view'] = 'project/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The project you are trying to edit does not exist.');
    } 

    /*
     * Deleting project
     */
    function remove($id)
    {
        $project = $this->Project_model->get_project($id);

        // check if the project exists before trying to delete it
        if(isset($project['id']))
        {
            $this->Project_model->delete_project($id);
            redirect('project/index');
        }
        else
            show_error('The project you are trying to delete does not exist.');
    }
    
}
