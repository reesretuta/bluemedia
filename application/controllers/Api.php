<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');


class Api extends REST_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    
	public function __construct()
	{	
		parent::__construct();
        $this->load->database();
	}
	public function notes_post()
	{
        $today = date('Y-m-j');
        $this->db->query('insert into notes (title, note, createtime, lastupdatetime) values ("title","note", "'.$today.'", "'.$today.'")');
	}
    
	public function notes_get()
	{
        $noteid = $this->get('noteid');
        $userid = $this->get('userid');
        $result = $this->db->query('select * from notes, users_notes where users_notes.notesid = notes.id and notes.id = ' . $noteid . ' and users_notes.userid = ' . $userid);
        
        //response in JSON
        var_dump($result->result_array());
	}
    
	public function notes_put()
	{
        //should pass notes via /notes/id
        //noteid=1&userid=1&title=newtitle&note=newNotes
        $noteid = $this->put('noteid');
        $userid = $this->put('userid');
        $title = $this->put('title');
        $note = $this->put('note');
        $this->db->query('update notes set title = "'. $title. '", note = "'. $note . '" where id = ' . $noteid);
	}
    
	public function notes_delete($noteid)
	{   
        // http://bluemedia.local/index.php/api/notes/3
        // http://example.com/books?format=json
        $this->db->query('delete from notes where id = '.$noteid);
	}

    //curl -X DELETE http://bluemedia.local/index.php/api/notes/3 -d '{}'
    //curl -X PUT http://http://54.153.14.204//index.php/api/notes/3 -d '{}
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */