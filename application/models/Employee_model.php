<?php
class Employee_model extends CI_Model
{
    public function validate()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $query = $this->db->get('employees');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound == 1) {
            return true;
        } else if ($totalfound > 1) {
            $query1 = $this->db->get_where('employees', array('username' => $username));
            $totalfound1 = $query1->num_rows();
            if ($totalfound1 == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function get_user_details($username)
    {
        $username = $this->session->userdata('username');
        $query = $this->db->get_where('employees', array('username' => $username));
        return $query->result_array();
    }

    public function get_this_user_details($username)
    {
        $query = $this->db->get_where('employees', array('username' => $username));
        return $query->result_array();
    }

    public function get_userid($username)
    {
        $query = $this->db->get_where('employees', array('username' => $username));
        $result = $query->row();
        $id = $result->id;
        return $id;
    }

    public function get_user_pass($id)
    {
        $query = $this->db->get_where('employees', array('id' => $id));
        $result = $query->row();
        $pass = $result->password;
        return $pass;
    }

    public function set_pass($id)
    {

        $data = array(
            'password' => md5($this->input->post('password')),
            'confirmPassword' => md5($this->input->post('password2')),
            'new_pass' => 1,
        );

        $this->db->where('id', $id);
        return $this->db->update('employees', $data);
    }

    public function change_pass($id)
    {

        $data = array(
            'password' => md5($this->input->post('password')),
            'confirmPassword' => md5($this->input->post('password2')),
        );

        $this->db->where('id', $id);
        return $this->db->update('employees', $data);
    }

    public function new_leave_application()
    {
        $leave_data = array(
            'leave_id' => $this->input->post('leave_id'),
            'employee_id' => $this->input->post('employee_id'),
            'reason' => $this->input->post('reason'),
        );

        $eid = $this->session->userdata('user_id');
        $this->db->where('employee_id', $eid);
        $query = $this->db->get('on_leave');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('on_leave', $leave_data);
            return $insert;
        }
    }

    public function adjust_leave_application()
    {
        $id = $this->input->post('leave_id');
        $leave_data = array(            
            'days' => $this->input->post('days'),
            'reason' => $this->input->post('reason'),
        );
        $this->db->where('id', $id);
        return $this->db->update('on_leave', $leave_data);
        
    }

    public function get_myproject_id()
    {
        $username = $this->session->userdata('username');
        $id = $this->employee_model->get_userid($username);
        $this->db->order_by('running.id', 'DESC');
        $query = $this->db->get_where('running', array('employee_id' => $id));
        if ($query->num_rows()>0) {
            return $query->row()->project_id;
        }
        
    }

    public function get_username($user_id)
    {
        $query = $this->db->get_where('employees', array('id' => $user_id));
        $result = $query->row();
        $username = $result->username;
        return $username;
    }

    public function get_project_name($id)
    {
        $query = $this->db->get_where('projects', array('id' => $id));
        if ($query->num_rows()>0) {
        return $query->row()->name;
        }
    }
    public function get_myprojects($id)
    {
        $query = $this->db->get_where('projects', array('id' => $id));
        if ($query->num_rows()>0) {
        return $query->result_array();
        }
    }

    public function get_team_name($id)
    {
        $query = $this->db->get_where('teams', array('id' => $id));
        if ($query->num_rows()>0) {
        return $query->row()->name;
        }
    }

    
    public function get_myteam($id)
    {
        $query = $this->db->get_where('teams', array('id' => $id));
        if ($query->num_rows()>0) {
        return $query->result_array();
        }
    }

    public function get_myteam_id()
    {
        $username = $this->session->userdata('username');
        $id = $this->employee_model->get_userid($username);
        $this->db->order_by('running.id', 'DESC');
        $query = $this->db->get_where('running', array('employee_id' => $id));
        if ($query->num_rows()>0) {
            return $query->row()->team_id;
        }
    }
}
