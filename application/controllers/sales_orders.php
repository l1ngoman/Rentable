<!--
*************************************************
* File Name: sales_orders.php
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
class Sales_Orders extends CI_Controller 
{

	public function SalesOrderList()
	{
		$Company_ID = 1;

		$this->load->helper('Format');
		$this->load->model('Sales_Order_DB');

		$SalesOrderArray = $this->Sales_Order_DB->GetSalesOrderList($Company_ID);

		$this->load->view('templates/header.php');
		$this->load->view('sales_orders/index.php', array(
			'SalesOrderArray' => $SalesOrderArray,
		));
	}
	
	public function NewSalesOrder()
	{
		$Company_ID = 1;

		$this->load->helper('format');
		$this->load->model('Sales_Order_DB');
		$this->load->model('Item_DB');

		$Today = Helper_GetTodaysDate($Company_ID);

		$CustomerList = $this->Sales_Order_DB->GetCustomerList($Company_ID);
		$ItemList = $this->Item_DB->GetItemList($Company_ID);

		$SalesOrderInfo = array(
			'Customer_ID' => '',
			'Subtotal_Amount' => '',
			'Tax_Amount' => '',
			'Total_Amount' => '',
			'Total_Taxable' => '',
			'Total_NonTaxable' => '',
			'SO_Notes' => '',
			'SO_TimeStamp' => '',
		);

		$FormInfo = array(
			'PageTitle' => 'New Sales Order',
			'ButtonTitle' => 'Create New Order',
			'Action' => '/index.php/sales_orders/SubmitNewSalesOrderData',
			'FormID' => 'AddNewSalesOrderForm'
		);

		$this->load->view('templates/header.php');
		$this->load->view('sales_orders/form.php', array(
			'SalesOrderInfo' => $SalesOrderInfo,
			'FormInfo' => $FormInfo,
			'CustomerList' => $CustomerList,
			'ItemList' => $ItemList,
			'Today' => $Today,
		));
	}

	// public function EditCustomer($Customer_ID)
	// {
	// 	$Company_ID = 1;

	// 	$this->load->helper('format');
	// 	$this->load->model('Customer_DB');
		
	// 	$CustomerInfo = $this->Customer_DB->GetCustomerByID($Customer_ID, $Company_ID);

	// 	$FormInfo = array(
	// 		'PageTitle' => 'Edit Customer',
	// 		'ButtonTitle' => 'Update Customer Info',
	// 		'Action' => '/index.php/customers/EditCustomerData/'.$Customer_ID,
	// 	);

	// 	$this->load->view('templates/header.php');
	// 	$this->load->view('customers/form.php', array(
	// 		'CustomerInfo' => $CustomerInfo[0],
	// 		'FormInfo' => $FormInfo
	// 	));
	// }

	public function SubmitNewSalesOrderData()
	{
		$Company_ID = 1;
		$User_ID = 2;

		$this->load->helper('format');
		$this->load->model('Sales_Order_DB');
		$this->load->model('Company_DB');
		$this->load->model('Item_DB');
		echo "<pre>";
		var_dump($_POST);
		echo "</pre>";

		// ATG:: GET COMPANY'S SALES TAX RATE
		$Tax_Rate_Array = $this->Company_DB->GetSalesTaxRate($Company_ID);
		$Tax_Rate = $Tax_Rate_Array[0]['Sales_Tax_Rate'] / 100;

		$Line_Items = array();
		$Customer_ID = 			$this->input->post('Customer_ID');
		$SO_Notes = 			$this->input->post('SO_Notes');
		$NumberOfEntries = 		$this->input->post('NumberOfEntries');

		$Subtotal_Amount = 0.00;
		$Tax_Amount = 0.00;
		$Total_Amount = 0.00;
		$Total_Taxable = 0.00;
		$Total_NonTaxable = 0.00;


		for ($i = 0; $i < sizeof($NumberOfEntries); $i++) 
		{			
			$Item_ID = 				$this->input->post('Item_ID'.$i);
			$SO_Item_Quantity =		$this->input->post('SO_Item_Quantity'.$i);
			$SO_Item_Amount = 		$this->input->post('SO_Item_Amount'.$i);
			$SO_Extended_Amount = 	$this->input->post('SO_Extended_Amount'.$i);
			$SO_Item_Notes = 		$this->input->post('SO_Item_Notes'.$i);
			$SO_Item_Tax = 0.00;

			// ATG:: QUERY ITEM ID TO SEE IF ITEM IS TAXABLE
			$Item_Taxable_Array = $this->Item_DB->GetItemTaxStatus($Item_ID);
			$Item_Taxable = $Item_Taxable_Array[0]['Taxable_Status'];

			$Subtotal_Amount += $SO_Extended_Amount;

			// ATG:: 1 = TAXABLE; 0 = NON-TAXABLE
			if($Taxable_Status == 1)
			{
				$SO_Item_Tax = $SO_Item_Amount * $Tax_Rate;
				$Tax_Amount += $SO_Item_Tax;
				$Total_Taxable += $SO_Extended_Amount;
			}
			if($Taxable_Status == 0)
			{
				$Total_NonTaxable += $SO_Extended_Amount;
			}

			// won't have so id until we do insert
			array_push($Line_Items, array(
				'Item_ID' => $Item_ID,
				'SO_Item_Quantity' => $SO_Item_Quantity,
				'SO_Item_Amount' => $SO_Item_Amount,
				'SO_Item_Tax' => $SO_Item_Tax,
				'SO_Item_Notes' => $SO_Item_Notes
			));
		}


		// $this->Sales_Order_DB->InsertNewSalesOrderData($Customer_ID, $SO_Notes, $Item_ID, $SO_Item_Quantity, 
		// 	$SO_Item_Amount, $SO_Extended_Amount, $Company_ID, $User_ID);

		// 	echo '<script>window.location.href = "/index.php/customers/CustomerList";</script>';
	}
	
	// public function EditCustomerData($Customer_ID)
	// {
	// 	$Company_ID = 1;

	// 	$this->load->helper('format');
	// 	$this->load->model('Customer_DB');

	// 	$First_Name = 			trim(htmlspecialchars($this->input->post('First_Name'), ENT_QUOTES));
	// 	$Last_Name = 			trim(htmlspecialchars($this->input->post('Last_Name'), ENT_QUOTES));
	// 	$Billing_Address_1 = 	trim(htmlspecialchars($this->input->post('Billing_Address_1'), ENT_QUOTES));
	// 	$Billing_Address_2 = 	trim(htmlspecialchars($this->input->post('Billing_Address_2'), ENT_QUOTES));
	// 	$Billing_City = 		trim(htmlspecialchars($this->input->post('Billing_City'), ENT_QUOTES));
	// 	$Billing_State = 		trim(htmlspecialchars($this->input->post('Billing_State'), ENT_QUOTES));
	// 	$Billing_Zip =			trim(htmlspecialchars($this->input->post('Billing_Zip'), ENT_QUOTES));
	// 	$Delivery_Address_1 = 	trim(htmlspecialchars($this->input->post('Delivery_Address_1'), ENT_QUOTES));
	// 	$Delivery_Address_2 = 	trim(htmlspecialchars($this->input->post('Delivery_Address_2'), ENT_QUOTES));
	// 	$Delivery_City = 		trim(htmlspecialchars($this->input->post('Delivery_City'), ENT_QUOTES));
	// 	$Delivery_State = 		trim(htmlspecialchars($this->input->post('Delivery_State'), ENT_QUOTES));
	// 	$Delivery_Zip = 		trim(htmlspecialchars($this->input->post('Delivery_Zip'), ENT_QUOTES));
	// 	$Phone_1 = 				trim(htmlspecialchars($this->input->post('Phone_1'), ENT_QUOTES));
	// 	$Phone_2 = 				trim(htmlspecialchars($this->input->post('Phone_2'), ENT_QUOTES));
	// 	$Notes = 				trim(htmlspecialchars($this->input->post('Notes'), ENT_QUOTES));
	// 	$Active = 1;

	// 	$this->Customer_DB->UpdateCustomerData($First_Name, $Last_Name, $Billing_Address_1, $Billing_Address_2, 
	// 		$Billing_City, $Billing_State, $Billing_Zip, $Delivery_Address_1, $Delivery_Address_2, 
	// 		$Delivery_City, $Delivery_State, $Delivery_Zip, $Phone_1, $Phone_2, $Notes, $Company_ID, $Customer_ID, $Active);

	// 	echo '<script>window.location.href = "/index.php/customers/CustomerList";</script>';
	// }
}