<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Manager extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Manager_model');
    }

    /*
     * Listing of manager
     */
    function index()
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {

            $data['manager'] = $this->Manager_model->get_all_manager();

            $data['_view'] = 'manager/index';
            $this->load->view('layouts/main', $data);
        }
    }

    /*
     * Adding a new manager
     */
    function add()
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {

            if (isset($_POST) && count($_POST) > 0) {
                $params = array(
                    'user_id' => $this->input->post('user_id'),
                );

                $manager_id = $this->Manager_model->add_manager($params);
                redirect('manager/index');
            } else {
                $data['_view'] = 'manager/add';
                $this->load->view('layouts/main', $data);
            }
        }
    }

    /*
     * Editing a manager
     */
    function edit($id)
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {

            // check if the manager exists before trying to edit it
            $data['manager'] = $this->Manager_model->get_manager($id);

            if (isset($data['manager']['id'])) {
                if (isset($_POST) && count($_POST) > 0) {
                    $params = array(
                        'user_id' => $this->input->post('user_id'),
                    );

                    $this->Manager_model->update_manager($id, $params);
                    redirect('manager/index');
                } else {
                    $data['_view'] = 'manager/edit';
                    $this->load->view('layouts/main', $data);
                }
            } else {
                show_error('The manager you are trying to edit does not exist.');
            }
        }
    }

    /*
     * Deleting manager
     */
    function remove($id)
    {
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {

            $manager = $this->Manager_model->get_manager($id);

            // check if the manager exists before trying to delete it
            if (isset($manager['id'])) {
                $this->Manager_model->delete_manager($id);
                redirect('manager/index');
            } else {
                show_error('The manager you are trying to delete does not exist.');
            }
        }
    }

}
