<?php

defined('BASEPATH') or exit('No direct script acces allowed');

class M_provinsi extends CI_Model
{
    public function all_data()
    {
        $this->db->select('*');
        $this->db->from('provinsi');
        return $this->db->get()->result();
    }
}
