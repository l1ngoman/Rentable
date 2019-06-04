<!--
*************************************************
* File Name: Company.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* This controller is for setup only and should only
* be accessible by adminstrators.
*************************************************
<?php

	class Company extends CI_Controller {

		public function NewCompany()
		{
			$this->load->view('company/new.php');
		}

		public function SubmitNewCompanyData()
		{
			$this->load->model('Company_DB');

			$Company_Name = $this->input->post('Company_Name');
			$Address_1 = $this->input->post('Address_1');
			$Address_2 = $this->input->post('Address_2');
			$City = $this->input->post('City');
			$State = $this->input->post('State');
			$Zip = $this->input->post('Zip');
			$Country = $this->input->post('Country');
			$Phone = $this->input->post('Phone');
			$Fax = $this->input->post('Fax');
			$Website = $this->input->post('Website');
			$Sales_Tax_Rate = $this->input->post('Sales_Tax_Rate');

			$this->Company_DB->InsertNewCompanyData($Company_Name, $Address_1, $Address_2, $City, $State, $Zip, $Country, $Phone, $Fax, $Website, $Sales_Tax_Rate);

			return header("Location: /");
		}
	}
?>