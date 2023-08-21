<?php 

class User_model extends CI_Model
{
    function insertUser($data)
    {
        $this->db->insert('products',$data);
        if ($this->db->affected_rows() >= 0) {
            return true; 
        } else {
            return false; 
        }
    }

    function getUsers()
    {
        $query = $this->db->get('products');
        return $query->result_array();
    }

    function getUser($id)
    {
        $this->db->where('id',$id);
        $query=$this->db->get('products');
        return $query->row();

    }

    function updateUser($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('products',$data);
        if ($this->db->affected_rows() >= 0) {
            return true; 
        } else {
            return false; 
        }
    }

    function deleteUser($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('products');
        if ($this->db->affected_rows() >= 0) {
            return true; 
        } else {
            return false; 
        }
    }
}