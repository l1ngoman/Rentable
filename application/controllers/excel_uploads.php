<?php
// *************************************************
// * File Name: excel_uploads.php
// *************************************************
// * Authors:
// *
// * Andrew T. Garrett
// *
// *************************************************
// * Description:
// *
// * Controller file for all excel upload views
// *************************************************

class Excel_Uploads extends CI_Controller 
{

	public function Master()
	{
        $this->load->view('excel_uploads/master.php');
    }

}
