<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
                                          
class Dashboard extends CI_Controller {
 
	public $sessionUsername;
	public $sessionDbname;
	function __construct(){	
		parent::__construct();
		$this->load->helper(array('url', 'language'));	
		$this->load->helper('form');
		$this->load->library('session');
		$this->sessionUsername = $this->session->userdata('username');
		$this->sessionDbname = $this->session->userdata('db_name');
		if(empty($this->sessionUsername)){
			redirect('');
		}
		
		$this->load->view('layout/header');
		$this->db2 = $this->load->database($this->Common_model->set_db_config(), TRUE);
	}
 
	function index() {
		$type_list = $this->Common_model->getDeviceList(  );//get devic type list
		//print_r($type_list);
		$data['green']=$data['blue']=$data['red']=$data['gray']=array();
		$total_device = count($type_list);
		if(!empty($type_list))
		{
			$green_array = array('Run', 'RUN', 'M/C Running', 'M/C Running');
			$blue_array = array('GRIDDROP', 'griddrop', 'Grid Drop', 'Grid Drop');
			$red_array = array_merge($green_array,$blue_array);
			$total_count=0;
			$count=0;
			$i=0;
			$green=$blue=$red=$gray=array();
			$avgWindSpeed = $powerSpeed=$pat_gen_list=$pat_gen_first=$pat_gen_last=array();
			foreach($type_list as $list)
			{
				$val	=	$this->Common_model->get_device_details( $list->Format_Type, $list->IMEI );
				// echo "<pre>";print_r($val); exit;
				if(!empty($val))
				{
					/** get current time from DB and then check device date is less then 1 hour for current time */
					$query = $this->db2->query('select (NOW() - INTERVAL 2 HOUR) as curr_time', TRUE);
					$curr_time = strtotime($query->row()->curr_time);

					$device_time = strtotime($val->Date_S.' '.$val->Time_S);
					/** less then 1 hour for current time then it's gray color*/
					if($device_time > $curr_time)
					{
						$gray[] = $val;
					}
					elseif(in_array($val->Status,$green_array))
					{
						$green[] = $val;
					}elseif(in_array($val->Status,$blue_array)){
						$blue[] = $val;
					}elseif(in_array($val->Status,$red_array)){
						$red[] = $val;
					}
				}
				$total_count = $list->cnt;
			}
		

			$data['response']['green'] = array('count'=> count($green),'name'=>'WTG RUN','total'=>$total_count);
			$data['response']['red']= array('count'=> count($red),'name'=>'WTG GRID DROP','total'=>$total_count);
			$data['response']['blue']= array('count'=> count($blue),'name'=>'WTG ERROR','total'=>$total_count);
			$data['response']['gray']= array('count'=> count($gray),'name'=>'WTG SCADA OFF','total'=>$total_count);
			
		}

		$data['avgWindSpeed'] = $this->session->userdata('avgWindSpeed');
		$data['powerSpeed'] = $this->session->userdata('powerSpeed');
		$data['patGen'] = $this->session->userdata('patGen');
		$data['avgWindSpeedSum'] = $this->session->userdata('avgWindSpeedSum');
		$data['powerSpeedSum'] = $this->session->userdata('powerSpeedSum');
		$data['patGenSum'] = $this->session->userdata('patGenSum');
	
		$this->load->view('dashboard/index',$data);
	}
	
	function park_view() {
		
		$region_list = $this->Common_model->get_region_site_list();
		$i=0;
		// echo '<pre>';print_r( $region_list);
		foreach($region_list as $list)
		{
			$device_info = (array)$this->Common_model->get_device_data_details( $list['Format_Type'], $list['IMEI'] );

			if( !empty($device_info) ) {
			$device_info['Device_Name']= $list['Device_Name'];
			$device_data[$list['Region']][$list['Device_Name']][] = $device_info;
			$winspeed[$list['Region']]['Windspeed'][$list['IMEI']] = $device_info['Windspeed'];
			$winspeed[$list['Region']]['Power'][$list['IMEI']] = $device_info['Power'];
			$top_data[$list['Region']] = array( 'Windspeed'=>array($device_info['Windspeed']), 'Power'=>array($device_info['Power']));
		}
		$i++;}

		// echo '<pre>';print_r( $device_data);
		// echo '<pre>';print_r($winspeed);exit;

		$data['parkview']['regions'] = $region_list;
		$data['parkview']['regionDeviceData'] = $device_data;

		$this->load->view('dashboard/park_view', $data);
	}
	
	function temp_analysis() {
		$device_list = $this->Common_model->get_region_site_list();
		
		$data['tempAna']['deviceList'] = $device_list;
		$this->load->view('dashboard/temp_analysis', $data);
	}

	function powercurve_analysis() {
		$this->load->view('dashboard/powercurve_analysis');
	}

	function performance_analysis() {
		$this->load->view('dashboard/performance_analysis');
	}

	function get_temp_analysis() {
		if(empty($_REQUEST['device_name']) && empty($_REQUEST['date'])) {
			echo json_encode(array('message'=>'invaid'));exit;
		}
		echo'<pre>';print_r( $_REQUEST);exit;
		$device_list = $this->Common_model->getDeviceList($_REQUEST['device_name']);
		foreach($device_list as $list)
		{
			$date = date('Y-m-d', strtotime($_REQUEST['date']));
			$search = array('order' =>'ASC','start_date'=>$date,'end_date'=>$date);
			$val	=	$this->Common_model->get_device_details( $list->Format_Type, $list->IMEI,$search );
			 echo "<pre>";print_r($val); exit;
			if(!empty($val))
			{
				$date = date('Y-m-d', strtotime($_REQUEST['date']));
				$search = array('order' =>'ASC','start_date'=>$date,'end_date'=>$date);
				$tempAnaData =	$this->get_device_data_details( $list->Format_Type, '',$search);
			}
		}
		
		

	}
}
?>
