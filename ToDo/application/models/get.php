<?php
class Get extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function login(){
        define( 'PASSWORD', 'aaa');
        $pass = $this->input->post('password');
        if($pass === PASSWORD){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    public function log(){
        $per_page = 10;
        $where = "flag IS NULL"; 
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('bbs',$where, $per_page);
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return[];
        }
    }

    public function write(){
        $name = $this->input->post('name');
		$message = $this->input->post('main');
		$now_date = date("Y-m-d H:i:s");

        $values = array(
            'view_name' => $name,
            'message' => $message,
            'post_date' => $now_date,
        );
        $sql= $this->db->insert_string('bbs', $values);
        // "INSERT INTO 'bbs' ('view_name', 'message', 'post_date') VALUES ('$name', 'message', '$date')";
        if($this->db->query($sql)){
            //成功処理
            return TRUE;
        }else{
            //失敗処理
            return FALSE;
        }
    }
    public function one($id){
        $this->db->where('id', $id);
        $query = $this->db->get('bbs');
        if(isset($query)){
            return $query->result_array()[0];
        }else{
            return[];
        }
    }

    public function upd(){
        $name = $this->input->post('name');
		$message = $this->input->post('main');
        $now_date = date("Y-m-d H:i:s");
        $edit_id = $this->input->post('edit_id');
        
        $where = "id = $edit_id"; 
        $values = array(
            'view_name' => $name,
            'message' => $message,
            'post_date' => $now_date,
        );

        $sql= $this->db->update_string('bbs', $values, $where);
        if($this->db->query($sql)){
            //成功処理
            return TRUE;
        }else{
            //失敗処理
            return FALSE;
        }
    }
    public function del(){
        
        // $result =$this->db->delete('bbs', $where);

        //flagを挙げる
        $name = $this->input->post('name');
		$message = $this->input->post('main');
        $now_date = date("Y-m-d H:i:s");
        $edit_id = $this->input->post('edit_id');
        $where = "id = $edit_id"; 
        $flag = 0;
        $values = array(
            // 'view_name' => $name,
            // 'message' => $message,
            // 'post_date' => $now_date,
            'flag' => $flag,
        );
        $sql= $this->db->update_string('bbs', $values, $where);
        if($this->db->query($sql)){
            //成功処理
            return TRUE;
        }else{
            //失敗処理
            return FALSE;
        }
    }
}
?>