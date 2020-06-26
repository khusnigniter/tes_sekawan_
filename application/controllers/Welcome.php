<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Welcome_model', 'welcome');
    }

    public function index() {
        $data = [
            'title' => 'Sekawan Tes',
        ];
        $this->load->view('welcome_message', $data);
    }

    function show() {
        $data = $this->welcome->employeeList();
        echo json_encode($data);
    }

    function save() {
        $data = $this->welcome->saveEmployee();
        echo json_encode($data);
    }

    function update() {
        $data = $this->welcome->updateEmployee();
        echo json_encode($data);
    }

    function delete() {
        $data = $this->welcome->deleteEmployee();
        echo json_encode($data);
    }
}
