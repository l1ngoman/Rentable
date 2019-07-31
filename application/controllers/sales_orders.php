<?php
// <!--
// *************************************************
// * File Name: sales_orders.php
// *************************************************
// * Authors:
// *
// * Andrew T. Garrett
// *
// *************************************************
// * Description:
// *
// *
// *************************************************
// -->
class Sales_Orders extends CI_Controller 
{

	public function SalesOrderList()
	{
        $this->load->library('ion_Auth');
        if (!$this->ion_auth->logged_in())
        {
          redirect('auth/login');
        }

		$Company_ID = $this->session->userdata('company_id');

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
        $this->load->library('ion_Auth');
        if (!$this->ion_auth->logged_in())
        {
          redirect('auth/login');
        }

		$Company_ID = $this->session->userdata('company_id');

		$this->load->helper('format');
		$this->load->model('Sales_Order_DB');
		$this->load->model('Item_DB');

		$Today = Helper_GetTodaysDate($Company_ID);

		$CustomerList = $this->Sales_Order_DB->GetCustomerList($Company_ID);
		$ItemList = $this->Item_DB->GetItemList($Company_ID);

		$SalesOrderInfo = array(
			'Customer_ID' 		=> '',
			'Subtotal_Amount'	=> '',
			'Tax_Amount' 		=> '',
			'Total_Amount' 		=> '',
			'Total_Taxable' 	=> '',
			'Total_NonTaxable' 	=> '',
			'SO_Notes' 			=> '',
			'SO_TimeStamp' 		=> '',
		);

		$FormInfo = array(
			'PageTitle' 	=> 'New Sales Order',
			'ButtonTitle' 	=> 'Create New Order',
			'Action' 		=> '/index.php/sales_orders/AddItemNewSalesOrder',
			'FormID' 		=> 'AddNewSalesOrderForm'
		);

		$this->load->view('templates/header.php');
		$this->load->view('sales_orders/form.php', array(
			'SalesOrderInfo' 	=> $SalesOrderInfo,
			'FormInfo' 			=> $FormInfo,
			'CustomerList' 		=> $CustomerList,
			'ItemList' 			=> $ItemList,
			'Today' 			=> $Today,
		));
		$this->load->view('templates/footer.php');
	}

	public function AddItemNewSalesOrder()
	{
        $this->load->library('ion_Auth');
        if (!$this->ion_auth->logged_in())
        {
          redirect('auth/login');
        }

		$Company_ID = $this->session->userdata('company_id');
		$User_ID = $this->session->userdata('user_id');

		$this->load->helper('format');
		$this->load->model('Sales_Order_DB');
		$this->load->model('Company_DB');
		$this->load->model('Item_DB');

		// ATG:: GET COMPANY'S SALES TAX RATE
		$Tax_Rate_Array = $this->Company_DB->GetSalesTaxRate($Company_ID);
		$Tax_Rate = $Tax_Rate_Array[0]['Sales_Tax_Rate'] / 100;

		$Customer_ID 		= $this->input->post('Customer_ID');
        $SO_Notes 			= $this->input->post('SO_Notes');
        $Item_ID 			= $this->input->post('Item_ID');

        if($Item_ID == NULL)
        {
            // ATG:: IF USER DOESN'T DEFINE INITIAL ITEM, SET ID TO ZERO SO SQL DOESN'T THROW ERROR
            $Item_ID = 0;
        }

		// ATG:: INSERT SO DATA
        $SO_ID = $this->Sales_Order_DB->InsertNewSalesOrderData($Customer_ID, $SO_Notes, $Item_ID, $Tax_Rate, $Company_ID, $User_ID);
        
        // ATG:: RECALCULATE TOTALS AND UPDATE SO INFO
        $this->_UpdateSalesOrderTotals($SO_ID, $Company_ID);

        header("Location: /index.php/sales_orders/EditSalesOrder/$SO_ID");
    }
    
	public function AddItemExistingSalesOrder()
	{
        $this->load->library('ion_Auth');
        if (!$this->ion_auth->logged_in())
        {
          redirect('auth/login');
        }

		$Company_ID = $this->session->userdata('company_id');
		$User_ID = $this->session->userdata('user_id');

		$this->load->helper('format');
		$this->load->model('Sales_Order_DB');
		$this->load->model('Company_DB');
        $this->load->model('Item_DB');

        $New_Item_ID 	            = $this->input->post('New_Item_ID');
        $SO_ID 		                = $this->input->post('SO_ID');
        $NumberOfEntries 	        = $this->input->post('NumberOfEntries');

        // ATG:: CHECK POST FOR UPDATED SO VALUES AND UPDATE THEM; RETURNS HASH OF COLUMN_NAME => UPDATED_VALUE OF ANY UPDATES
        $SO_Update_Array = $this->_CheckForAndInsertSalesOrderUpdates($_POST, $Company_ID);

        // ATG:: ADD ITEM, IF ANY WERE ADDED
        if($New_Item_ID != NULL)
        {
            // ATG:: INSERT NEW ITEM
            $this->Sales_Order_DB->InsertNewSalesOrderItem($SO_ID, $New_Item_ID, $Tax_Rate, $Company_ID, $User_ID);
        }

        // ATG:: CHECK POST FOR UPDATED SO ITEM VALUES AND UPDATE THEM; RETURNS ARRAY OF SO_ITEM_ID[COLUMN_NAME => COLUMN_VALUE]
        $SO_Item_Update_Array = $this->_CheckForAndInsertSalesOrderItemUpdates($_POST, $Company_ID);

        // ATG:: RECALCULATE AND UPDATE SO TOTALS
        $this->_UpdateSalesOrderTotals($SO_ID, $Company_ID);

        header("Location: /index.php/sales_orders/EditSalesOrder/$SO_ID");
	}

	public function EditSalesOrder($SO_ID)
	{
        $this->load->library('ion_Auth');
        if (!$this->ion_auth->logged_in())
        {
          redirect('auth/login');
        }

		$Company_ID = $this->session->userdata('company_id');
		$User_ID = $this->session->userdata('user_id');

		$this->load->model('Sales_Order_DB');
		$this->load->model('Item_DB');
        $this->load->model('Company_DB');

        $CustomerList = $this->Sales_Order_DB->GetCustomerList($Company_ID);
        $ItemList = $this->Item_DB->GetItemList($Company_ID);

        // ATG:: GET COMPANY'S SALES TAX RATE
		$Tax_Rate_Array = $this->Company_DB->GetSalesTaxRate($Company_ID);
		$Tax_Rate = $Tax_Rate_Array[0]['Sales_Tax_Rate'] / 100;

		// ATG:: GET SO BY ID
        $SalesOrderInfo = $this->Sales_Order_DB->GetSalesOrderByID($SO_ID, $Company_ID);

		// ATG:: GET SO ITEMS BY ID
		$SalesOrderItemsInfo = $this->Sales_Order_DB->GetSalesOrderItemsByID($SO_ID, $Company_ID);

		$this->load->view('templates/header.php');
		$this->load->view('sales_orders/edit.php', array(
			'SalesOrderInfo' => $SalesOrderInfo[0],
			'SalesOrderItemsInfo' => $SalesOrderItemsInfo,
			'CustomerList' => $CustomerList,
			'ItemList' => $ItemList,
			'Tax_Rate' => $Tax_Rate,
        ));
        $this->load->view('templates/footer.php');
    }

/**************************************************************/
/**************************************************************/
/******************** PRIVATE FUNCTIONS ***********************/
/**************************************************************/
/**************************************************************/

    // ATG:: CONTROLLER FUNCTION TO UPDATE SO TOTALS AFTER ITEMS HAVE BEEN CHANGED
    private function _UpdateSalesOrderTotals($SO_ID, $Company_ID)
    {
        $this->load->library('ion_Auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
        }
        
		$Company_ID = $this->session->userdata('company_id');
		$User_ID = $this->session->userdata('user_id');

        $this->load->model('Sales_Order_DB');

        $Subtotal_Amount    = 0.00;
        $Tax_Amount         = 0.00;
        $Total_Amount       = 0.00;
        $Total_Taxable      = 0.00;
        $Total_NonTaxable   = 0.00;
        
        // ATG:: QUERY DB FOR ALL SO ITEMS
        $SO_Item_Array = $this->Sales_Order_DB->GetSalesOrderItemsByID($SO_ID, $Company_ID);
        if(!empty($SO_Item_Array))
        {
            foreach($SO_Item_Array as $SO_Item)
            {
                $SO_Item_Quantity        = $SO_Item['SO_Item_Quantity'];
                $SO_Item_Amount          = $SO_Item['SO_Item_Amount'];
                $SO_Item_Tax             = $SO_Item['SO_Item_Tax'];
                $Taxable_Status          = $SO_Item['Taxable_Status'];

                // ATG:: CALCULATE CURRENT ITEM EXT SUBTOTAL AND EXT TAX
                $SO_Item_Ext_SubTotal    = $SO_Item_Amount * $SO_Item_Quantity;
                $SO_Item_Ext_Tax         = $SO_Item_Tax * $SO_Item_Quantity;

                $Subtotal_Amount        += $SO_Item_Ext_SubTotal;
                $Tax_Amount             += $SO_Item_Ext_Tax;
                $Total_Amount           += $SO_Item_Ext_SubTotal + $SO_Item_Ext_Tax;

                if($Taxable_Status == 1)
                {
                    $Total_Taxable      += $SO_Item_Ext_SubTotal;
                }
                else
                {
                    $Total_NonTaxable   += $SO_Item_Ext_SubTotal;
                }
            }
        }

        $this->Sales_Order_DB->UpdateSalesOrderTotalsDB($SO_ID, $Subtotal_Amount, $Tax_Amount, $Total_Amount,
            $Total_Taxable, $Total_NonTaxable, $Company_ID);
    }

    // ATG:: CHECKS TO SEE IF USER UPDATED ANY SO VALUES; RETURNS HASH OF COLUMN_NAME => COLUMN_VALUE
    private function _CheckForAndInsertSalesOrderUpdates($Post_Array, $Company_ID)
    {
        $SO_Update_Array            = array();
        $User_Input_Order_Date 	    = $Post_Array['User_Input_Order_Date'];
		$User_Input_Delivery_Date 	= $Post_Array['User_Input_Delivery_Date'];
		$SO_Notes 	                = $Post_Array['SO_Notes'];
		$Customer_ID 	            = $Post_Array['Customer_ID'];
		$SO_ID 	                    = $Post_Array['SO_ID'];

        // ATG:: QUERY FOR OLD SO VALUES TO SEE IF THEY HAVE CHANGED
        $ExistingSalesOrderInfo = $this->Sales_Order_DB->GetSalesOrderByID($SO_ID, $Company_ID);

        // ATG:: CHECK IF ANY VALUES HAVE CHANGED AND IF SO, PUSH THEM INTO THE UPDATE ARRAY
        if($User_Input_Order_Date != $ExistingSalesOrderInfo[0]['User_Input_Order_Date'])
        {
            $SO_Update_Array['User_Input_Order_Date'] = $User_Input_Order_Date;
        }
        if($User_Input_Delivery_Date != $ExistingSalesOrderInfo[0]['User_Input_Delivery_Date'])
        {
            $SO_Update_Array['User_Input_Delivery_Date'] = $User_Input_Delivery_Date;
        }
        if($SO_Notes != $ExistingSalesOrderInfo[0]['SO_Notes'])
        {
            $SO_Update_Array['SO_Notes'] = $SO_Notes;
        }
        if($Customer_ID != $ExistingSalesOrderInfo[0]['Customer_ID'])
        {
            $SO_Update_Array['Customer_ID'] = $Customer_ID;
        }

        // ATG:: LOOP THROUGH SO UPDATE ARRAY TO INSERT CHANGED VALUES
        foreach($SO_Update_Array as $Column_Name => $Column_Value)
        {
            $this->Sales_Order_DB->UpdateSalesOrderInfo($Column_Name, $Column_Value, $SO_ID, $Company_ID);
        }
        
        return $SO_Update_Array;
    }

    // ATG:: CHECKS TO SEE IF USER UPDATED ANY SO ITEM VALUES; RETURNS ARRAY OF SO_ITEM_ID[COLUMN_NAME => COLUMN_VALUE]
    private function _CheckForAndInsertSalesOrderItemUpdates($Post_Array, $Company_ID)
    {
        $SO_Item_Update_Array   = array();
        $NumberOfEntries 	    = $Post_Array['NumberOfEntries'];
        $Tax_Rate 	            = $Post_Array['Tax_Rate'];

        // ATG:: LOOP THROUGH POST TO GET OLD ITEM VALUES AND UPDATE IF THEY WERE CHANGED
        for ($i = 1; $i <= $NumberOfEntries; $i++) 
        {
            $SO_Item_ID 	    = $Post_Array['SO_Item_ID'.$i];
            $SO_Item_Quantity 	= $Post_Array['SO_Item_Quantity'.$i];
            $SO_Item_Amount 	= $Post_Array['SO_Item_Amount'.$i];
            $Taxable_Status 	= $Post_Array['Taxable_Status'.$i];

            if($Taxable_Status == 1)
            {
                $SO_Tax_Amount = $SO_Item_Amount * $Tax_Rate;
            }
            else
            {
                $SO_Tax_Amount = 0.00;
            }

            // ATG:: QUERY FOR OLD SO VALUES TO SEE IF THEY HAVE CHANGED
            $ExistingSalesOrderItemInfo = $this->Sales_Order_DB->GetSalesOrderItemBySOItemID($SO_Item_ID, $Company_ID);
            // ATG:: CHECK IF ANY VALUES HAVE CHANGED AND IF SO, PUSH THEM INTO THE UPDATE ARRAY
            if($SO_Item_Quantity != $ExistingSalesOrderItemInfo[0]['SO_Item_Quantity'])
            {
                $SO_Item_Update_Array[$i-1][$SO_Item_ID]['SO_Item_Quantity'] = $SO_Item_Quantity;
            }
            if($SO_Item_Amount != $ExistingSalesOrderItemInfo[0]['SO_Item_Amount'])
            {
                $SO_Item_Update_Array[$i-1][$SO_Item_ID]['SO_Item_Amount'] = $SO_Item_Amount;
            }

            $this->Sales_Order_DB->UpdateSalesOrderItem($SO_Item_ID, $SO_Item_Quantity, $SO_Item_Amount, $SO_Tax_Amount, $Company_ID);
        }

        return $SO_Item_Update_Array;
    }
}

