<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Status extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Status_model');
    } 

    /*
     * Listing of status
     */
    function index()
    {
        $data['status'] = $this->Status_model->get_all_status();
        
        $data['_view'] = 'status/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new status
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'name' => $this->input->post('name'),
            );
            
            $status_id = $this->Status_model->add_status($params);
            redirect('status/index');
        }
        else
        {            
            $data['_view'] = 'status/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a status
     */
    function edit($id)
    {   
        // check if the status exists before trying to edit it
        $data['status'] = $this->Status_model->get_status($id);
        
        if(isset($data['status']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'name' => $this->input->post('name'),
                );

                $this->Status_model->update_status($id,$params);            
                redirect('status/index');
            }
            else
            {
                $data['_view'] = 'status/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The status you are trying to edit does not exist.');
    } 

    /*
     * Deleting status
     */
    function remove($id)
    {
        $status = $this->Status_model->get_status($id);

        // check if the status exists before trying to delete it
        if(isset($status['id']))
        {
            $this->Status_model->delete_status($id);
            redirect('status/index');
        }
        else
            show_error('The status you are trying to delete does not exist.');
    }
    
}
