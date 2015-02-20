<?php
class Tasks extends CI_Model {
	public $table = 'tasks';

    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
    
    
}