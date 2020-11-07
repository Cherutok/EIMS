<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Managers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('is_manager')) {
            $id = $this->session->userdata('user_id');
            $query = $this->db->get_where('projects', array('manager_id' => $id));
            $mytotalprojects = $query->result_array();
            $totalprojects = $query->num_rows();

            $data['projects'] = $mytotalprojects;
            $data['myprojects'] = $this->manager_model->get_myprojects();
            $data['projectcount'] = $totalprojects;

            $this->load->view('manager/includes/header');
            $this->load->view('manager/index', $data);
            $this->load->view('manager/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function login($msg = null)
    {

        $data['msg'] = $msg;
        $this->load->view('includes/header');
        $this->load->view('access/manager/login', $data);
        $this->load->view('includes/footer');
    }

    public function validate_credentials()
    {
        $query = $this->manager_model->validate();
        if ($query) {
            $username = $this->input->post('username');
            $query = $this->db->get_where('managers', array('username' => $username));
            $pass_status = 0;
            $pass_status == $query->row()->new_pass;
            $data = array(
                'username' => $this->input->post('username'),
                'is_manager' => true,
                'logged_in' => true,
                'user_id' => $this->manager_model->get_userid($username),
                'pass_status' => $pass_status,
            );
            $this->session->set_userdata($data);
            redirect('Managers');
        } else { // incorrect username or password
            $msg = '<p class=error>Please check that your username or password is correct</p>';
            $this->login($msg);
        }
    }

    public function set_password()
    {
        if ($this->session->userdata('is_manager')) {
            $id = $this->session->userdata('user_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('password2', 'Confirmed Password', 'trim|required|matches[password]');

            if ($this->form_validation->run() === false) {
                $this->load->view('manager/includes/header');
                $this->load->view('manager/password/set');
                $this->load->view('manager/includes/footer');
            } else {
                $oldPass = $this->input->post('oldPass');
                if (md5($oldPass) == $this->manager_model->get_user_pass($id)) {
                    $this->manager_model->set_pass($id);
                    redirect('Managers/logout');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }

    }

    public function change_password()
    {
        if ($this->session->userdata('is_manager')) {
            $id = $this->session->userdata('user_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('password2', 'Confirmed Password', 'trim|required|matches[password]');

            if ($this->form_validation->run() === false) {
                $this->load->view('manager/includes/header');
                $this->load->view('manager/password/change');
                $this->load->view('manager/includes/footer');
            } else {
                $oldPass = $this->input->post('oldPass');
                if (md5($oldPass) == $this->manager_model->get_user_pass($id)) {
                    $this->manager_model->change_pass($id);
                    redirect('Managers/logout');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }

    }

    public function add_task($msg = null)
    {
        if ($this->session->userdata('is_manager')) {
            $data['msg'] = $msg;
            $msg = '';
            $data['teamId'] = $this->uri->segment(3);
            $thisId = $this->uri->segment(3);
            $data['projectId'] = $this->manager_model->get_team_project($thisId);

            $this->load->view('manager/includes/header');
            $this->load->view('manager/add/task', $data);
            $this->load->view('manager/includes/footer');

        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function create_task($msg = null)
    {
        if ($this->session->userdata('is_manager')) {

            $this->load->library('form_validation');
            $data['msg'] = $msg;
            $this->form_validation->set_rules('body', '', 'trim|required');

            if ($this->form_validation->run() === false) {

                $this->load->view('manager/includes/header');
                $this->load->view('manager/add/task');
                $this->load->view('manager/includes/footer');
            } else {
                $newTask = $this->manager_model->new_task();
                if (!$newTask) {
                    $msg = '<p class=error>Task already exists</p>';
                    $this->load->view('manager/includes/header');
                    $this->load->view('manager/add/task', $data);
                    $this->load->view('manager/includes/footer');
                } else {
                    redirect('Managers/manage_teams');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function manage_tasks()
    {
        if ($this->session->userdata('is_manager')) {

            $data['tasks'] = $this->manager_model->get_tasks();

            $this->load->view('manager/includes/header');
            $this->load->view('manager/manage/tasks', $data);
            $this->load->view('manager/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function incomplete_task($id)
    {
        if ($this->session->userdata('is_manager')) {
            if ($this->manager_model->incomplete_task($id)) {
                redirect('Managers/manage_tasks');
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function create_team($msg = null)
    {
        if ($this->session->userdata('is_manager')) {
            $id = $this->session->userdata('user_id');
            $query = $this->db->get_where('projects', array('manager_id' => $id));
            $mytotalprojects = $query->result_array();
            $data['projects'] = $mytotalprojects;
            $this->load->library('form_validation');
            $data['msg'] = $msg;
            $this->form_validation->set_rules('name', '', 'trim|required');

            if ($this->form_validation->run() === false) {
                $this->load->view('manager/includes/header');
                $this->load->view('manager/add/team', $data);
                $this->load->view('manager/includes/footer');
            } else {
                $newTeam = $this->manager_model->new_team();
                if (!$newTeam) {
                    $msg = '<p class=error>Team already exists</p>';
                    $this->load->view('manager/includes/header');
                    $this->load->view('manager/add/team', $data);
                    $this->load->view('manager/includes/footer');
                } else {
                    redirect('Managers/manage_teams');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function manage_teams()
    {
        if ($this->session->userdata('is_manager')) {

            $data['managers'] = $this->admin_model->get_managers();
            $data['teams'] = $this->manager_model->get_teams();

            $this->load->view('manager/includes/header');
            $this->load->view('manager/manage/teams', $data);
            $this->load->view('manager/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function addMember()
    {
        if ($this->session->userdata('is_manager')) {
            $msg = '';
            $this->load->library('form_validation');
            $data['msg'] = $msg;
            $data['employees'] = $this->admin_model->get_employees();
            $this->form_validation->set_rules('employee_id', '', 'trim|required');

            if ($this->form_validation->run() === false) {

                $this->load->view('manager/includes/header');
                $this->load->view('manager/add/running', $data);
                $this->load->view('manager/includes/footer');
            } else {
                $newRunning = $this->manager_model->addToTeam();
                if (!$newRunning) {
                    redirect('Managers/manage_teams');
                } else {
                    redirect('Managers/manage_teams');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function delete_team($id)
    {
        if ($this->session->userdata('is_manager')) {
            $this->manager_model->delete_team($id);

            redirect('managers/manage_teams');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function myprofile($username)
    {
        if ($this->session->userdata('is_manager')) {
            $data['managers'] = $this->manager_model->get_user_details($username);

            $this->load->view('manager/includes/header');
            $this->load->view('manager/profile', $data);
            $this->load->view('manager/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function apply_for_leave()
    {
        if ($this->session->userdata('is_manager')) {
            $this->load->library('form_validation');
            $data['leaves'] = $this->manager_model->get_leaves();

            $this->form_validation->set_rules('reason', '', 'trim|required');

            if ($this->form_validation->run() === false) {
                $this->load->view('manager/includes/header');
                $this->load->view('manager/leave/apply', $data);
                $this->load->view('manager/includes/footer');
            } else {
                $this->manager_model->new_leave_application();
                redirect('managers');
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function mark_as_complete($id)
    {
        if ($this->session->userdata('is_manager')) {
            $this->manager_model->mark_complete($id);

            redirect('Managers');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/manager/login');
            $this->load->view('includes/footer');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->login();
    }
}
