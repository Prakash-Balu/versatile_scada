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
		// echo "<pre>";print_r($type_list); exit;
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
			$alarmCount = 0;
			$unresDevList =array();
			$recentAlarmDevList = array();
			$deviceDownTime = array();
			foreach($type_list as $list)
			{
				$val	=	$this->Common_model->get_device_details( $list->Format_Type, $list->IMEI );
				$date = date('Y-m-d');//current date
				$search = array('start_date'=>$date,'end_date'=>$date);
				$val1	=	$this->Common_model->get_device_data_Info( $list->Format_Type, $list->IMEI,$search );
				$error_info = $this->Common_model->get_error_data_Info( $list->Format_Type, $list->IMEI,$search );
				$search1 = array('order' =>'DESC','limit'=>1);
				$error_info1 = $this->Common_model->get_error_data_Info( $list->Format_Type, $list->IMEI,$search1 );
				$alarmCount += count($error_info);
				$color = '';
				
				if(!empty($error_info1)) {
					$recentAlarmDevList[$list->Device_Name] = $error_info1[0]['Status'];
				}

				if(!empty($val))
				{
					/** get current time from DB and then check device date is less then 1 hour for current time */
					$query = $this->db2->query('select (NOW() - INTERVAL 2 HOUR) as curr_time', TRUE);
					$curr_time = strtotime($query->row()->curr_time);

					$device_time = strtotime($val->Date_S.' '.$val->Time_S);
					/** less then 1 hour for current time then it's gray color*/
					
					$unresTime = $device_time + 86400;
					if($unresTime > $curr_time) {
						$unresDevList[] = $list->Device_Name;
					}

					$datetime1 = new DateTime("@$curr_time");
				    $datetime2 = new DateTime("@$device_time");
				    $interval = $datetime1->diff($datetime2);
				    $deviceDownTime[] = $interval->format('%Hh');
    				
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
				} else {
					$gray[] = $val;
				}


				$data['device_list'][trim($list->Device_Name)][] = $color;
				if(!empty($val1))
				{

					/** get current time from DB and then check device date is less then 1 hour for current time */
					$query = $this->db2->query('select (NOW() - INTERVAL 2 HOUR) as curr_time', TRUE);
					$curr_time = strtotime($query->row()->curr_time);

					foreach ($val1 as $key => $value) {
							
						$device_time = strtotime($value['Date_S'].' '.$value['Time_S']);
						/** less then 1 hour for current time then it's gray color*/
						
						if($device_time > $curr_time)
						{
							$color = 'gray';
						}
						elseif(in_array($value['Status'],$green_array))
						{
							$color = 'green';
						}elseif(in_array($value['Status'],$blue_array)){
							$color = 'blue';
						}elseif(in_array($value['Status'],$red_array)){
								$color = 'red';
						}
						$data['device_list'][trim($list->Device_Name)][] = $color;
					}
					
				}
				$total_count = $list->cnt;
			}
			//exit;
			$downTime = 0;
			$downTimeDeviceCnt =0;
			if(!empty($deviceDownTime)) {
				foreach($deviceDownTime as $time) {
					$downTime += (int)str_replace('h','',$time);
					$downTimeDeviceCnt++;
				}
			}
			
			$data['response']['green'] = array('count'=> count($green),'name'=>'WTG RUN','total'=>$total_count);
			$data['response']['red']= array('count'=> count($red),'name'=>'WTG ERROR','total'=>$total_count);
			$data['response']['blue']= array('count'=> count($blue),'name'=>'WTG GRID DROP','total'=>$total_count);
			$data['response']['gray']= array('count'=> count($gray),'name'=>'WTG SCADA OFF','total'=>$total_count);
			
		}

		
		$data['avgWindSpeed'] = $this->session->userdata('avgWindSpeed');
		$data['avgWindSpeedTime'] = $this->session->userdata('avgWindSpeedTime');
		$data['powerSpeed'] = $this->session->userdata('powerSpeed');
		$data['patGen'] = $this->session->userdata('patGen');
		$data['avgWindSpeedSum'] = $this->session->userdata('avgWindSpeedSum');
		$data['powerSpeedSum'] = $this->session->userdata('powerSpeedSum');
		$data['patGenSum'] = $this->session->userdata('patGenSum');
		$data['notify']['downTimeTtl'] = (string)($downTime/$downTimeDeviceCnt ).' hrs';
		$data['notify']['alarmCount'] = $alarmCount;
		$data['notify']['unresDevList'] = $unresDevList;
		$data['notify']['recentAlarmDevList'] = $recentAlarmDevList;
	//echo "<pre>";print_r($data['notify']); exit;
		$this->load->view('dashboard/index',$data);
	}
	
	function park_view() {
		$device_info=$top_data=$footer_data=$footer =$device_data=array();
		$region_list = $this->Common_model->get_region_site_list();
		if(!empty($region_list))
			{
			foreach($region_list as $list)
			{
				$date =  date('Y-m-d');//current date'2018-08-14';
				$search = array('order' =>'DESC','start_date'=>$date,'end_date'=>$date);
				$search1 = array('order' =>'DESC','start_date'=>$date,'end_date'=>$date,'limit'=>5);
				$device_info = (array)$this->Common_model->get_device_data_details( $list['Format_Type'], $list['IMEI'], $search );
				$error_info = (array)$this->Common_model->get_error_data_Info( $list['Format_Type'], $list['IMEI'], $search1 );
				
				if( !empty($device_info) ) {
					$device_info['Device_Name']= $list['Device_Name'];
					$device_info['LOC_No']= $list['LOC_No'];
					$device_info['capacity']= $list['capacity'];
					$device_info['Connect_Feeder']= $list['Connect_Feeder'];
					$device_info['Format_Type'] = $list['Format_Type'];
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
		//echo '<pre>';print_r($device_data);exit;
	 	$data['regions'] = $top_data;
		$data['regionDeviceData'] = $device_data;
		$data['footer_data'] = $footer;
		$this->load->view('dashboard/park_view', $data);
	}

	function device_view() 
	{
		$device_info=$top_data=$footer_data=$footer =$device_data=array();
		$avg_speed=$event_log=$power_curve=$list=array();
		if(!empty($_REQUEST['d'] ))
		{
			$list = $this->Common_model->get_device_list_by_given_imei( $_REQUEST['d']);
			$green_array = array('Run', 'RUN', 'M/C Running', 'M/C Running');
            $blue_array = array('GRIDDROP', 'griddrop', 'Grid Drop', 'Grid Drop');
            $red_array = array_merge($green_array,$blue_array);
			
			$avg_speed=$event_log=array();
			$date =  date('Y-m-d');//current date'2018-08-14';
			$search = array('order' =>'DESC'); //,'start_date'=>$date,'end_date'=>$date
			$search1 = array('order' =>'DESC', 'limit'=>5);//,'start_date'=>$date,'end_date'=>$date,
			$device_info = (array)$this->Common_model->get_device_data_details( $list['Format_Type'], $list['IMEI'], $search );
			$error_info = (array)$this->Common_model->get_error_data_Info( $list['Format_Type'], $list['IMEI'], $search1 );

			$search2 = array('order' =>'DESC','start_date'=>$date,'end_date'=>$date);
			$current_status = (array)$this->Common_model->get_device_data_details( $list['Format_Type'], $list['IMEI'], $search2 );
			
			$color = 'gray.png';
			if(!empty($current_status))
			{
				/** get current time from DB and then check device date is less then 1 hour for current time */
				$query = $this->db2->query('select (NOW() - INTERVAL 2 HOUR) as curr_time', TRUE);
				$curr_time = strtotime($query->row()->curr_time);

				$device_time = strtotime($current_status['Date_S'].' '.$current_status['Time_S']);
				/** less then 1 hour for current time then it's gray color*/
				
				if(in_array($current_status['Status'],$green_array))
				{
					$color = 'green.gif';
				}elseif(in_array($current_status['Status'],$blue_array)){
					$color = 'blue.png';
				}elseif(in_array($current_status['Status'],$red_array)){
					$color = 'red.png';
				}
			}
			
			if( !empty($device_info) ) {
				$device_info['Device_Name']= $list['Device_Name'];
				$device_info['LOC_No']= $list['LOC_No'];
				$device_info['capacity']= $list['capacity'];
				$device_info['Connect_Feeder']= $list['Connect_Feeder'];
				$device_info['color'] = $color;
			}
			
			if( !empty($error_info) ) {
				foreach($error_info as $info)
				{
					$event_log[] =array(
															'Date_S'=> !empty($info['Date_S'])?date('d-m-Y',strtotime($info['Date_S'])):'---',
															'Time_S'=> $info['Time_S'],
															'Device_Name'=>$list['Device_Name'],
															'Description'=>$info['Status'],
															'datetime'=> $info['Date_S'].' '.$info['Time_S']
														);
				}
			}
			
			$search_info = array('order' =>'ASC','start_date'=>$date,'end_date'=>$date);
			$val	=	$this->Common_model->get_device_data_Info( $list['Format_Type'], $list['IMEI'],$search_info );
			$power_curve=$power_curve1=array();

			if(!empty($val))
			{
				$j=0;
				$power_curve[0] = array('seriesname'=>'windspeed');
				$power_curve[1] = array('seriesname'=>'power');
				foreach($val as $val_list)
				{
					$windspeed = isset($val_list['Windspeed'])?number_format($val_list['Windspeed'], 2):0;
					$power = isset($val_list['Power'])?number_format($val_list['Power'],2):0;
					$power_curve[0]['data'][$j]['value'] = $windspeed;
					$power_curve[1]['data'][$j]['value'] = $power;
					$power_curve1[] = "[$windspeed, $power]";
					$j++;
				}
			}
			
			$sdate =  date('Y-m-01');//current month start date //'2018-08-01';
			$edate =  date('Y-m-d');//current date //'2018-08-31';
			$search_avg = array('order' =>'ASC','start_date'=>$sdate,'end_date'=>$edate);
			$speed_list	=	$this->Common_model->get_date_wise_device_data_Info( $list['Format_Type'], $list['IMEI'],$search_avg );

			
			if(!empty($speed_list))
			{
				$j=0;
				foreach($speed_list as $speed)
				{
					$windspeed = isset($speed['Windspeed'])?$speed['Windspeed']:'';
					$date_list = !empty($speed['Date_S'])?date('d-m-Y',strtotime($speed['Date_S'])):'---';
					$avg_speed[$date_list] = $windspeed;
					$j++;
				}
			}
		}

	 	$data['regions'] = $list;
		$data['live_status'] = $device_info;
		$data['event_log'] = $event_log;
		$data['power_curve'] = $power_curve;
		$data['power_curve1'] = $power_curve1;
		$data['avg_speed'] = $avg_speed;
		// echo '<pre>';print_r($data);exit;
		$this->load->view('dashboard/device_view',$data);
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
		$device_list = $this->Common_model->get_region_site_list();
		
		$data['perAna']['deviceList'] = $device_list;
		$this->load->view('dashboard/performance_analysis', $data);
	}

	function reports() {
		$device_list = $this->Common_model->get_region_site_list();
		
		$data['reports']['deviceList'] = $device_list;
		$this->load->view('dashboard/reports', $data);
	}

}
?>
