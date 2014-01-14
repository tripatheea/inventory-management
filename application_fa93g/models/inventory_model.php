<?php
		class Inventory_model extends CI_Model {
			
				private $tableName = 'inventory';
				
				public function __construct(){
						$this->load->database();
						$this->load->helper('date');
						$this->load->library('user_agent');
				}
				
				public function get_inventory( $what, $condition, $limit = NULL, $offset = NULL, $orderBy = NULL ){
						$this->db->select(implode(',', $what));
						$this->db->from('inventory');
						
						if($condition) { $this->db->where($condition); }	// Can use something like 'id !=' => 2
						
						if($orderBy){ $this->db->order_by($orderBy); }
						if($limit){ $this->db->limit($limit); }	// Limit sth like '1, 2'
						
						$this->db->join('stock', 'stock.inventory_id = inventory.id', 'inner');
						
						$query = $this->db->get();
						return $query->result_array();
				}
				
				public function insert_inventory( $data ){
						$data['added_on'] = now();
						$data['identification'] = $this->input->ip_address() . ", " . $this->agent->agent_string();
						return $this->db->insert( $this->tableName, $data ); 
				}
				
				public function update_inventory( $data, $where ){
						return $this->db->update( $this->tableName, $data, $where);
				}
			
		}
