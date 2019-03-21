<?php

Class Common_model extends CI_Model {
	//public $db2;
    function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->db2 = $this->load->database($this->set_db_config(), TRUE);
		if($this->session->userdata('username')!=''){
			$this->set_session_device_list();
		}
		
    }

   function set_db_config(  ) {
        $config['hostname'] = DB_HOST;
		$config['username'] = DB_USERNAME;
		$config['password'] = DB_PASSWORD;
		$config['database'] = $this->session->userdata('db_name');
		$config['dbdriver'] = 'mysqli';
		$config['dbprefix'] = '';
		$config['pconnect'] = FALSE;
		$config['db_debug'] = TRUE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = '';
		$config['char_set'] = 'utf8';
		$config['dbcollat'] = 'utf8_general_ci';
        return $config;
	}

	function set_session_device_list(){
		$type_list = $this->getDeviceList(  );//get devic type list
		$data = array();
		$total_device = count($type_list);
		if(!empty($type_list))
		{
			$total_count=0;
			$count=0;
			$i=0;
			$green=$blue=$red=$gray=array();
			$avgWindSpeed = $avgWindSpeedTime = $powerSpeed=$pat_gen_list=$pat_gen_first=$pat_gen_last=$avg_wind_speed=array();
			foreach($type_list as $list)
			{
				$date = date('Y-m-d'); //current date'2018-08-14'; //
				$search_info = array('order' =>'DESC','start_date'=>$date,'end_date'=>$date);
				$device_list	=	$this->get_device_data_details( $list->Format_Type, $list->IMEI, $search_info );
				$device_sum_list=	$this->get_sum_device_data_details( $list->Format_Type, $list->IMEI, $search_info );
				if(!empty($device_sum_list)){
					foreach($device_sum_list as $value){
						$avgWindSpeed[$value->hour][] = $value->Windspeed;
					}
				}
				
				if(!empty($device_list))
				{
					// echo "<pre>"; print_r($device_list); exit;
					$powerSpeed[] = (float)$device_list->Power;
					//$avgWindSpeed[] = (float)$device_list->Windspeed;
					// $avgWindSpeedTime[] =$device_list->Time_S;
					$avgWindSpeedTime[] =date('h:i:s a', strtotime($device_list->Time_S));
					$count =$count+1;

					$search = array('order' =>'ASC','start_date'=>$date,'end_date'=>$date);
					$search1 = array('order' =>'DESC','start_date'=>$date,'end_date'=>$date);
					$pat_gen_first	=	$this->get_device_data_details( $list->Format_Type, '',$search);
					$pat_gen_last	=	$this->get_device_data_details( $list->Format_Type, '',$search1 );
					
					if(!empty($pat_gen_first) && !empty($pat_gen_last) ) 
					{
						$pat_gen_list[] =	$pat_gen_last->PAT_Gen1-$pat_gen_first->PAT_Gen1;
					}
				} else {
					$pat_gen_list[] = 0;
				}
			}
			/** Calculate avg win speed for 24 hrs current day**/
			if(!empty($avgWindSpeed)){
				for ($x = 1; $x <= 24; $x++) {
				 $avg_wind_speed[$x] = (isset($avgWindSpeed[$x])?(array_sum($avgWindSpeed[$x])/count($avgWindSpeed[$x])):0);
				}
			}
			
			$data['avgWindSpeed'] = $avg_wind_speed;
			$data['avgWindSpeedTime'] = $avgWindSpeedTime;
			$data['powerSpeed'] = $powerSpeed;
			$data['patGen'] = $pat_gen_list;
			
			$sum_avg = array_sum($avgWindSpeed);
			$sum_power = array_sum($powerSpeed);
			$sum_gen = array_sum($pat_gen_list);
			$data['avgWindSpeedSum'] = !empty($sum_avg)?number_format(($sum_avg/$count),2):0;
			$data['powerSpeedSum'] = !empty($sum_power)?number_format(($sum_power/1000),2):0;
			$data['patGenSum'] = !empty($sum_gen)?number_format($sum_gen,2):0;
			$this->session->set_userdata($data);
		}
		return $data;
	}
	
	function get_sum_device_data_details( $type , $imei, $search=array()) {
		//skip for format type 1
		($type == 1? $type = "" : $type = "_f".$type);
		$this->db2->select('HOUR(Time_S) as hour,Date_S as date, sum(Windspeed) as Windspeed')->from('device_data'.$type);
		if(!empty($imei))
		{
			$this->db2->where('IMEI',$imei);
		}

		if(!empty($search['start_date']) && !empty($search['end_date']))
		{
			$this->db2->where("DATE_FORMAT(Date_S,'%y-%m-%d') BETWEEN DATE('".$search['start_date']."') AND DATE('".$search['end_date']."') ");
		}
		$this->db2->group_by('Date_S,HOUR(Time_S)');
		$query = $this->db2->get();
		//echo $this->db2->last_query();exit;
        return $query->result();
	}
	
	function get_device_details($type, $imei)
	{
		$val =array();
		$device_data = $this->get_device_data_details( $type, $imei );
		$error_data = $this->get_error_data_details( $type, $imei );
		if(!empty($device_data) && !empty($error_data))
		{
			$device_time = strtotime($device_data->Date_S.' '.$device_data->Time_S);
			$error_time = strtotime($error_data->Date_S.' '.$error_data->Time_S);

			$val =$error_data;
			if($device_time > $error_time)
			{
				$val =$device_data;
			}
		}
		return $val;		
	}
    function get_device_data_details( $type , $imei, $search=array()) {
		//skip for format type 1
		($type == 1? $type = "" : $type = "_f".$type);
		$this->db2->select('*')->from('device_data'.$type);
		if(!empty($imei))
		{
			$this->db2->where('IMEI',$imei);
		}
		if(!empty($search['order']))
		{
			$this->db2->order_by('Record_Index',$search['order']);
			//$limit = (!empty($search['limit'])?$search['limit']:1);
			$this->db2->limit(1);
		}

		if(!empty($search['start_date']) && !empty($search['end_date']))
		{
			$this->db2->where("DATE_FORMAT(Date_S,'%y-%m-%d') BETWEEN DATE('".$search['start_date']."') AND DATE('".$search['end_date']."') ");
		}
		
		$query = $this->db2->get();
		// if(!empty($search['start_date']) && !empty($search['end_date']))
		// {
		// echo $this->db2->last_query();
		// }
        return $query->row();
	}
	
	function get_error_data_details( $type, $imei ) {
		//skip for format type 1
		($type == 1? $type = "" : $type = "_f".$type);
		$this->db2->select('*')->from('error_data'.$type);
		$this->db2->where('IMEI',$imei);
		$this->db2->order_by('Record_Index','DESC');
	//	$this->db2->limit(1);
		$query = $this->db2->get();
		//echo $this->db2->last_query();
          return $query->row();
    }
	
	function getDeviceList( $device_name='' ) {
        $result = array();
	
		$Account_ID = $this->session->userdata('account_id');

        $this->db->select('IMEI, Device_Name, Format_Type , (SELECT  count(*) as cnt FROM `device_register` WHERE `Account_ID` = '.$Account_ID.') as cnt')
				->where('Account_ID',$Account_ID);
				if(!empty($device_name)){
					$this->db->where_in('Device_Name',$device_name);
				}
				
		$query = $this->db->get('device_register');
    
        return $query->result();
	}
	
	function get_region_site_list(  ) {
        $result = array();
	
		$Account_ID = $this->session->userdata('account_id');

        $this->db->select('Site_Location,Region, Device_Name, Format_Type,IMEI, LOC_No, capacity, Connect_Feeder')
				->where('Account_ID',$Account_ID)
				->where("Region!=''");

			//	->group_by('Region,Site_Location');
        $query = $this->db->get('device_register');
        return $query->result_array();
    }

	function get_device_list_by_given_imei( $imei='' ) {
        $result = array();
	
		$Account_ID = $this->session->userdata('account_id');

        $this->db->select('Site_Location,Region, Device_Name, Format_Type,IMEI, LOC_No, capacity, Connect_Feeder')
				->where('Account_ID',$Account_ID)
				->where("Region!=''");
				if(!empty($imei)){
					$this->db->where_in('IMEI',$imei);
				}
			//	->group_by('Region,Site_Location');
        $query = $this->db->get('device_register');
        return $query->row_array();
    }
	function get_device_data_Info( $type , $imei, $search=array()) {
		//skip for format type 1
		($type == 1? $type = "" : $type = "_f".$type);
		$this->db2->select('*')->from('device_data'.$type);
		if(!empty($imei))
		{
			$this->db2->where('IMEI',$imei);
		}
		if(!empty($search['order']))
		{
			$this->db2->order_by('Record_Index',$search['order']);
		}

		if(!empty($search['start_date']) && !empty($search['end_date']))
		{
			$this->db2->where("DATE_FORMAT(Date_S,'%y-%m-%d') BETWEEN DATE('".$search['start_date']."') AND DATE('".$search['end_date']."') ");
		}
		
		$query = $this->db2->get();
		// if(!empty($search['start_date']) && !empty($search['end_date']))
		// {
		 // echo $this->db2->last_query(); exit;
		// }
        return $query->result_array();
	}
	
	function get_date_wise_device_data_Info( $type , $imei, $search=array()) {
		//skip for format type 1
		($type == 1? $type = "" : $type = "_f".$type);
		$this->db2->select('Date_S, sum(Windspeed) as Windspeed')->from('device_data'.$type);
		if(!empty($imei))
		{
			$this->db2->where('IMEI',$imei);
		}
		if(!empty($search['order']))
		{
			$this->db2->order_by('Record_Index',$search['order']);
		}

		if(!empty($search['start_date']) && !empty($search['end_date']))
		{
			$this->db2->where("DATE_FORMAT(Date_S,'%y-%m-%d') BETWEEN DATE('".$search['start_date']."') AND DATE('".$search['end_date']."') ");
		}
		$this->db2->group_by('Date_S');
		$query = $this->db2->get();
		// if(!empty($search['start_date']) && !empty($search['end_date']))
		// {
		//  echo $this->db2->last_query(); exit;
		// }
        return $query->result_array();
	}


	function get_error_data_Info( $type , $imei, $search=array()) {
		//skip for format type 1
		($type == 1? $type = "" : $type = "_f".$type);
		$this->db2->select('*')->from('error_data'.$type);
		if(!empty($imei))
		{
			$this->db2->where('IMEI',$imei);
		}
		if(!empty($search['order']))
		{
			$this->db2->order_by('Record_Index',$search['order']);
		}

		if(!empty($search['limit']))
		{
			$this->db2->limit($search['limit']);
		}

		if(!empty($search['start_date']) && !empty($search['end_date']))
		{
			$this->db2->where("DATE_FORMAT(Date_S,'%y-%m-%d') BETWEEN DATE('".$search['start_date']."') AND DATE('".$search['end_date']."') ");
		}
		
		$query = $this->db2->get();
		// if(!empty($search['start_date']) && !empty($search['end_date']))
		// {
		 //echo $this->db2->last_query();
		// }
        return $query->result_array();
	}

	function get_dashboard_device_list(){
		$type_list = $this->getDeviceList(  );//get devic type list
		$data = array();
		$total_device = count($type_list);
		if(!empty($type_list))
		{
			$total_count=0;
			$count=0;
			$i=0;
			$green=$blue=$red=$gray=array();
			$avgWindSpeed = $powerSpeed=$pat_gen_list=$pat_gen_first=$pat_gen_last=array();
			foreach($type_list as $list)
			{
				$date =  date('Y-m-d'); //'2018-08-14';
				$search_info = array('start_date'=>$date,'end_date'=>$date);
				$device_list	=	$this->get_device_data_Info( $list->Format_Type, $list->IMEI, $search_info );
				
				if(!empty($device_list))
				{
					foreach ($device_list as $key => $value) {
						$hour = date('H',strtotime($value['Time_S']));
						$powerSpeed[$hour][] = $value['Power'];
						$avgWindSpeed[$hour][] = $value['Windspeed'];
					}
				}
				/* $date = '2018-08-14';//date('Y-m-d');
				$search = array('start_date'=>$date,'end_date'=>$date);
				$search1 = array('order' =>'DESC','start_date'=>$date,'end_date'=>$date);
				$pat_gen_first	=	$this->get_device_data_Info( $list->Format_Type, '',$search);
				$pat_gen_last	=	$this->get_device_data_Info( $list->Format_Type, '',$search1 );
				
				if(!empty($pat_gen_first) && !empty($pat_gen_last) ) 
				{
					$pat_gen_list[] =	$pat_gen_last->PAT_Gen1-$pat_gen_first->PAT_Gen1;
				} */
			}
			//	echo '<pre>';print_r($powerSpeed);exit;
			if(!empty($avgWindSpeed))
			{
				foreach ($avgWindSpeed as $key => $value) {
					$data['avgWindSpeedSum'][$key] = number_format((array_sum($value)/count($value)),2);
				}
			}
			if(!empty($powerSpeed))
			{
				foreach ($powerSpeed as $key1 => $value1) {
					$data['powerSpeedSum'][$key1] = number_format((array_sum($value1)/1000),2);
				}
			}
		}
		//echo '<pre>';print_r($data);exit;
		return $data;
	}

	function build_sorter($key) {
		return function ($a, $b) use ($key) {
			return strnatcmp($a[$key], $b[$key]);
		};
	}
	public function sort_by_array($array){

		//usort($array, function (int $a, int $b) { return -($a <=> $b); });
		usort($array, $this->build_sorter('datetime'));
		return $array;
	}
   
}

?>
