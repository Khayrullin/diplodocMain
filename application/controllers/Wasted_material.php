<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Wasted_material extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Wasted_material_model');
    } 

    /*
     * Listing of wasted_materials
     */
    function index()
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
            $data['wasted_materials'] = $this->Wasted_material_model->get_all_wasted_materials();

            $data['_view'] = 'wasted_material/index';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Adding a new wasted_material
     */
    function add()
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'material_id' => $this->input->post('material_id'),
				'report_id' => $this->input->post('report_id'),
				'amount' => $this->input->post('amount'),
            );
            
            $wasted_material_id = $this->Wasted_material_model->add_wasted_material($params);
            redirect('wasted_material/index');
        }
        else
        {
			$this->load->model('Material_model');
			$data['all_materials'] = $this->Material_model->get_all_materials();

			$this->load->model('Report_model');
			$data['all_report'] = $this->Report_model->get_all_report();
            
            $data['_view'] = 'wasted_material/add';
            $this->load->view('layouts/main',$data);
        }}
    }  

    /*
     * Editing a wasted_material
     */
    function edit($id)
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
        // check if the wasted_material exists before trying to edit it
        $data['wasted_material'] = $this->Wasted_material_model->get_wasted_material($id);
        
        if(isset($data['wasted_material']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'material_id' => $this->input->post('material_id'),
					'report_id' => $this->input->post('report_id'),
					'amount' => $this->input->post('amount'),
                );

                $this->Wasted_material_model->update_wasted_material($id,$params);            
                redirect('wasted_material/index');
            }
            else
            {
				$this->load->model('Material_model');
				$data['all_materials'] = $this->Material_model->get_all_materials();

				$this->load->model('Report_model');
				$data['all_report'] = $this->Report_model->get_all_report();

                $data['_view'] = 'wasted_material/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The wasted_material you are trying to edit does not exist.');
    } }

    /*
     * Deleting wasted_material
     */
    function remove($id)
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('/', 'refresh');
        } else {
            $wasted_material = $this->Wasted_material_model->get_wasted_material($id);

            // check if the wasted_material exists before trying to delete it
            if (isset($wasted_material['id'])) {
                $this->Wasted_material_model->delete_wasted_material($id);
                redirect('wasted_material/index');
            } else {
                show_error('The wasted_material you are trying to delete does not exist.');
            }
        }
    }
    
}
