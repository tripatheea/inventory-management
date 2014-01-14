<?php
	class sharedDB_model extends CI_Model {
		
		public function __construct()
		{
			$this->load->database();
			$this->load->helper('date');
			$this->load->library('user_agent');
		}
		
		public function get($tableName, $what = array( '*' ), $condition = NULL, $orderBy = NULL, $limit = NULL)
		{
			$this->db->select(implode(',', $what));
			if($condition) { $this->db->where($condition); }	// Can use something like 'id !=' => 2
			if($orderBy){ $this->db->order_by($orderBy); }
			if($limit){ $this->db->limit($limit); }	// Limit sth like '1, 2'
			$query = $this->db->get($tableName);
			return $query->result_array();
		}
		
		public function insert($tableName, $data)
		{
			$data['added_on'] = now();
			$data['identification'] = $this->input->ip_address() . ", " . $this->agent->agent_string();
			return $this->db->insert( $tableName, $data ); 
		}
		
		public function update($tableName, $data, $condition)
		{
			return $this->db->update( $tableName, $data, $condition);
		}
		
	}
