<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
                                          
class Dashboard extends CI_Controller {
 
	public $sessionUsername;
	public $sessionDbname;
	function __construct(){	
		parent::__construct();
		$this->load->helper(array('url', 'language'));	
		$this->load->helper('form');
		$this->load->library('form_validation');
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
		//$details = $this->Common_model->get_dashboard_device_list();
		
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
		$device_info=$top_data=$footer_data=$footer =$device_data=array();
		$region_list = $this->Common_model->get_region_site_list();
		if(!empty($region_list))
			{
			foreach($region_list as $list)
			{
				$device_info = (array)$this->Common_model->get_device_data_details( $list['Format_Type'], $list['IMEI'] );
				$search['limit']=5;
				$error_info = (array)$this->Common_model->get_error_data_Info( $list['Format_Type'], $list['IMEI'], $search );
				
				if( !empty($device_info) ) {
					$device_info['Device_Name']= $list['Device_Name'];
					$device_info['LOC_No']= $list['LOC_No'];
					$device_info['capacity']= $list['capacity'];
					$device_info['Connect_Feeder']= $list['Connect_Feeder'];
					$device_data[$list['Region']][$list['Device_Name']] = $device_info;
					//$winspeed = $device_info['Windspeed'];
					//$power = $device_info['Power'];
					$top_data[$list['Region']]['Windspeed'][] =$device_info['Windspeed'];
					$top_data[$list['Region']]['Power'][] =$device_info['Power'];
					$top_data[$list['Region']]['device_list'][]=$device_info['Device_Name'];
				}
				if( !empty($error_info) ) {
					//echo '<pre>';print_r($error_info);exit;
					foreach($error_info as $info)
					{
						$footer_data[$list['Region']][] =array(
																'Date_S'=> !empty($info['Date_S'])?date('d-m-Y',strtotime($info['Date_S'])):'---',
																'Time_S'=> $info['Time_S'],
																'Device_Name'=>$list['Device_Name'],
																'Description'=>$info['Status'],
																'datetime'=> $info['Date_S'].' '.$info['Time_S']
															);
					}
				}
			}
			
			if(!empty($footer_data)){
				foreach ($footer_data as $key => $value) {
					if(count($value)> 5 ){
						$value=$this->Common_model->sort_by_array($value);
					}
					$footer[$key]=$value;
				}
			}
		}
		//echo '<pre>';print_r($footer);exit;
	 	$data['regions'] = $top_data;
		$data['regionDeviceData'] = $device_data;
		$data['footer_data'] = $footer;
		$this->load->view('dashboard/park_view', $data);
	}

	function device_view() {
		$this->load->view('dashboard/device_view');
	}
	
	function temp_analysis() {
		$device_list = $this->Common_model->get_region_site_list();
		
		$data['tempAna']['deviceList'] = $device_list;
		$this->load->view('dashboard/temp_analysis', $data);
	}

	function powercurve_analysis() {
		$device_list = $this->Common_model->get_region_site_list();
		
		$data['powCurve']['deviceList'] = $device_list;
		$this->load->view('dashboard/powercurve_analysis', $data);
	}

	function performance_analysis() {
		$this->load->view('dashboard/performance_analysis');
	}

}
?>
