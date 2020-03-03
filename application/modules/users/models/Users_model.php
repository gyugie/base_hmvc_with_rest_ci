<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends Base_model {

    public function __construct(){
        parent::__construct();

        $this->setTableName("users");
    }

     /**
     * Get all data from table with filter
     *
     * @param   array  $options
     * @return  object
     */
    public function get_all_users($options) {
        return $this->getAll($options);
    }


    function add_user($params) {
        return $this->Insert($params);
    }

    /**
     * Modify data from table
     *  
     * @param   int  	$id
     * @param   array  	$params
     * @return  object
     */
    function modify_user($id, $params) {
        $this->db->where('id', $id);

        return $this->update($params);
    }

    /**
     * Delete data from table
     *
     * @param   int  $params
     * @return  object
     */
    public function delete_fasilitator($id) {
        return $this->delete( array('id' => $id) );
    }

}