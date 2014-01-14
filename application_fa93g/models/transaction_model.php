<?php
	class transaction_model extends CI_Model {
		
		public function __construct()
		{
			$this->load->database();
			$this->load->helper('date');
			$this->load->library('user_agent');
		}
		
		public function autocomplete_customer($searchTerm)
		{
			$this->db->select(array('name', 'reg_number', 'alternate_id', 'type'));
			$this->db->like('name', $searchTerm);
			$this->db->or_like('reg_number', $searchTerm); 
			$this->db->or_like('alternate_id', $searchTerm); 
			$this->db->order_by('name', 'asc'); 
			$query = $this->db->get('customers');
			return $query->result_array();
		}
		
		public function autocomplete_inventory($searchTerm)
		{
				$this->db->select('inventory.name, stock.quantity');
				$this->db->from('inventory');
				$this->db->like('inventory.name', $searchTerm);
				$this->db->or_like('inventory.code', $searchTerm);
				$this->db->or_like('stock.code', $searchTerm);
				$this->db->join('stock', 'stock.inventory_id = inventory.id', 'inner');
				$this->db->order_by('stock.added_on', 'asc');			// It doesn't matter what you put here. We're simply searching for names here. Doesn't matter which stock it returns.
				$query = $this->db->get();
				$results = $query->result_array();
				return $results;
		}
		
	}
