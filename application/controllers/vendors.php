<!--
*************************************************
* File Name: vendors.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* 
*************************************************
-->
<?php
class Vendors extends CI_Controller 
{

	public function VendorList()
	{
		$Company_ID = 1;

		$this->load->helper('Format');
		$this->load->model('Vendor_DB');

		$VendorArray = $this->Vendor_DB->GetVendorList($Company_ID);

		$this->load->view('templates/header.php');
		$this->load->view('vendors/index.php', array(
			'VendorArray' => $VendorArray,
		));
	}
	
	public function NewVendor()
	{
		$this->load->helper('format');

		$VendorInfo = array(
			'Vendor_Name' => '',
			'Phone' => '',
			'Fax' => '',
			'Vendor_Address_1' => '',
			'Vendor_Address_2' => '',
			'Vendor_City' => '',
			'Vendor_State' => '',
			'Vendor_Zip' => '',
			'Vendor_Country' => 'USA',
			'Website' => '',
			'Vendor_Notes' => '',
			'Company_ID' => '',
			'User_ID' => '',
		);

		$FormInfo = array(
			'PageTitle' => 'New Vendor',
			'ButtonTitle' => 'Add New Vendor',
			'Action' => '/index.php/vendors/SubmitNewVendorData',
		);

		$this->load->view('templates/header.php');
		$this->load->view('vendors/form.php', array(
			'VendorInfo' => $VendorInfo,
			'FormInfo' => $FormInfo
		));
	}

	public function EditVendor($Vendor_ID)
	{
		$Company_ID = 1;

		$this->load->helper('format');
		$this->load->model('Vendor_DB');
		
		$VendorInfo = $this->Vendor_DB->GetVendorByID($Vendor_ID, $Company_ID);

		$FormInfo = array(
			'PageTitle' => 'Edit Vendor',
			'ButtonTitle' => 'Update Vendor Info',
			'Action' => '/index.php/vendors/EditVendorData/'.$Vendor_ID,
		);

		$this->load->view('templates/header.php');
		$this->load->view('vendors/form.php', array(
			'VendorInfo' => $VendorInfo[0],
			'FormInfo' => $FormInfo
		));
	}

	public function SubmitNewVendorData()
	{
		$Company_ID = 1;
		$User_ID = 2;

		$this->load->helper('format');
		$this->load->model('Vendor_DB');

		$Vendor_Name = 		$this->input->post('Vendor_Name');
		$Vendor_Address_1 = $this->input->post('Vendor_Address_1');
		$Vendor_Address_2 = $this->input->post('Vendor_Address_2');
		$Vendor_City = 		$this->input->post('Vendor_City');
		$Vendor_State = 	$this->input->post('Vendor_State');
		$Vendor_Zip = 		$this->input->post('Vendor_Zip');
		$Vendor_Country = 	$this->input->post('Vendor_Country');
		$Phone = 			$this->input->post('Phone');
		$Fax = 				$this->input->post('Fax');
		$Website = 			$this->input->post('Website');
		$Vendor_Notes = 	$this->input->post('Vendor_Notes');

		$this->Vendor_DB->InsertNewVendorData($Vendor_Name, $Vendor_Address_1, $Vendor_Address_2, 
			$Vendor_City, $Vendor_State, $Vendor_Zip, $Vendor_Country, $Phone, $Fax, $Website, 
			$Vendor_Notes, $Company_ID, $User_ID);

			echo '<script>window.location.href = "/index.php/vendors/VendorList";</script>';
	}
	
	public function EditVendorData($Vendor_ID)
	{
		$Company_ID = 1;

		$this->load->helper('format');
		$this->load->model('Vendor_DB');

		$Vendor_Name = 		trim(htmlspecialchars($this->input->post('Vendor_Name'), ENT_QUOTES));
		$Vendor_Address_1 = trim(htmlspecialchars($this->input->post('Vendor_Address_1'), ENT_QUOTES));
		$Vendor_Address_2 = trim(htmlspecialchars($this->input->post('Vendor_Address_2'), ENT_QUOTES));
		$Vendor_City = 		trim(htmlspecialchars($this->input->post('Vendor_City'), ENT_QUOTES));
		$Vendor_State = 	trim(htmlspecialchars($this->input->post('Vendor_State'), ENT_QUOTES));
		$Vendor_Zip =		trim(htmlspecialchars($this->input->post('Vendor_Zip'), ENT_QUOTES));
		$Phone = 			trim(htmlspecialchars($this->input->post('Phone'), ENT_QUOTES));
		$Fax = 				trim(htmlspecialchars($this->input->post('Fax'), ENT_QUOTES));
		$Vendor_Notes = 	trim(htmlspecialchars($this->input->post('Vendor_Notes'), ENT_QUOTES));
		$Website = 			trim(htmlspecialchars($this->input->post('Website'), ENT_QUOTES));
		$Active = 1;

		$this->Vendor_DB->UpdateVendorData($Vendor_Name, $Vendor_Address_1, $Vendor_Address_2, 
			$Vendor_City, $Vendor_State, $Vendor_Zip, $Phone, $Fax, $Vendor_Notes, $Website, $Company_ID, $Vendor_ID, $Active);

		echo '<script>window.location.href = "/index.php/vendors/VendorList";</script>';
	}
}