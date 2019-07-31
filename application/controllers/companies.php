<?php
// *************************************************
// * File Name: companies.php
// *************************************************
// * Authors:
// *
// * Andrew T. Garrett
// *
// *************************************************
// * Description:
// *
// * This controller is for setup only and should only
// * be accessible by adminstrators.
// *************************************************

    class Companies extends CI_Controller {

		public function NewCompany()
		{
            $this->load->library('ion_Auth');
            if (!$this->ion_auth->logged_in())
            {
              redirect('auth/login');
            }

			$this->load->view('templates/header.php');
			$this->load->view('companies/new.php');
		}

		public function SubmitNewCompanyData()
		{
            $this->load->library('ion_Auth');
            if (!$this->ion_auth->logged_in())
            {
              redirect('auth/login');
            }
            
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

			$New_Company_ID = $this->Company_DB->InsertNewCompanyData($Company_Name, $Address_1, $Address_2, 
				$City, $State, $Zip, $Country, $Phone, $Fax, $Website, $Sales_Tax_Rate);

            // ATG:: CURRENTLY NO ROUTE TO EDIT OR VIEW INDIVIDUAL COMPANIES. WILL FIX LATER
            // header("Location: /index.php/companies/$New_Company_ID");
            header("Location: /index.php");
		}
	}
?>