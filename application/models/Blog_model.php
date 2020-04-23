<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {

    public function getFilterBlog($filter, $limit, $offset){
        $this->db->like('title', $filter);
        $this->db->limit($limit, $offset);
        return $this->db->get('blog')->result_array();
    }

    public function getTotalBlogs($filter='')
    {
        if($filter == '')
        {
            return $this->db->count_all_results('blog');
        }else
        {
            $this->db->like('title', $filter);
            return $this->db->count_all_results('blog');
        }
    }
    
    public function getBlog($limit, $offset){
        $this->db->limit($limit, $offset);
        return $this->db->get('blog')->result_array();
    }

    public function getSingleBlog($field, $value){
        $this->db->where($field, $value);
        return $this->db->get('blog')->row_array();
    }

    public function insertBlog($data){
        $this->db->insert('blog', $data);
        return $this->db->insert_id();
    }

    public function updateBlog($id, $data){
        $this->db->where('id', $id);
        $this->db->update('blog', $data);
        return $this->db->affected_rows();
    }

    public function deleteBlog($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('blog');
        return $this->db->affected_rows();
    }
}

/* End of file Blog_model.php */
