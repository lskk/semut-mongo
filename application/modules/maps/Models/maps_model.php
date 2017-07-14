<?php

class Maps_model extends CI_Model{
	
	var $table = "tb_user";
    private $Mserver="mongodb://semut:Semut123@167.205.7.226:27017/bsts_new";
	function __construct(){
		parent::__construct();
	}
    
    //Get user semut location for mapview monitor
    
    function get_latest(){
    	$latesttime = array();
    	$this->db->select('MAX(Timespan) AS timespan')->from('tb_location')->group_by('UserID');
    	
    	$latest = $this->db->get()->result();
    	foreach ($latest as $row) {
            array_push($latesttime, $row->timespan);
    	}
    	return $latesttime;
    }
	
	function get_semuters(){
        $latest = $this->get_latest();
        $this->db
    		->distinct()
			->select('
				tb_location.Altitude AS alt,
				tb_location.Latitude AS lat,
				tb_location.Longitude AS lon,
				tb_location.Speed AS spd,
				tb_user.Name AS name,
				tb_user.Gender AS avt
				')
			->join('tb_user', 'tb_location.UserID = tb_user.ID', 'left')
            ->where('tb_location.Latitude != 0 AND tb_location.Longitude != 0')
            ->where('tb_user.Visibility',0)
			->where_in('tb_location.Timespan',$latest);

		return $this->db->get('tb_location')->result();
    }
     
    function get_ambulance(){
        $this->db->select('tb_ambulance.*, tb_city.Name')
            ->join('tb_city','tb_ambulance.CityID = tb_city.ID','left');
        return $this->db->get('tb_ambulance')->result();
    }

    function get_ads(){
        $this->db
            ->select('
                Latitude AS lat,
                Longitude AS lon,
                Title AS title,
                Description AS descript,
                StartDate AS startd,
                ExpiredDate AS expd')
            ->where('Status',1);

        return $this->db->get('tb_ads')->result();
    }

    function get_report(){
       // $datelimit= date(now(),interval 1 day);
		$where = "Times > DATE_SUB( NOW() , INTERVAL 1 DAY )";
        $this->db
            ->select('
                tb_post.Latitude AS lat,
                tb_post.Longitude AS lon,
                tb_post_subtype.Name AS type,
                tb_post_subtype.ID AS parenttype,
                tb_post.Description AS description,
                tb_user.Name AS reporter,
                tb_post.Times AS time')
            ->join('tb_user','tb_post.UserID = tb_user.ID','left')
            ->join('tb_post_subtype','tb_post.SubType = tb_post_subtype.ID','left')
           // ->where('tb_post.Times',$datelimit)
		    ->where($where)
            ->where('tb_post.Status',1);
        return $this->db->get('tb_post')->result();
    }

    function get_place($type){
        $this->db
            ->select('
				tb_place.ID as ID,
                tb_place.Latitude AS lat,
                tb_place.Longitude AS lon,
                tb_place.Name AS name,
                tb_place.Address AS address,
                tb_place.Description AS description,
                tb_place_type.Name AS type
                ')
            ->join('tb_place_type','tb_place.TypeID = tb_place_type.ID','left')
            ->where('tb_place.TypeID',$type);

        return $this->db->get('tb_place')->result();
    }

    function get_member_report($id){
        $this->db
            ->select('
                tb_post.Latitude AS lat,
                tb_post.Longitude AS lon,
                tb_post.Title AS title,
                tb_user.Name AS reporter,
                tb_post.Times AS time,
                tb_post.Status AS status')
            ->join('tb_user','tb_post.UserID = tb_user.ID','left')
            ->where('tb_post.UserID',$id);

        return $this->db->get('tb_post')->result();
    }

    function get_incident(){
        $this->db
            ->select('
                tb_emergency.Latitude AS lat,
                tb_emergency.Longitude AS lon,
                tb_emergency.Title AS title,
                tb_user.Name AS caller,
                tb_emergency_type.TypeName AS type,
                tb_emergency.Times AS time')
            ->join('tb_user','tb_emergency.UserID = tb_user.ID','left')
            ->join('tb_emergency_type','tb_emergency.Type = tb_emergency_type.ID','left')
            ->where('tb_emergency.Status',1);

        return $this->db->get('tb_emergency')->result();
    }

    function get_member_friend($id){
        $this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State = 2 AND (ID_REQUEST= $id OR ID_RESPONSE=$id)');
        //$this->db->or_where('ID_RESPONSE',$id);
        $query  = $this->db->get();

        return $query->result();
    }

    function get_friend1($id){
        $this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','2');
        $this->db->where('ID_REQUEST',$id);
        $query  = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    function get_friend2($id){
        $this->db->select('*');
        $this->db->from('tb_relation');
        $this->db->where('State','2');
        $this->db->where('ID_RESPONSE',$id);
        $query  = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function get_friend_location($id){
        $latest = $this->get_latest();
        $this->db->select('
                tb_location.Altitude AS alt,
                tb_location.Latitude AS lat,
                tb_location.Longitude AS lon,
                tb_location.Speed AS spd,
                tb_user.Name AS name,
                tb_user.Gender AS avt
            ');
        $this->db->from('tb_location');
        $this->db->join('tb_user', 'tb_location.UserID = tb_user.ID', 'left');
        $this->db->where('tb_location.Latitude != 0 AND tb_location.Longitude != 0');
        $this->db->where('tb_location.UserID', $id);
        $this->db->where_in('tb_location.Timespan',$latest);
        $query = $this->db->get(); 
       
        return $query->row();
    }

    function get_cctv(){

        $this->db->select('a.ID as ID,a.CityID as CityID,a.urlVideo as urlVideo,a.urlImage as urlImage, a.ItemID as ItemID, a.Name as Name, a.Stream as Stream, a.Latitude as Latitude, a.Longitude as Longitude, 
                                    b.Name as City, c.Name as Province, d.Name as Country');
        $this->db->from('tb_cctv a');
        $this->db->join('tb_city b', 'a.CityID = b.ID', 'left');
        $this->db->join('tb_province c', 'b.ProvinceID = c.ID','left');
        $this->db->join('tb_country d','c.CountryID = d.ID','left');
        $query = $this->db->get(); 
        return $query->result();
    }

    function get_cctv2(){
        $this->mongo_db->select();
        $this->mongo_db->from('tb_cctv');
        $query = $this->mongo_db->get();
        return $query->result();

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
	function get_angkot(){
        $this->db->select('*');
        $this->db->from('at_angkot');
    
        return $this->db->get()->result();
    }
    
    function get_stops() {
    //Query the data table for every record and row
    $sql = 'SELECT * FROM tr_stops';
    $query = $this->db->query($sql);

    if ($query->num_rows() == 0) {
      //show_error('Database is empty!');
    }else{
      return $query->result();
    }
  }

  function get_stops_coord() {
    //Query the data table for every record and row
    $sql = 'SELECT stop_id, stop_lat, stop_lon FROM tr_stops ORDER BY stop_lon ASC';
    $query = $this->db->query($sql);

    if ($query->num_rows() == 0) {
      //show_error('Database is empty!');
    }else{
      return $query->result();
    }
  }

  function get_stops_time($stop_id) {
    //Query the data table for every record and row
    $this->db->where('stop_id', $stop_id);
    // $this->db->where('departure_time >= NOW()');
    $this->db->order_by("arrival_time", "asc");
    //here we select every clolumn of the table
    // $query = $this->db->get('tr_stop_times', 4);
    $query = $this->db->get('tr_stop_times');

    if ($query->num_rows() == 0) {
      //show_error('Database is empty!');
    }else{
      return $query->result();
    }
  }

  function get_train_arrival_time($stop_id, $trip_id) {
    $trip_id = substr($trip_id, 2);
    //Query the data table for every record and row
    $this->db->select('arrival_time');
    $this->db->where('stop_id', $stop_id);
    $this->db->where('trip_id', $trip_id);
    //here we select every clolumn of the table
    $query = $this->db->get('tr_stop_times');

    if ($query->num_rows() == 0) {
      //show_error('Database is empty!');
    }else{
      return $query->result();
    }
  }

  function get_train_departure_time($stop_id, $trip_id) {
    $trip_id = substr($trip_id, 2);
    //Query the data table for every record and row
    $this->db->select('departure_time');
    $this->db->where('stop_id', $stop_id);
    $this->db->where('trip_id', $trip_id);
    //here we select every clolumn of the table
    $query = $this->db->get('tr_stop_times');

    if ($query->num_rows() == 0) {
      //show_error('Database is empty!');
    }else{
      return $query->result();
    }
  }
		
}

?>