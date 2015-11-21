<?php
if ( ! defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/17/15
 * Time: 5:51 PM
 */
class MY_Model extends CI_Model
{

    private $table;

    const UPDATE ='update';
    const INSERT='insert';


    public function __construct()
    {
        parent::__construct();
        $this->table = get_Class($this);
        $this->load->database();
    }

    public function search($condition=NULL, $table="")
    {
        if(empty($table{0})) {
            $table = mb_strtolower($this->getTable());
        }
        if(isset($condition))
            $this->db->where($condition);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function save($data, $table="")
    {
        if(empty($table{0})){
            $table =mb_strtolower($this->getTable());
        }
        $op = CRUD_Model::UPDATE;
        $keyExists = false;
        $tableRows = $this->db->field_data($table);
        foreach($tableRows as $row)
        {
            if($row->primary_key==1){
                $keyExists = true;
                if(isset($data[$row->name])){
                    $this->db->where($row->name, $data[$row->name]);
                }else{
                    $op = CRUD_Model::INSERT;
                }
            }
        }
        if($keyExists && $op==CRUD_Model::UPDATE){
            $this->db->set($data);
            $this->db->update($table);
            if($this->db->affected_rows()==1){
                return $this->db->affected_rows();
            }
        }
        $this->db->insert($table,$data);
        return $this->db->affected_rows();
    }

    function delete($conditions,$table="")
    {
        if(empty($table{0})){  $table = $this->table;   }
        $this->db->where($conditions);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }
}