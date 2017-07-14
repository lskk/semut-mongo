<?php

class General_model extends CI_Model{

    private $Mserver="mongodb://semut:Semut123@167.205.7.226:27017/bsts_new";
	function __construct(){
		parent::__construct();
	}

	function insert_node($data){
		$str = $this->db->insert_string('tb_node', $data);
		
		$query = $this->db->query($str);
		
		if($query){
			return true;
		}else{
			return false;
		}
		
	}
function get_profile($id){
        $connection = new MongoClient($this->Mserver);
        $collection = $connection->bsts_new->tb_user;
        $document = $collection->findOne(array('ID' =>$id));
        if(!empty($document)) {

            $profile['ID']			= $document['ID'];
            $profile['Name']		= $document['Name'];
            $profile['Email'] 		= $document['Email'];
            $profile['CountryCode']	= $document['CountryCode'];
            $profile['PhoneNumber']	= $document['PhoneNumber'];
            $profile['Gender']		= $document['Gender'];
            $profile['Birthday'] 	= $document['Birthday'];
            $profile['Joindate'] 	= $document['Joindate'];
            $profile['Poin']		= $document['Poin'];
            $profile['PoinLevel']	= $document['PoinLevel'];
            $profile['Reputation'] 	= $document['Reputation'];
            $profile['AvatarID']	= $document['AvatarID'];
            $profile['Verified']	= $document['Verified'];
            $profile['deposit']	    = $document['deposit'];
            $profile['Barcode']	    = $document['Barcode'];
            return $profile;
        }else{
            return false;
        }
	}
	function insert_way($data){
		$str = $this->db->insert_string('tb_way', $data);
		
		$query = $this->db->query($str);
		
		if($query){
			return true;
		}else{
			return false;
		}
		
	}

	function cek_node($id){
		$this->db->where('ID',$id);
		$query = $this->db->get('tb_node');
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
		
	}

	function cek_way($id){
		$this->db->where('ID',$id);
		$query = $this->db->get('tb_way');
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
		
	}

	function cek_way_node($id,$node){
		$this->db->where('WayID',$id);
		$this->db->where('NodeID',$node);
		$query = $this->db->get('tb_way_node');
		if ($query->num_rows > 0) {
			return true;
		} else {
			return false;
		}
		
	}

	function insert_way_node($data){
		$str = $this->db->insert_string('tb_way_node', $data);
		
		$query = $this->db->query($str);
		
		if($query){
			return true;
		}else{
			return false;
		}
		
	}

	function count_semuter(){
		$query = $this->db->query("SELECT * FROM tb_user");
		return $query->num_rows;
	}

	function count_online_semuter(){
		$query = $this->db->query("SELECT * FROM tb_session WHERE EndTime = '0000-00-00 00:00:00' ");
		return $query->num_rows;
	}

	function count_report(){
		$query = $this->db->query("SELECT * FROM tb_post WHERE Status = 1 ");
		return $query->num_rows;
	}

	function count_incident(){
		$query = $this->db->query("SELECT * FROM tb_emergency WHERE Status = 1 ");
		return $query->num_rows;
	}
	
	
	
		
}

?>