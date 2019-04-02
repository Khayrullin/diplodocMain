<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Document_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get document by id
     */
    function get_document($id)
    {
        return $this->db->get_where('documents',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all documents
     */
    function get_all_documents()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('documents')->result_array();
    }
        
    /*
     * function to add new document
     */
    function add_document($params)
    {
        $this->db->insert('documents',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update document
     */
    function update_document($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('documents',$params);
    }
    
    /*
     * function to delete document
     */
    function delete_document($id)
    {
        return $this->db->delete('documents',array('id'=>$id));
    }
}
