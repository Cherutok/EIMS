<?php
class Manager_model extends CI_Model
{
    public function validate()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $query = $this->db->get('managers');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound == 1) {
            return true;
        } else if ($totalfound > 1) {
            $query1 = $this->db->get_where('managers', array('username' => $username));
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
        $query = $this->db->get_where('managers', array('username' => $username));
        return $query->result_array();
    }

    public function get_this_user_details($username)
    {
        $query = $this->db->get_where('managers', array('username' => $username));
        return $query->result_array();
    }

    public function get_userid($username)
    {
        $query = $this->db->get_where('managers', array('username' => $username));
        $result = $query->row();
        $id = $result->id;
        return $id;
    }

    public function get_username($user_id)
    {
        $query = $this->db->get_where('managers', array('id' => $user_id));
        $result = $query->row();
        $username = $result->username;
        return $username;
    }

    public function new_team()
    {
        $username = $this->session->userdata('username');
        $id = $this->manager_model->get_userid($username);
        $team_data = array(
            'project_id' => $this->input->post('project_id'),
            'manager_id' => $id,
            'name' => $this->input->post('name'),
        );

        $pid = $this->input->post('project_id');
        $this->db->where('project_id', $pid);
        $query = $this->db->get('teams');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('teams', $team_data);
            return $insert;
        }
    }

    public function get_teams()
    {
        $this->db->order_by('teams.id', 'DESC');
        $query = $this->db->get('teams');
        return $query->result_array();
    }

    public function get_team_name($id)
    {
        $query = $this->db->get_where('teams', array('id' => $id));
        return $query->row()->name;
    }

    public function get_team_project($id)
    {
        $query = $this->db->get_where('teams', array('id' => $id));
        $result = $query->row();
        $id = $result->project_id;
        return $id;
    }

    public function get_teams_where($id)
    {
        $this->db->order_by('teams.id', 'DESC');
        $query = $this->db->get('teams', array('id' => $id));
        return $query->result_array();
    }

    public function addToTeam()
    {
        $id = $this->input->post('team_id');
        $project_id = $this->manager_model->get_team_project($id);
        $team_data = array(
            'project_id' => $project_id,
            'team_id' => $this->input->post('team_id'),
            'employee_id' => $this->input->post('employee_id'),
            'manager_id' => $this->session->userdata('user_id'),
        );

        $insert = $this->db->insert('running', $team_data);
        return $insert;

    }

    public function delete_team($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('teams');
        return true;
    }

    public function new_task()
    {
        $task_data = array(
            'team_id' => $this->input->post('team_id'),
            'project_id' => $this->input->post('project_id'),
            'body' => $this->input->post('body'),
        );

        $this->db->where('body', $this->input->post('body'));
        $query = $this->db->get('tasks');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('tasks', $task_data);
            return $insert;
        }
    }

    public function get_tasks()
    {
        $this->db->order_by('tasks.id', 'DESC');
        $query = $this->db->get('tasks');
        return $query->result_array();
    }

    public function incomplete_task($id)
    {
        $data = array(
            'status' => 0,
        );

        $this->db->where('id', $id);
        return $this->db->update('tasks', $data);
    }

    public function complete_task($id)
    {
        $data = array(
            'status' => 1,
        );

        $this->db->where('id', $id);
        return $this->db->update('tasks', $data);
    }

    public function get_project_name($id)
    {
        $query = $this->db->get_where('projects', array('id' => $id));
        return $query->row()->name;
    }

    public function get_project_tasks($id)
    {
        $this->db->order_by('tasks.id', 'DESC');
        $query = $this->db->get_where('tasks', array('project_id' => $id));
        return $query->num_rows();
    }

    public function get_team_tasks($id)
    {
        $this->db->order_by('tasks.id', 'DESC');
        $query = $this->db->get_where('tasks', array('team_id' => $id));
        return $query->result_array();
    }

    public function get_project_open_tasks($id)
    {
        $this->db->order_by('tasks.id', 'DESC');
        $query = $this->db->get('tasks', array('status' => 0));
        return $query->num_rows();
    }

    public function get_myprojects()
    {
        $username = $this->session->userdata('username');
        $id = $this->manager_model->get_userid($username);
        $this->db->order_by('projects.id', 'DESC');
        $query = $this->db->get_where('projects', array('manager_id' => $id));
        return $query->result_array();
    }

    public function get_leaves()
    {
        $this->db->order_by('leave_details.id', 'DESC');
        $query = $this->db->get('leave_details');
        return $query->result_array();
    }

    public function new_leave_application()
    {
        $leave_data = array(
            'leave_id' => $this->input->post('leave_id'),
            'employee_id' => $this->input->post('employee_id'),
            'reason' => $this->input->post('reason'),
        );

        $reason = $this->input->post('reason');
        $this->db->where('reason', $reason);
        $query = $this->db->get('on_leave_m');
        $totalfound = $query->num_rows();
        echo $totalfound;
        if ($totalfound === 0) {
            $insert = $this->db->insert('on_leave_m', $leave_data);
            return $insert;
        }
    }

    public function get_user_pass($id)
    {
        $query = $this->db->get_where('managers', array('id' => $id));
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
        return $this->db->update('managers', $data);
    }

    public function change_pass($id)
    {

        $data = array(
            'password' => md5($this->input->post('password')),
            'confirmPassword' => md5($this->input->post('password2')),
        );

        $this->db->where('id', $id);
        return $this->db->update('managers', $data);
    }

    public function mark_complete($id)
    {
        $data = $this->admin_model->get_this_project($id);
        $this_data = $data[0];
        $up_data = array(
            'name' => $this_data['name'],
            'client_id' => $this_data['client_id'],
            'start_date' => $this_data['start_date'],
            'end_date' => $this_data['end_date'],
            'rate' => $this_data['rate'],
            'rate_interval' => $this_data['rate_interval'],
            'priority' => $this_data['priority'],
            'manager_id' => $this_data['manager_id'],
            'description' => $this_data['description'],
            'pid' => $this_data['pid'], 
        );

        $insert = $this->db->insert('complete', $up_data);
        if ($insert) {
            $up_data = array(
                'status' => 1,
            );
            $this->db->where('id', $id);            
            $this->db->update('projects', $up_data);
        }
        return $insert;
    }
}
