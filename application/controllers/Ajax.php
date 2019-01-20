<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
                                          
class Ajax extends CI_Controller {
 
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
			echo json_encode(array('session'=>'expired'));exit;	
		}
		
		
	}
 
	function ajax_temp_analysis() {
		$this->form_validation->set_rules('device_name[]', 'device name', 'required');
		$this->form_validation->set_rules('temp_name', 'Temp name', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$data = array();
		if ($this->form_validation->run() == TRUE)
		{
			$formvalues	=	$this->input->post();
			$device_list = $this->Common_model->getDeviceList($formvalues['device_name']);
			$j=0;
			$listInfo['device'] = array();
			foreach($device_list as $list)
			{
				$date = date('Y-m-d', strtotime($formvalues['date']));
				$search = array('order' =>'ASC','start_date'=>$date,'end_date'=>$date);
				$val	=	$this->Common_model->get_device_data_Info( $list->Format_Type, $list->IMEI,$search );
				// echo "<pre>"; print_r($val); exit;
				if(!empty($val))
				{
					$i=0;
					//$random_color = str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
					//$color = '#'.$random_color.$random_color.$random_color;
					
					$listInfo['dataValue'][$j] = array('seriesname'=>$list->Device_Name);
					foreach($val as $val_list)
					{
						$status = $val_list['Status'];
						$temp_value = isset($val_list[$formvalues['temp_name']])?$val_list[$formvalues['temp_name']]:'';

						// $listInfo['dataLabel'][$i]['label'] =$val_list['Time_S'];
						$listInfo['dataValue'][$j]['data'][$i]['value'] = $temp_value;
						// echo $temp_value;
						$i++;
						
					}
					//$data[$list->Device_Name]['color'][] = $color;

					// echo '<pre>'; print_r($listInfo);  exit;
				}
				$j++;
			}

			if(!empty($listInfo['dataValue'])){
				$message	=	array('dataValue'=>$listInfo['dataValue'] );
			} else {
				$message	=	array('invalid'=>validation_errors());
			}
		}else{
			$message	=	array('invalid'=>validation_errors());
		}
		
		echo json_encode($message);die;

	}

	function ajax_power_curve() {
		$this->form_validation->set_rules('device_name[]', 'device name', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$data = array();
		if ($this->form_validation->run() == TRUE)
		{
			$formvalues	=	$this->input->post();
			$device_list = $this->Common_model->getDeviceList($formvalues['device_name']);
			$i=0;

			foreach($device_list as $list)
			{
				$date = date('Y-m-d', strtotime($formvalues['date']));
				$search = array('order' =>'ASC','start_date'=>$date,'end_date'=>$date);
				$val	=	$this->Common_model->get_device_data_Info( $list->Format_Type, $list->IMEI,$search );

				if(!empty($val))
				{
					$j=0;
					$random_color = str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
					$data[$list->Device_Name][0] = array('seriesname'=>'windspeed');
					$data[$list->Device_Name][1] = array('seriesname'=>'power');
					$color = '#'.$random_color.$random_color.$random_color;
					foreach($val as $val_list)
					{
						$windspeed = isset($val_list['Windspeed'])?$val_list['Windspeed']:'';

						//$data[$list->Device_Name]['windSpeed'][] = $windspeed;
						$power = isset($val_list['Power'])?$val_list['Power']:'';
						// $data[$list->Device_Name]['power'][] = $power;

						$data[$list->Device_Name][0]['data'][$j]['value'] = $windspeed;
						$data[$list->Device_Name][1]['data'][$j]['value'] = $power;
						$j++;
					}
				}
				$i++;
			}
			$message	=	$data;
		}else{
			$message	=	array('invalid'=>validation_errors());
		}
		
		echo json_encode($message);die;

	}

	function ajax_perform_analysis() {
		$this->form_validation->set_rules('device_name[]', 'device name', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$data = array();
		if ($this->form_validation->run() == TRUE)
		{
			$formvalues	=	$this->input->post();
			$device_list = $this->Common_model->getDeviceList($formvalues['device_name']);
			foreach($device_list as $list)
			{
				$date = date('Y-m-d', strtotime($formvalues['date']));
				$search = array('order' =>'ASC','start_date'=>$date,'end_date'=>$date);
				$val	=	$this->Common_model->get_device_data_details( $list->Format_Type, $list->IMEI,$search );
				
				$search1 = array('order' =>'DESC','start_date'=>$date,'end_date'=>$date);
				$val	=	$this->Common_model->get_device_data_details( $list->Format_Type, $list->IMEI,$search1 );
				if(!empty($val))
				{
					$random_color = str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
					$color = '#'.$random_color.$random_color.$random_color;
					$pat_gen2 = isset($val->PAT_Gen2)?$val->PAT_Gen2:'';
					$data[$list->Device_Name]['value'][] = $pat_gen2;
					$data[$list->Device_Name]['color'][] = $color;
				}
				
			}
			$message	=	array('valid'=>$data);
		}else{
			$message	=	array('invalid'=>validation_errors());
		}
		
		echo json_encode($message);die;

	}
}
?>
