<!--
*************************************************
* File Name: customers.php
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
class Customers extends CI_Controller 
{

	public function CustomerList()
	{
		$Company_ID = 1;

		$this->load->helper('Format');
		$this->load->model('Customer_DB');

		$CustomerArray = $this->Customer_DB->GetCustomerList($Company_ID);

		$this->load->view('templates/header.php');
		$this->load->view('customers/index.php', array(
			'CustomerArray' => $CustomerArray,
		));
	}
	
	public function NewCustomer()
	{
		$this->load->helper('format');

		$CustomerInfo = array(
			'First_Name' => '',
			'Last_Name' => '',
			'Phone_1' => '',
			'Phone_2' => '',
			'Billing_Address_1' => '',
			'Billing_Address_2' => '',
			'Billing_City' => '',
			'Billing_State' => '',
			'Billing_Zip' => '',
			'Delivery_Address_1' => '',
			'Delivery_Address_2' => '',
			'Delivery_City' => '',
			'Delivery_State' => '',
			'Delivery_Zip' => '',
			'Notes' => '',
			'Customer_ID' => ''
		);

		$FormInfo = array(
			'PageTitle' => 'New Customer',
			'ButtonTitle' => 'Add New Customer',
			'Action' => '/index.php/customers/SubmitNewCustomerData',
		);

		$this->load->view('templates/header.php');
		$this->load->view('customers/form.php', array(
			'CustomerInfo' => $CustomerInfo,
			'FormInfo' => $FormInfo
		));
	}

	public function EditCustomer($Customer_ID)
	{
		$Company_ID = 1;

		$this->load->helper('format');
		$this->load->model('Customer_DB');
		
		$CustomerInfo = $this->Customer_DB->GetCustomerByID($Customer_ID, $Company_ID);

		$FormInfo = array(
			'PageTitle' => 'Edit Customer',
			'ButtonTitle' => 'Update Customer Info',
			'Action' => '/index.php/customers/EditCustomerData/'.$Customer_ID,
		);

		$this->load->view('templates/header.php');
		$this->load->view('customers/form.php', array(
			'CustomerInfo' => $CustomerInfo[0],
			'FormInfo' => $FormInfo
		));
	}

	public function SubmitNewCustomerData()
	{
		$Company_ID = 1;
		$User_ID = 2;

		$this->load->helper('format');
		$this->load->model('Customer_DB');

		$First_Name = 			$this->input->post('First_Name');
		$Last_Name = 			$this->input->post('Last_Name');
		$Billing_Address_1 = 	$this->input->post('Billing_Address_1');
		$Billing_Address_2 = 	$this->input->post('Billing_Address_2');
		$Billing_City = 		$this->input->post('Billing_City');
		$Billing_State = 		$this->input->post('Billing_State');
		$Billing_Zip = 			$this->input->post('Billing_Zip');
		$Billing_Country = 		$this->input->post('Billing_Country');
		$Delivery_Address_1 = 	$this->input->post('Delivery_Address_1');
		$Delivery_Address_2 = 	$this->input->post('Delivery_Address_2');
		$Delivery_City = 		$this->input->post('Delivery_City');
		$Delivery_State = 		$this->input->post('Delivery_State');
		$Delivery_Zip = 		$this->input->post('Delivery_Zip');
		$Delivery_Country = 	$this->input->post('Delivery_Country');
		$Phone_1 = 				$this->input->post('Phone_1');
		$Phone_2 = 				$this->input->post('Phone_2');
		$Notes = 				$this->input->post('Notes');

		$this->Customer_DB->InsertNewCustomerData($First_Name, $Last_Name, $Billing_Address_1, $Billing_Address_2, 
			$Billing_City, $Billing_State, $Billing_Zip, $Billing_Country, $Delivery_Address_1, $Delivery_Address_2, 
			$Delivery_City, $Delivery_State, $Delivery_Zip, $Delivery_Country, $Phone_1, $Phone_2, $Notes, $Company_ID, $User_ID);

			echo '<script>window.location.href = "/index.php/customers/CustomerList";</script>';
	}
	
	public function EditCustomerData($Customer_ID)
	{
		$Company_ID = 1;

		$this->load->helper('format');
		$this->load->model('Customer_DB');

		$First_Name = 			trim(htmlspecialchars($this->input->post('First_Name'), ENT_QUOTES));
		$Last_Name = 			trim(htmlspecialchars($this->input->post('Last_Name'), ENT_QUOTES));
		$Billing_Address_1 = 	trim(htmlspecialchars($this->input->post('Billing_Address_1'), ENT_QUOTES));
		$Billing_Address_2 = 	trim(htmlspecialchars($this->input->post('Billing_Address_2'), ENT_QUOTES));
		$Billing_City = 		trim(htmlspecialchars($this->input->post('Billing_City'), ENT_QUOTES));
		$Billing_State = 		trim(htmlspecialchars($this->input->post('Billing_State'), ENT_QUOTES));
		$Billing_Zip =			trim(htmlspecialchars($this->input->post('Billing_Zip'), ENT_QUOTES));
		$Delivery_Address_1 = 	trim(htmlspecialchars($this->input->post('Delivery_Address_1'), ENT_QUOTES));
		$Delivery_Address_2 = 	trim(htmlspecialchars($this->input->post('Delivery_Address_2'), ENT_QUOTES));
		$Delivery_City = 		trim(htmlspecialchars($this->input->post('Delivery_City'), ENT_QUOTES));
		$Delivery_State = 		trim(htmlspecialchars($this->input->post('Delivery_State'), ENT_QUOTES));
		$Delivery_Zip = 		trim(htmlspecialchars($this->input->post('Delivery_Zip'), ENT_QUOTES));
		$Phone_1 = 				trim(htmlspecialchars($this->input->post('Phone_1'), ENT_QUOTES));
		$Phone_2 = 				trim(htmlspecialchars($this->input->post('Phone_2'), ENT_QUOTES));
		$Notes = 				trim(htmlspecialchars($this->input->post('Notes'), ENT_QUOTES));
		$Active = 1;

		$this->Customer_DB->UpdateCustomerData($First_Name, $Last_Name, $Billing_Address_1, $Billing_Address_2, 
			$Billing_City, $Billing_State, $Billing_Zip, $Delivery_Address_1, $Delivery_Address_2, 
			$Delivery_City, $Delivery_State, $Delivery_Zip, $Phone_1, $Phone_2, $Notes, $Company_ID, $Customer_ID, $Active);

		echo '<script>window.location.href = "/index.php/customers/CustomerList";</script>';
	}
}