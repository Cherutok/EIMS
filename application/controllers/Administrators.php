<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrators extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($msg = null)
    {
        if ($this->session->userdata('is_administrator')) {

            $queryproj = $this->db->get('projects');
            $totalprojects = $queryproj->num_rows();

            $queryleave = $this->db->get('on_leave');
            $totalleaves1 = $queryleave->num_rows();

            $queryleave_m = $this->db->get('on_leave_m');
            $totalleaves2 = $queryleave_m->num_rows();

            $o_queryleave_m = $this->db->get_where('on_leave_m', array('status' => 0));
            $o_queryleave = $this->db->get_where('on_leave', array('status' => 0));
            $total_o_leaves = $o_queryleave_m->num_rows() + $o_queryleave->num_rows();

            $queryrun = $this->db->get('running');
            $totalrunning = $queryrun->num_rows();
            $eng_employees = $queryrun->result_array();

            $querytask = $this->db->get('tasks');
            $totaltasks = $querytask->num_rows();

            $queryclient = $this->db->get('clients');
            $totalclients = $queryclient->num_rows();

            $queryemp = $this->db->get('employees');
            $totalemployees = $queryemp->num_rows();

            $queryman = $this->db->get('managers');
            $totalmanagers = $queryman->num_rows();

            $data['clients'] = $this->admin_model->get_some_clients(false, 3, 0);
            $data['projects'] = $this->admin_model->get_some_projects(false, 3, 0);
            $data['cprojects'] = $this->admin_model->get_complete_projects();
            $data['mleaves'] = $this->admin_model->get_managers_on_leave();
            $data['eleaves'] = $this->admin_model->get_employees_on_leave();

            $data['projectcount'] = $totalprojects;
            $data['taskcount'] = $totaltasks;
            $data['clientcount'] = $totalclients;
            $data['employeecount'] = $totalemployees + $totalmanagers;
            $data['totleavecount'] = $totalleaves1 + $totalleaves2;
            $data['tot_o_leavecount'] = $total_o_leaves;
            $data['leavecount1'] = $totalleaves1;
            $data['leavecount2'] = $totalleaves2;
            $data['totalrunning'] = $totalrunning;
            $data['eng_employees'] = $eng_employees;

            $this->load->view('admin/includes/header');
            $this->load->view('admin/index', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function login($msg = null)
    {
        $data['msg'] = $msg;
        $this->load->view('includes/header');
        $this->load->view('access/admin/login');
        $this->load->view('includes/footer');
    }

    public function signup($msg = null)
    {
        $data['msg'] = $msg;
        $this->load->view('includes/header');
        $this->load->view('access/admin/signup', $data);
        $this->load->view('includes/footer');
    }

    public function validate_credentials()
    {
        $query = $this->admin_model->validate();
        if ($query) { // if the user's credentials validated...
            $username = $this->input->post('username');
            $data = array(
                'username' => $this->input->post('username'),
                'is_administrator' => true,
                'logged_in' => true,
                'user_id' => $this->admin_model->get_userid($username),
            );
            $this->session->set_userdata($data);
            redirect('Administrators');
        } else { // incorrect username or password
            $msg = '<p class=error>Please check that your username or password is correct</p>';
            $this->login($msg);
        }
    }

    public function create_member($msg = null)
    {
        if ($this->session->userdata('is_administrator')) {
            $this->load->library('form_validation');
            $data['msg'] = $msg;
            $this->form_validation->set_rules('username', '', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('password', '', 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('password2', '', 'trim|required|matches[password]');

            if ($this->form_validation->run() == false) {
                redirect('Administrators/signup');
            } else {
                $newAdmin = $query = $this->admin_model->new_admin();
                if ($newAdmin) {
                    redirect('Administrators/login');
                } else {
                    $msg = '<p class=error>This user already exists</p>';
                    $this->signup($msg);
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function create_manager($msg = null)
    {

        if ($this->session->userdata('is_administrator')) {
            $data['departments'] = $this->admin_model->get_departments();
            $data['designations'] = $this->admin_model->get_designations();
            $data['msg'] = $msg;
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', '', 'trim|min_length[4]');

            if ($this->form_validation->run() === false) {
                $this->load->view('admin/includes/header');
                $this->load->view('admin/add/manager', $data);
                $this->load->view('admin/includes/footer');
            } else {
                $newManager = $this->admin_model->new_manager();

                if (!$newManager) {
                    $msg = '<p class=error>Manager already exists</p>';
                    $this->load->view('admin/includes/header');
                    $this->load->view('admin/add/manager', $data);
                    $this->load->view('admin/includes/footer');
                } else {
                    redirect('Administrators/manage_employees');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function update_manager()
    {
        if ($this->session->userdata('is_administrator')) {
            $id = $this->input->post('id');
            $this->admin_model->update_manager($id);

            redirect('Administrators/manage_employees');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function edit_manager($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $data['departments'] = $this->admin_model->get_departments();
            $data['managers'] = $this->admin_model->get_this_manager($id);

            $this->load->view('admin/includes/header');
            $this->load->view('admin/update/manager', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function demote_manager($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $this->admin_model->demote_manager($id);

            redirect('Administrators/manage_employees');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function accept_manager_leave($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $this->admin_model->change_manager_leave_status($id);
            redirect('Administrators/manage_leave_requests');

        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }

    }

    public function delete_manager($id)
    {
        if ($this->session->userdata('is_administrator')) {

            $this->admin_model->delete_manager($id);

            redirect('Administrators/manage_employees');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function terminator()
    {
        if ($this->session->userdata('is_administrator')) {
            $this->load->library('form_validation');
            $data['managers'] = $this->admin_model->get_managers();
            $data['employees'] = $this->admin_model->get_employees();
            $this->form_validation->set_rules('reason', '', 'trim|required');

            if ($this->form_validation->run() === false) {
                $this->load->view('admin/includes/header');
                $this->load->view('admin/terminator',$data);
                $this->load->view('admin/includes/footer');
            } else {
                if ($this->input->post('employee_id')) {
                    $id = $this->input->post('employee_id');
                } else if ($this->input->post('manager_id')) {
                    $id = $this->input->post('manager_id');
                }
                $this->admin_model->terminate_employee($id);
        
                redirect('Administrators/manage_employees');
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }

    }

    public function manage_employees()
    {
        if ($this->session->userdata('is_administrator')) {

            $data['managers'] = $this->admin_model->get_managers();
            $data['employees'] = $this->admin_model->get_employees();

            $this->load->view('admin/includes/header');
            $this->load->view('admin/manage/employees', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function view_employee($username)
    {
        if ($this->session->userdata('is_administrator')) {

            $data['employees'] = $this->employee_model->get_this_user_details($username);

            $this->load->view('admin/includes/header');
            $this->load->view('admin/manage/individual_employee', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function view_manager($username)
    {
        if ($this->session->userdata('is_administrator')) {

            $data['managers'] = $this->manager_model->get_this_user_details($username);

            $this->load->view('admin/includes/header');
            $this->load->view('admin/manage/individual_manager', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function create_employee($msg = null)
    {

        if ($this->session->userdata('is_administrator')) {
            $data['departments'] = $this->admin_model->get_departments();
            $data['designations'] = $this->admin_model->get_designations();
            $data['msg'] = $msg;
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', '', 'trim|min_length[4]');

            if ($this->form_validation->run() === false) {
                $this->load->view('admin/includes/header');
                $this->load->view('admin/add/employee', $data);
                $this->load->view('admin/includes/footer');
            } else {
                $newEmployee = $this->admin_model->new_employee();

                if (!$newEmployee) {
                    $msg = '<p class=error>Employee already exists</p>';
                    $this->load->view('admin/includes/header');
                    $this->load->view('admin/add/employee', $data);
                    $this->load->view('admin/includes/footer');
                } else {
                    redirect('Administrators/manage_employees');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function update_employee()
    {
        if ($this->session->userdata('is_administrator')) {
            $id = $this->input->post('id');
            if ($this->admin_model->update_employee($id)) {
                redirect('Administrators/manage_employees');

            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function accept_employee_leave($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $this->admin_model->change_employee_leave_status($id);
            redirect('Administrators/manage_leave_requests');

        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }

    }

    public function edit_employee($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $data['designations'] = $this->admin_model->get_designations();
            $data['departments'] = $this->admin_model->get_departments();
            $data['employees'] = $this->admin_model->get_this_employee($id);

            $this->load->view('admin/includes/header');
            $this->load->view('admin/update/employee', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function promote_employee($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $this->admin_model->promote_employee($id);

            redirect('Administrators/manage_employees');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function delete_employee($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $this->admin_model->delete_employee($id);

            redirect('Administrators/manage_employees');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function create_client($msg = null)
    {
        if ($this->session->userdata('is_administrator')) {
            $data['msg'] = $msg;
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email_address', '', 'trim|required');

            if ($this->form_validation->run() === false) {
                $this->load->view('admin/includes/header');
                $this->load->view('admin/add/client');
                $this->load->view('admin/includes/footer');
            } else {
                $newClient = $this->admin_model->new_client();

                if (!$newClient) {
                    $msg = '<p class=error>Project already exists</p>';
                    $this->load->view('admin/includes/header');
                    $this->load->view('admin/add/client', $data);
                    $this->load->view('admin/includes/footer');
                } else {
                    redirect('Administrators/manage_clients');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function manage_clients()
    {
        if ($this->session->userdata('is_administrator')) {

            $data['clients'] = $this->admin_model->get_clients();

            $this->load->view('admin/includes/header');
            $this->load->view('admin/manage/clients', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function update_client()
    {
        if ($this->session->userdata('is_administrator')) {
            $id = $this->input->post('id');
            $this->admin_model->update_client($id);

            redirect('Administrators/manage_clients');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function edit_client($id)
    {

        if ($this->session->userdata('is_administrator')) {
            $data['clients'] = $this->admin_model->get_this_client($id);

            $this->load->view('admin/includes/header');
            $this->load->view('admin/update/client', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function delete_client($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $this->admin_model->delete_client($id);

            redirect('Administrators/manage_clients');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function create_project($msg = null)
    {
        if ($this->session->userdata('is_administrator')) {

            $this->load->library('form_validation');
            $data['clients'] = $this->admin_model->get_clients();
            $data['managers'] = $this->admin_model->get_managers();
            $data['msg'] = $msg;
            $this->form_validation->set_rules('pid', '', 'trim|required');

            if ($this->form_validation->run() === false) {
                $this->load->view('admin/includes/header');
                $this->load->view('admin/add/project', $data);
                $this->load->view('admin/includes/footer');
            } else {
                $newProject = $this->admin_model->new_project();
                if (!$newProject) {
                    $msg = '<p class=error>Project already exists</p>';
                    $this->load->view('admin/includes/header');
                    $this->load->view('admin/add/project', $data);
                    $this->load->view('admin/includes/footer');
                } else {
                    redirect('Administrators/manage_projects');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function manage_projects()
    {
        if ($this->session->userdata('is_administrator')) {

            $data['projects'] = $this->admin_model->get_projects();

            $this->load->view('admin/includes/header');
            $this->load->view('admin/manage/projects', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function update_project()
    {
        if ($this->session->userdata('is_administrator')) {
            $id = $this->input->post('id');
            if ($this->admin_model->update_project($id)) {
                redirect('Administrators/manage_projects');
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function edit_project($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $data['projects'] = $this->admin_model->get_this_project($id);

            $this->load->view('admin/includes/header');
            $this->load->view('admin/update/project', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function delete_project($id)
    {
        if ($this->session->userdata('is_administrator')) {
            $this->admin_model->delete_project($id);

            redirect('Administrators/manage/project');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function add_leave_type()
    {
        if ($this->session->userdata('is_administrator')) {
            $this->form_validation->set_rules('name', '', 'trim|required');

            if ($this->form_validation->run() === false) {
                $this->load->view('admin/includes/header');
                $this->load->view('admin/leave/add');
                $this->load->view('admin/includes/footer');
            } else {
                $this->admin_model->new_leave_type();
                redirect('Administrators/add_leave_type');
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }

    }

    public function manage_leave_requests()
    {
        if ($this->session->userdata('is_administrator')) {

            $data['managers'] = $this->admin_model->get_managers_on_leave();
            $data['employees'] = $this->admin_model->get_employees_on_leave();

            $this->load->view('admin/includes/header');
            $this->load->view('admin/manage/leaves', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function myprofile($username)
    {
        if ($this->session->userdata('is_administrator')) {
            $data['administrators'] = $this->admin_model->get_user_details($username);

            $this->load->view('admin/includes/header');
            $this->load->view('admin/profile', $data);
            $this->load->view('admin/includes/footer');
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }
    }

    public function change_password()
    {
        if ($this->session->userdata('is_administrator')) {
            $id = $this->session->userdata('user_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('password2', 'Confirmed Password', 'trim|required|matches[password]');

            if ($this->form_validation->run() === false) {
                $this->load->view('admin/includes/header');
                $this->load->view('admin/manage/password');
                $this->load->view('admin/includes/footer');
            } else {
                $oldPass = $this->input->post('oldPass');
                if (md5($oldPass) == $this->admin_model->get_user_pass($id)) {
                    $this->admin_model->change_pass($id);
                    redirect('Administrators/logout');
                }
            }
        } else {
            $this->load->view('includes/header');
            $this->load->view('access/admin/login');
            $this->load->view('includes/footer');
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->login();
    }
}
