<?php

public function getAllTasks_post(){
    
    $test = $this->post();
    var_dump($test);
    
    $this->response($test, 200);
    $this->response(array('error' => 'missing answer'), 400);
    $method = $_SERVER['REQUEST_METHOD'];
    $this->load->model('User');
	if ($aid == false || $a == false) {
		$this->response(array('error' => 'missing answer'), 400);
	}
	$this->load->Model('Record');
	$r = $this->Record->submitPhotoTrivia($aid, $a); //second param: fbid
	$this->response($r, 200);
    
	if ($this->User->addUser($user_detail)) {
		$this->response(array('status' => 'success'), 200);
	}else{
		// $this->response(array('error' => 'User already added'), 400); //todo
		
		// $this->updateuser_post($this->input->post('access_token'), $user_detail);
		
		$user_detail['agree_sweeps'] = $this->input->post('agree_sweeps');
		$user_detail['agree_weekly'] = $this->input->post('agree_weekly');

		$updateresult = $this->User->updateUser($user_detail);
		if ($updateresult != false) {
			$this->response(
			array(
				'status' => 'success',
				'phase' => $updateresult
			), 200);
		}else{
			$this->response(array('error' => 'no users updated'), 400); //todo
		}
		
	}
    
    
    // header("Access-Control-Allow-Orgin: *");
    // header("Access-Control-Allow-Methods: *");
    // header("Content-Type: application/json");
}
?>