<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function employeeList() {
        $hasil = $this->db->get('employee');
        return $hasil->result();
    }

    function saveEmployee() {
        $data = [
            'employee_name'   => $this->input->post('name'),
            'employee_salary' => $this->input->post('salary'),
            'employee_age'    => $this->input->post('age'),
            'profile_image'   => 'default.jpg',
        ];
        $result = $this->db->insert('employee', $data);
        return $result;
    }

    function updateEmployee() {
        $id     = $this->input->post('id');
        $name   = $this->input->post('name');
        $salary = $this->input->post('salary');
        $age    = $this->input->post('age');

        $data = [
            'employee_name'   => $name,
            'employee_salary' => $salary,
            'employee_age'    => $age,
        ];

        $this->db->where('id', $id);
        $result = $this->db->update('employee', $data);
        return $result;
    }

    function deleteEmployee() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $result = $this->db->delete('employee');
        return $result;
    }
}