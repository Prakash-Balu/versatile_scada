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
			// echo '<pre>';print_r( $region_list);exit;
		foreach($region_list as $list)
		{
			$device_info = (array)$this->Common_model->get_device_data_details( $list['Format_Type'], $list['IMEI'] );
			$error_info = (array)$this->Common_model->get_device_data_details( $list['Format_Type'], $list['IMEI'] );
			
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
				$footer_data[$list['Region']][] =array(
														'Date_S'=> !empty($error_info['Date_S'])?date('d-m-Y',strtotime($error_info['Date_S'])):'---',
														'Time_S'=> $error_info['Time_S'],
														'Device_Name'=>$list['Device_Name'],
														'Description'=>'');
				}
		
		}

	 	$data['regions'] = $top_data;
		$data['regionDeviceData'] = $device_data;
		$data['footer_data'] = $footer_data;
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
		$this->form_validation->set_rules('device_name[]', 'device name', 'required');
		$this->form_validation->set_rules('temp_name', 'Temp name', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$data = array();
		if ($this->form_validation->run() == TRUE)
		{
			$green_array = array('Run', 'RUN', 'M/C Running', 'M/C Running');
			$blue_array = array('GRIDDROP', 'griddrop', 'Grid Drop', 'Grid Drop');
			$red_array = array_merge($green_array,$blue_array);
			$formvalues	=	$this->input->post();
			$device_list = $this->Common_model->getDeviceList($formvalues['device_name']);
			$green=$blue=$red=$gray=null;
			$avgWindSpeed = $powerSpeed=$pat_gen_list=$pat_gen_first=$pat_gen_last=array();

			foreach($device_list as $list)
			{
				$date = date('Y-m-d', strtotime($formvalues['date']));
				$search = array('order' =>'ASC','start_date'=>$date,'end_date'=>$date);
				$val	=	$this->Common_model->get_device_data_Info( $list->Format_Type, $list->IMEI,$search );
				//$data['table'][]= $list->Format_Type;
				if(!empty($val))
				{
					
					foreach($val as $val_list)
					{
						/** get current time from DB and then check device date is less then 1 hour for current time */
						$query = $this->db2->query('select (NOW() - INTERVAL 2 HOUR) as curr_time', TRUE);
						$curr_time = strtotime($query->row()->curr_time);
						$device_time = strtotime($val_list['Date_S'].' '.$val_list['Time_S']);
						$status = $val_list['Status'];
						// echo '<pre>';print_r($formvalues['temp_name'].' Gen1_Temp');
						//echo '<pre>';print_r();exit;
						$temp_value = isset($val_list[$formvalues['temp_name']])?$val_list[$formvalues['temp_name']]:0;
						/** less then 1 hour for current time then it's gray color*/
						if($device_time > $curr_time)
						{
							$gray = $temp_value;
						}
						elseif(in_array($status,$green_array))
						{
							$green= $temp_value;
						}elseif(in_array($status,$blue_array)){
							$blue = $temp_value;
						}elseif(in_array($status,$red_array)){
							$red = $temp_value;
						}
						$data[] = array('hours'=>$val_list['Time_S'],'green'=>$green,'red'=>$red,'blue'=>$blue,'gray'=>$gray);
					}
				}
				
			}
			/* $data['green'] = $green;
			$data['red']= $red;
			$data['blue']= $blue;
			$data['gray']= $gray; */
			$message	=	array('valid'=>$data);
		}else{
			$message	=	array('invalid'=>validation_errors());
		}
		
		echo json_encode($message);die;

	}
}
?>
