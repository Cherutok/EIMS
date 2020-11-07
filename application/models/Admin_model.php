<?php
class Admin_model extends CI_Model
{
    public function validate()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $query = $this->db->get('administrators');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound == 1) {
            return true;
        }
    }

    public function get_user_details($username)
    {
        $username = $this->session->userdata('username');
        $query = $this->db->get_where('administrators', array('username' => $username));
        return $query->result_array();
    }

    public function get_userid($username)
    {
        $query = $this->db->get_where('administrators', array('username' => $username));
        $result = $query->row();
        $id = $result->id;
        return $id;
    }

    public function get_username($user_id)
    {
        $query = $this->db->get_where('administrators', array('id' => $user_id));
        $result = $query->row();
        $username = $result->username;
        return $username;
    }

    public function get_user_pass($id)
    {
        $query = $this->db->get_where('administrators', array('id' => $id));
        $result = $query->row();
        $pass = $result->password;
        return $pass;
    }

    public function change_pass($id)
    {

        $data = array(
            'password' => md5($this->input->post('password')),
            'confirmPassword' => md5($this->input->post('password2')),
        );

        $this->db->where('id', $id);
        return $this->db->update('administrators', $data);
    }

    public function new_admin()
    {
        $admin_data = array(
            'firstName' => $this->input->post('first_name'),
            'lastName' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email_address'),
            'password' => md5($this->input->post('password')),
            'confirmPassword' => md5($this->input->post('password2')),
            'phone' => $this->input->post('phone'),
        );
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $query = $this->db->get('administrators');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('administrators', $admin_data);
            return $insert;
        }
    }

    public function new_manager()
    {
        $manager_data = array(
            'firstName' => $this->input->post('first_name'),
            'lastName' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email_address'),
            'password' => md5($this->input->post('password')),
            'confirmPassword' => md5($this->input->post('password')),
            'phone' => $this->input->post('phone'),
            'department_id' => $this->input->post('department_id'),
            'emergency_phone' => $this->input->post('phone2'),
            'job_group' => $this->input->post('job_group'),
            'salary' => $this->input->post('salary'),
            'qualifications' => $this->input->post('qualifications'),
        );
        $username = $this->input->post('username');
        $this->db->where('username', $username);

        $query = $this->db->get('managers');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('managers', $manager_data);
            return $insert;
        }
    }

    public function update_manager($id)
    {

        $data = array(
            'firstName' => $this->input->post('first_name'),
            'lastName' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email_address'),
            'phone' => $this->input->post('phone'),
            'department_id' => $this->input->post('department_id'),
            'emergency_phone' => $this->input->post('phone2'),
            'job_group' => $this->input->post('job_group'),
            'salary' => $this->input->post('salary'),
            'qualifications' => $this->input->post('qualifications'),
        );

        $this->db->where('id', $id);
        return $this->db->update('managers', $data);
    }

    public function demote_manager($id)
    {
        $data = $this->admin_model->get_this_manager($id);
        $this_data = $data[0];
        $up_data = array(
            'firstName' => $this_data['firstName'],
            'lastName' => $this_data['lastName'],
            'username' => $this_data['username'],
            'email' => $this_data['email'],
            'phone' => $this_data['phone'],
            'department_id' => $this_data['department_id'],
            'designation_id' => $this_data['designation_id'],
            'password' => $this_data['password'],
            'confirmPassword' => $this_data['confirmPassword'],
            'new_pass' => $this_data['new_pass'],
            'emergency_phone' => $this_data['emergency_phone'],
            'job_group' => $this_data['job_group'],
            'salary' => $this_data['salary'],
            'qualifications' => $this_data['qualifications'],
        );
       
        $insert = $this->db->insert('employees', $up_data);
        if($insert){
            $this->db->where('id', $id);
            $this->db->delete('managers');
        }
        return $insert;
    }

    public function get_this_manager($id)
    {
        $query = $this->db->get_where('managers', array('id' => $id));
        return $query->result_array();
    }

    public function get_managers()
    {
        $this->db->order_by('managers.id', 'DESC');
        $query = $this->db->get('managers');
        return $query->result_array();
    }

    public function get_managers_on_leave()
    {
        $this->db->order_by('on_leave_m.id', 'DESC');
        $query = $this->db->get('on_leave_m');
        return $query->result_array();
    }

    public function get_manager_name($id)
    {
        $query = $this->db->get_where('managers', array('id' => $id));
        $fname = $query->row()->firstName;
        $s = ' ';
        $lname = $query->row()->lastName;
        return $fname . $s . $lname;
    }

    public function change_manager_leave_status($id)
    {
        $today = date("Y-m-d", time());
        $data = array(
            'status' => 1,
            'start' => $today,
        );

        $this->db->where('employee_id', $id);
        return $this->db->update('on_leave_m', $data);
    }

    public function delete_manager($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('managers');
        return true;
    }

    public function terminate_employee($id)
    {
        if ($this->input->post('employee_id')) {
            $id = $this->input->post('employee_id');
            $data = $this->admin_model->get_this_employee($id);
            $this_data = $data[0];
            $terminator_data = array(
                'staff_id' => $id,
                'reason' => $this->input->post('reason'),
                'firstName' => $this_data['firstName'],
                'lastName' => $this_data['lastName'],
                'phone' => $this_data['phone'],
                'emergency_phone' => $this_data['emergency_phone'],
                'email' => $this_data['email'],
            );  
        } else if ($this->input->post('manager_id')) {
            $id = $this->input->post('manager_id');
            $data = $this->admin_model->get_this_manager($id);
            $this_data = $data[0];
            $terminator_data = array(
                'staff_id' => $id,
                'reason' => $this->input->post('reason'),
                'firstName' => $this_data['firstName'],
                'lastName' => $this_data['lastName'],
                'phone' => $this_data['phone'],
                'emergency_phone' => $this_data['emergency_phone'],
                'email' => $this_data['email'],
            ); 
        }  
        $insert = $this->db->insert('terminations', $terminator_data);
        if($insert){
            if ($this->input->post('employee_id')) {
                $id1 = $this->input->post('employee_id');
                $this->db->where('id', $id1);
                $this->db->delete('employees');
            } else if ($this->input->post('manager_id')) {
                $id1 = $this->input->post('manager_id');
                $this->db->where('id', $id1);
                $this->db->delete('managers');
            }

        }
        return $insert;
    }

    public function new_employee()
    {
        $employee_data = array(
            'firstName' => $this->input->post('first_name'),
            'lastName' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email_address'),
            'password' => md5($this->input->post('password')),
            'confirmPassword' => md5($this->input->post('password')),
            'phone' => $this->input->post('phone'),
            'department_id' => $this->input->post('department_id'),
            'designation_id' => $this->input->post('designation_id'),
            'emergency_phone' => $this->input->post('phone2'),
            'job_group' => $this->input->post('job_group'),
            'salary' => $this->input->post('salary'),
            'qualifications' => $this->input->post('qualifications'),
        );

        $username = $this->input->post('username');
        $this->db->where('username', $username);
        $query = $this->db->get('employees');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('employees', $employee_data);
            return $insert;
        }
    }

    public function get_employees_on_leave()
    {
        $this->db->order_by('on_leave.id', 'DESC');
        $query = $this->db->get('on_leave');
        return $query->result_array();
    }

    public function get_this_employee_on_leave($id)
    {
        $this->db->order_by('on_leave.id', 'DESC');
        $query = $this->db->get_where('on_leave',array('employee_id'=>$id));
        return $query->result_array();
    }

    public function get_employees()
    {
        $this->db->order_by('employees.id', 'DESC');
        $query = $this->db->get('employees');
        return $query->result_array();
    }

    public function get_employee_name($id)
    {
        $query = $this->db->get_where('employees', array('id' => $id));
        $fname = $query->row()->firstName;
        $s = ' ';
        $lname = $query->row()->lastName;
        return $fname . $s . $lname;
    }

    public function get_employee_designation($id)
    {
        $query = $this->db->get_where('employees', array('id' => $id));
        $id = $query->row()->designation_id;
        $designation = $this->admin_model->get_designation_name($id)->name;
        return $designation;
    }

    public function change_employee_leave_status($id)
    {
        $today = date("Y-m-d", time());
        $data = array(
            'status' => 1,
            'start' => $today,
        );

        $this->db->where('employee_id', $id);
        return $this->db->update('on_leave', $data);
    }

    public function update_employee($id)
    {

        $data = array(
            'firstName' => $this->input->post('first_name'),
            'lastName' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email_address'),
            'phone' => $this->input->post('phone'),
            'department_id' => $this->input->post('department_id'),
            'designation_id' => $this->input->post('designation_id'),
            'emergency_phone' => $this->input->post('phone2'),
            'job_group' => $this->input->post('job_group'),
            'salary' => $this->input->post('salary'),
            'qualifications' => $this->input->post('qualifications'),
        );

        $this->db->where('id', $id);
        return $this->db->update('employees', $data);
    }

    public function get_this_employee($id)
    {
        $query = $this->db->get_where('employees', array('id' => $id));
        return $query->result_array();
    }

    public function promote_employee($id)
    {
        $data = $this->admin_model->get_this_employee($id);
        $this_data = $data[0];
        $up_data = array(
            'firstName' => $this_data['firstName'],
            'lastName' => $this_data['lastName'],
            'username' => $this_data['username'],
            'email' => $this_data['email'],
            'phone' => $this_data['phone'],
            'department_id' => $this_data['department_id'],
            'designation_id' => $this_data['designation_id'],
            'password' => $this_data['password'],
            'confirmPassword' => $this_data['confirmPassword'],
            'new_pass' => $this_data['new_pass'],
            'emergency_phone' => $this_data['emergency_phone'],
            'job_group' => $this_data['job_group'],
            'salary' => $this_data['salary'],
            'qualifications' => $this_data['qualifications'],
        );
       
        $insert = $this->db->insert('managers', $up_data);
        if($insert){
            $this->db->where('id', $id);
            $this->db->delete('employees');
        }
        return $insert;
    }

    public function delete_employee($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('employees');
        return true;
    }

    public function new_client()
    {
        $client_data = array(
            'firstName' => $this->input->post('first_name'),
            'lastName' => $this->input->post('last_name'),
            'organization' => $this->input->post('organization'),
            'email' => $this->input->post('email_address'),
            'phone' => $this->input->post('phone'),
            'pid' => $this->input->post('pid'),
        );

        $pid = $this->input->post('pid');
        $this->db->where('pid', $pid);
        $query = $this->db->get('clients');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('clients', $client_data);
            return $insert;
        }
    }

    public function get_clients()
    {
        $this->db->order_by('clients.id', 'DESC');
        $query = $this->db->get('clients');
        return $query->result_array();
    }

    public function get_some_clients($slug = false, $limit = false, $offset = false)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        if ($slug === false) {
            $this->db->order_by('clients.id', 'DESC');
            $query = $this->db->get('clients');
            return $query->result_array();
        }
    }

    public function get_client_name($id)
    {
        $query = $this->db->get_where('clients', array('id' => $id));
        return $query->row();
    }

    public function update_client($id)
    {

        $data = array(
            'firstName' => $this->input->post('first_name'),
            'lastName' => $this->input->post('last_name'),
            'organization' => $this->input->post('organization'),
            'email' => $this->input->post('email_address'),
            'phone' => $this->input->post('phone'),
            'pid' => $this->input->post('pid'),
        );

        $this->db->where('id', $id);
        return $this->db->update('clients', $data);
    }

    public function get_this_client($id)
    {
        $query = $this->db->get_where('clients', array('id' => $id));
        return $query->result_array();
    }

    public function delete_client($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('clients');
        return true;
    }

    public function new_project()
    {
        $project_data = array(
            'name' => $this->input->post('name'),
            'client_id' => $this->input->post('client_id'),
            'end_date' => $this->input->post('end_date'),
            'rate' => $this->input->post('rate'),
            'rate_interval' => $this->input->post('rate_interval'),
            'priority' => $this->input->post('priority'),
            'manager_id' => $this->input->post('manager_id'),
            'description' => $this->input->post('description'),
            'pid' => $this->input->post('pid'),
        );

        $pid = $this->input->post('pid');
        $this->db->where('pid', $pid);
        $query = $this->db->get('projects');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('projects', $project_data);
            return $insert;
        }
    }

    public function get_some_projects($slug = false, $limit = false, $offset = false)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        if ($slug === false) {
            $this->db->order_by('projects.id', 'DESC');
            $query = $this->db->get('projects');
            return $query->result_array();
        }
    }

    public function get_projects()
    {
        $this->db->order_by('projects.id', 'DESC');
        $query = $this->db->get('projects');
        return $query->result_array();
    }

    public function get_complete_projects()
    {
        $this->db->order_by('complete.id', 'DESC');
        $query = $this->db->get('complete');
        return $query->result_array();
    }

    public function update_project($id)
    {

        $data = array(
            'name' => $this->input->post('name'),
            'client_id' => $this->input->post('client_id'),
            'end_date' => $this->input->post('end_date'),
            'rate' => $this->input->post('rate'),
            'rate_interval' => $this->input->post('rate_interval'),
            'priority' => $this->input->post('priority'),
            'manager_id' => $this->input->post('manager_id'),
            'description' => $this->input->post('description'),
            'pid' => $this->input->post('pid'),
        );

        $this->db->where('id', $id);
        return $this->db->update('projects', $data);
    }

    public function get_this_project($id)
    {
        $query = $this->db->get_where('projects', array('id' => $id));
        return $query->result_array();
    }

    public function delete_project($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('projects');
        return true;
    }

    public function get_departments()
    {
        $this->db->order_by('name');
        $query = $this->db->get('departments');
        return $query->result_array();
    }

    public function get_department_name($id)
    {
        $query = $this->db->get_where('departments', array('id' => $id));
        return $query->row();
    }

    public function get_designations()
    {
        $this->db->order_by('name');
        $query = $this->db->get('designations');
        return $query->result_array();
    }

    public function get_designation_name($id)
    {
        $query = $this->db->get_where('designations', array('id' => $id));
        return $query->row();
    }

    public function new_leave_type()
    {
        $leave_data = array(
            'name' => $this->input->post('name'),
            'duration' => $this->input->post('duration'),
        );
        $name = $this->input->post('name');
        $this->db->where('name', $name);

        $query = $this->db->get('leave_details');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('leave_details', $leave_data);
            return $insert;
        }
    }

    public function get_leave_name($id)
    {
        $query = $this->db->get_where('leave_details', array('id' => $id));
        $name = $query->row()->name;
        return $name;
    }

    public function get_leave_days($id)
    {
        $query = $this->db->get_where('leave_details', array('id' => $id));
        $days = $query->row()->duration;
        return $days;
    }

    public function get_myeleave_days($id)
    {
        $query = $this->db->get_where('on_leave', array('employee_id' => $id));
        $days = $query->row()->days;
        return $days;
    }
}
