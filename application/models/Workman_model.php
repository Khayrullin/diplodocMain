<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Workman_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get workman by id
     */
    function get_workman($id)
    {
        return $this->db->get_where('workman',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all workman count
     */
    function get_all_workman_count()
    {
        $this->db->from('workman');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all workman
     */
    function get_all_workman($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('workman')->result_array();
    }
        
    /*
     * function to add new workman
     */
    function add_workman($params)
    {
        $this->db->insert('workman',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update workman
     */
    function update_workman($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('workman',$params);
    }
    
    /*
     * function to delete workman
     */
    function delete_workman($id)
    {
        return $this->db->delete('workman',array('id'=>$id));
    }
}
