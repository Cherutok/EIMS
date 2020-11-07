<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employees extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('is_employee')) {
            $id = $this->employee_model->get_myproject_id();
            $data['projects'] = $this->employee_model->get_myprojects($id);

            $this->load->view('employee/includes/header');
            $this->load->view('employee/index', $data);
            $this->load->view('employee/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }
    }

    public function login($msg = null)
    {
        $data['msg'] = $msg;
        $this->load->view('includes/header');
        $this->load->view('access/employee/login', $data);
        $this->load->view('includes/footer');
    }

    public function validate_credentials()
    {
        $query = $this->employee_model->validate();
        if ($query) { // if the user's credentials validated...
            $username = $this->input->post('username');
            $query = $this->db->get_where('employees', array('username' => $username));
            $pass_status = $query->row()->new_pass;
            $data = array(
                'username' => $this->input->post('username'),
                'is_employee' => true,
                'logged_in' => true,
                'user_id' => $this->employee_model->get_userid($username),
                'pass_status' => $pass_status,
            );
            $this->session->set_userdata($data);
            redirect('Employees');
        } else { // incorrect username or password
            $msg = '<p class=error>Please check that your username or password is correct</p>';
            $this->login($msg);
        }
    }

    public function manage_projects()
    {
        if ($this->session->userdata('is_employee')) {
            $id = $this->employee_model->get_myproject_id();
            $data['projects'] = $this->employee_model->get_project_name($id);

            $this->load->view('employee/includes/header');
            $this->load->view('employee/manage/projects', $data);
            $this->load->view('employee/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }
    }

    public function manage_tasks()
    {
        if ($this->session->userdata('is_employee')) {
            $team_id = $this->employee_model->get_myteam_id();
            $data['tasks'] = $this->manager_model->get_team_tasks($team_id);

            $this->load->view('employee/includes/header');
            $this->load->view('employee/manage/tasks', $data);
            $this->load->view('employee/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }
    }

    public function complete_task($id)
    {
        if ($this->session->userdata('is_employee')) {
            if ($this->manager_model->complete_task($id)) {
                redirect('Employees/manage_tasks');
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }
    }

    public function myprofile($username)
    {
        if ($this->session->userdata('is_employee')) {
            $data['employees'] = $this->employee_model->get_user_details($username);

            $this->load->view('employee/includes/header');
            $this->load->view('employee/profile', $data);
            $this->load->view('employee/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }
    }

    public function myteam()
    {
        if ($this->session->userdata('is_employee')) {
            $id = $this->employee_model->get_myteam_id();
            $data['teams'] = $this->employee_model->get_myteam($id);

            $this->load->view('employee/includes/header');
            $this->load->view('employee/manage/teams', $data);
            $this->load->view('employee/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }
    }

    public function apply_for_leave()
    {
        if ($this->session->userdata('is_employee')) {
            $this->load->library('form_validation');
            $data['leaves'] = $this->manager_model->get_leaves();

            $this->form_validation->set_rules('reason', '', 'trim|required');

            if ($this->form_validation->run() === false) {
                $this->load->view('employee/includes/header');
                $this->load->view('employee/leave/apply', $data);
                $this->load->view('employee/includes/footer');
            } else {
                $this->employee_model->new_leave_application();
                redirect('employees/adjust_leave');
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }
    }

    public function adjust_leave()
    {
        if ($this->session->userdata('is_employee')) {            
            $uid = $this->session->userdata('user_id');
            $data['eleaves'] = $this->admin_model->get_this_employee_on_leave($uid);
            $this->load->library('form_validation'); 

            $this->form_validation->set_rules('reason', '', 'trim|required');

            if ($this->form_validation->run() === false) {
                $this->load->view('employee/includes/header');
                $this->load->view('employee/leave/adjust', $data);
                $this->load->view('employee/includes/footer');
            } else {
                $this->employee_model->adjust_leave_application();
                redirect('employees/adjust_leave');
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }
    }

    public function set_password()
    {
        if ($this->session->userdata('is_employee')) {
            $id = $this->session->userdata('user_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('password2', 'Confirmed Password', 'trim|required|matches[password]');

            if ($this->form_validation->run() === false) {
                $this->load->view('employee/includes/header');
                $this->load->view('employee/password/set');
                $this->load->view('employee/includes/footer');
            } else {
                $oldPass = $this->input->post('oldPass');
                if (md5($oldPass) == $this->employee_model->get_user_pass($id)) {
                    $this->employee_model->set_pass($id);
                    redirect('Employees/logout');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }

    }

    public function change_password()
    {
        if ($this->session->userdata('is_employee')) {
            $id = $this->session->userdata('user_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('password2', 'Confirmed Password', 'trim|required|matches[password]');

            if ($this->form_validation->run() === false) {
                $this->load->view('employee/includes/header');
                $this->load->view('employee/password/change');
                $this->load->view('employee/includes/footer');
            } else {
                $oldPass = $this->input->post('oldPass');
                if (md5($oldPass) == $this->employee_model->get_user_pass($id)) {
                    $this->employee_model->change_pass($id);
                    redirect('Employees/logout');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/employee/login');
            $this->load->view('includes/footer');
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->login();
    }
}
