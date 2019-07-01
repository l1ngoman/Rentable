<!--
*************************************************
* File Name: items.php
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
class Items extends CI_Controller 
{

	public function ItemList()
	{
		$Company_ID = 1;

		$this->load->model('Item_DB');

		$ItemArray = $this->Item_DB->GetItemList($Company_ID);

		$this->load->view('templates/header.php');
		$this->load->view('items/index.php', array(
			'ItemArray' => $ItemArray,
		));
	}
	
	public function NewItem()
	{
		$Company_ID = 1;

		$this->load->model('Item_DB');
		$this->load->helper('format');

		$Today = Helper_GetTodaysDate($Company_ID);

		$ItemInfo = array(
			'Item_Category_ID' => '',
			'Vendor_ID' => '',
			'Item_Name' => '',
			'Part_Number' => '',
			'Serial_Number' => '',
			'Tracking_Number' => '',
			'Status' => '',
			'Date_In_Service' => '',
			'Date_Sold' => '',
			'Taxable_Status' => '',
		);

		$FormInfo = array(
			'PageTitle' => 'New Item',
			'FormID' => 'NewItemForm',
			'ButtonTitle' => 'Add New Item',
			'Action' => '/index.php/items/SubmitNewItemData',
		);

		$VendorList = $this->Item_DB->GetVendorList($Company_ID);
		$ItemCategoryList = $this->Item_DB->GetItemCategoryList($Company_ID);

		$this->load->view('templates/header.php');
		$this->load->view('items/form.php', array(
			'ItemInfo' => $ItemInfo,
			'FormInfo' => $FormInfo,
			'VendorList' => $VendorList,
			'ItemCategoryList' => $ItemCategoryList,
			'Today' => $Today,
		));
	}

	public function EditItem($Item_ID)
	{
		$Company_ID = 1;

		$this->load->model('Item_DB');
		$this->load->helper('format');

		$Today = Helper_GetTodaysDate($Company_ID);
		
		$ItemInfo = $this->Item_DB->GetItemByID($Item_ID, $Company_ID);
		$VendorList = $this->Item_DB->GetVendorList($Company_ID);
		$ItemCategoryList = $this->Item_DB->GetItemCategoryList($Company_ID);

		$FormInfo = array(
			'PageTitle' => 'Edit Item',
			'FormID' => 'EditItemForm',
			'ButtonTitle' => 'Update Item Info',
			'Action' => '/index.php/items/EditItemData/'.$Item_ID,
		);

		$this->load->view('templates/header.php');
		$this->load->view('items/form.php', array(
			'ItemInfo' => $ItemInfo[0],
			'FormInfo' => $FormInfo,
			'VendorList' => $VendorList,
			'ItemCategoryList' => $ItemCategoryList,
			'Today' => $Today,
		));
	}

	public function SubmitNewItemData()
	{
		$Company_ID = 1;
		$User_ID = 2;

		$this->load->model('Item_DB');

		$Item_Category_ID = $this->input->post('Item_Category_ID');
		$Vendor_ID = 		$this->input->post('Vendor_ID');
		$Item_Name = 		$this->input->post('Item_Name');
		$Part_Number = 		$this->input->post('Part_Number');
		$Serial_Number = 	$this->input->post('Serial_Number');
		$Tracking_Number = 	$this->input->post('Tracking_Number');
		$Status = 			$this->input->post('Status');
		$Date_In_Service = 	$this->input->post('Date_In_Service');
		$Taxable_Status = 	$this->input->post('Taxable_Status');

		// ATG:: IF USER LEFT DATE IN SERVICE BLANK, SET IT TO NOW
		if($Date_In_Service == NULL)
		{
			$Date_In_Service = date('Y-m-d H:i:s');
		}

		$this->Item_DB->InsertNewItemData($Item_Category_ID, $Vendor_ID, $Item_Name, $Part_Number, $Serial_Number, 
			$Tracking_Number, $Status, $Date_In_Service, $Taxable_Status, $Company_ID, $User_ID);

		echo '<script>window.location.href = "/index.php/items/ItemList";</script>';
	}
	
	public function EditItemData($Item_ID)
	{
		$Company_ID = 1;

		$this->load->helper('format');
		$this->load->model('Item_DB');

		$Item_Category_ID = 			trim(htmlspecialchars($this->input->post('Item_Category_ID'), ENT_QUOTES));
		$Vendor_ID = 			trim(htmlspecialchars($this->input->post('Vendor_ID'), ENT_QUOTES));
		$Item_Name = 	trim(htmlspecialchars($this->input->post('Item_Name'), ENT_QUOTES));
		$Part_Number = 	trim(htmlspecialchars($this->input->post('Part_Number'), ENT_QUOTES));
		$Serial_Number = 		trim(htmlspecialchars($this->input->post('Serial_Number'), ENT_QUOTES));
		$Tracking_Number = 		trim(htmlspecialchars($this->input->post('Tracking_Number'), ENT_QUOTES));
		$Date_In_Service = 	trim(htmlspecialchars($this->input->post('Date_In_Service'), ENT_QUOTES));
		$Taxable_Status = 	trim(htmlspecialchars($this->input->post('Taxable_Status'), ENT_QUOTES));
		$Active = 1;

		$this->Item_DB->UpdateItemData($Item_Category_ID, $Vendor_ID, $Item_Name, $Part_Number, $Serial_Number, 
			$Tracking_Number, $Date_In_Service, $Taxable_Status, $Active, $Item_ID, $Company_ID);

		echo '<script>window.location.href = "/index.php/items/ItemList";</script>';
	}
}