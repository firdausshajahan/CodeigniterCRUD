<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 //class name as filename
class Postmodel extends CI_Model 
{
    //post is table name in Database phpmyadmin
    var $table = "post";
    function __construct()
    {
        parent::__construct();
    }

    //q is query for select all
    function getAll()
    {
        $q = $this->db->get($this->table);
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        return array();
    }

    //pass parameter $data
    function add($data)
    {
        $this->db->insert($this->table,$data);
    }

    //update data base on id
    function update($data,$id)
    {
        $this->db->where("id",$id);
        $this->db->update($this->table,$data);
    }

    //delete data base on id
    function delete($id)
    {
        $this->db->where("id",$id);
        $this->db->delete($this->table);
    }

    //Get Specific ID
    function getById($id)
    {
        $this->db->where("id",$id);
        $q = $this->db->get($this->table);
        if($q->num_rows() > 0)
        {
            return $q->row();
        }
        return false;
    }
}