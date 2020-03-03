<?php defined('BASEPATH') or exit('No direct script access allowed');

class Base_model extends CI_Model {

    private $table_name = "";
    private $userdata;
    private $insertAutoTimeStamp;
    private $updateAutoTimeStamp;

    public function __construct(){
        date_default_timezone_set('Asia/Jakarta');
        
        $this->insertAutoTimeStamp  = array();
        $this->updateAutoTimeStamp  = array();

    }

    public function __destruct(){
        $this->db->close(); // close database connection
    }

    public function setTableName($table_name){
        $this->table_name = $table_name;
    }

    public function getAll($options = array()){
        if( ! empty($options['select']) ):
            $this->db->select( $options['select'] );
        endif;

        if( ! empty($options['select_sum']) ):
            $this->db->select_sum( $options['select_sum'] );
        endif;

        if( ! empty($options['select_min']) ):
            $this->db->select_min( $options['select_min'] );
        endif;

        if( ! empty($options['select_max']) ):
            $this->db->select_max( $options['select_max'] );
        endif;

        if( ! empty($options['select_avg']) ):
            $this->db->select_avg( $options['select_avg'] );
        endif;

        if( ! empty($options['from']) ):
            $this->db->from( $options['from'] );
        endif;

        if ( ! empty($options['where']) ):
			$this->db->where( $options['where'] );
		endif;

		if ( ! empty($options['or_where']) ):
			$this->db->or_where( $options['or_where'] );
		endif;

		if( ! empty($options['where_in']) ):
			foreach($options['where_in'] AS $key => $value):
				$this->db->where_in( $key, $value );
			endforeach;
		endif;

		if( ! empty($options['or_where_in']) ):
			$this->db->or_where_in( $options['or_where_in']['field'], $options['or_where_in']['value'] );
		endif;

		if( ! empty($options['where_not_in']) ):
			$this->db->where_not_in( $options['where_not_in']['field'], $options['where_not_in']['value'] );
		endif;

		if( ! empty($options['or_where_not_in']) ):
			$this->db->or_where_not_in( $options['or_where_not_in']['field'], $options['or_where_not_in']['value'] );
		endif;

        if( ! empty($options['like']) ):
			$this->db->like( $options['like'] );
		endif;

        if( ! empty($options['or_like']) ):
			$this->db->or_like( $options['or_like'] );
		endif;

        if( ! empty($options['not_like']) ):
			$this->db->not_like( $options['not_like'] );
		endif;

        if( ! empty($options['order']) ):
            if( isset($options['order']['key']) AND $options['order']['sort'] ):
                $this->db->order_by( $options['order']['key'], $options['order']['sort'] );
            else:
                foreach($options['order'] AS $key => $sort):
                    $this->db->order_by( $key, $sort );
                endforeach;
            endif;
		endif;

		if( ! empty($options['join']) ):
			foreach($options['join'] as $key => $value):
				$this->db->join( $key, $value );
			endforeach;
		endif;

        if ( ! empty($options['left_join']) ){
			foreach($options['left_join'] as $key => $value){
				$this->db->join($key, $value, 'left');
			}
		}
        
		if( ! empty($options['limit']) ):
			if( ! empty($options['offset']) ):
				$this->db->limit( $options['limit'], $options['offset'] );
			else:
				$this->db->limit( $options['limit'] );
			endif;
		endif;

        if( ! empty($options['group_by']) ):
            foreach($options['group_by'] as $key => $value){
                $this->db->group_by( $value );
            }
        endif;

        $data = $this->db->get( $this->table_name );

        if ( ! empty($options['count']) ):
			return $data->num_rows();
		elseif( ! empty($options['single']) ):
			return $data->row();
		elseif( ! empty( $options['array']) ):
            return $data->result_array();
        elseif( ! empty( $options['list_fields']) ):
            return $data->list_fields();
		else:
			return $data->result();
		endif;

    }

  

    public function Insert($data, $method = 'normal'){
        if( $method == 'normal' ):
            
            if( in_array($this->table_name, $this->insertAutoTimeStamp) ):
                $data['created_date']   = date("Y-m-d H:i:s");
                $data['created_by']     = isset($this->userdata->id_user) ? $this->userdata->id_user : 1;
            endif;

            $this->db->insert($this->table_name, $data);
        else:
            $this->db->insert_batch($this->table_name, $data);
        endif;

        if( $this->db->affected_rows() > 0 ):
            return $this->db->insert_id();
        endif;

        return FALSE;
    }

    public function Update($data, $where = array(), $method = 'normal'){
        if( $method == 'normal' ):

            if( in_array($this->table_name, $this->updateAutoTimeStamp) ):
                $data['modified_date']   = date("Y-m-d H:i:s");
                $data['modified_by']     = isset($this->userdata->id_user) ? $this->userdata->id_user : 1;
            endif;

            $this->db->where($where);
            $this->db->update($this->table_name, $data);
        else:
            $this->db->update_batch($this->table_name, $data, $where);
        endif;

        return $this->db->affected_rows();
    }

    public function Delete($where){
        $this->db->delete($this->table_name, $where);

        return $this->db->affected_rows();
    }
}
