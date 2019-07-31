<?php
// <!--
// *************************************************
// * File Name: sales_order_db.php
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
    class Sales_Order_DB extends CI_Model
    {

/**************************************************************/
/**************************************************************/
/*********************** GET FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function GetSalesOrderList($Company_ID)
        {
            $sql = "SELECT so.*, c.First_Name as Customer_First, c.Last_Name as Customer_Last,
                           u.first_name as User_First, u.last_name as User_Last
                    FROM sales_orders as so
                    LEFT JOIN customers as c
                        ON so.Customer_ID = c.Customer_ID
                    LEFT JOIN users as u
                        ON u.id = so.User_ID
                    WHERE so.Company_ID='$Company_ID'
                    ORDER BY so.SO_ID ASC";

            return $this->db->query($sql)->result_array();
        }

        public function GetCustomerList($Company_ID)
        {
            $sql = "SELECT *
                    FROM customers
                    WHERE Company_ID='$Company_ID'
                    ORDER BY Last_Name ASC";

            return $this->db->query($sql)->result_array();
        }

        public function GetSalesOrderByID($SO_ID, $Company_ID)
        {
            $sql = "SELECT so.*, c.First_Name, c.Last_Name
                    FROM sales_orders as so
                    LEFT JOIN customers as c
                        ON so.Customer_ID = c.Customer_ID
                    WHERE so.Company_ID='$Company_ID'
                    AND so.SO_ID='$SO_ID'
                    LIMIT 1";

            return $this->db->query($sql)->result_array();
        }

        public function GetSalesOrderItemBySOItemID($SO_Item_ID, $Company_ID)
        {
            $sql = "SELECT *
                    FROM sales_order_items
                    WHERE Company_ID='$Company_ID'
                    AND SO_Item_ID='$SO_Item_ID'
                    LIMIT 1";

            return $this->db->query($sql)->result_array();
        }

        public function GetSalesOrderItemsByID($SO_ID, $Company_ID)
        {
            $sql = "SELECT soi.*, i.Item_Name, i.Part_Number, i.Taxable_Status
                    FROM sales_order_items as soi
                    LEFT JOIN items as i
                        ON soi.Item_ID = i.Item_ID
                    WHERE soi.Company_ID='$Company_ID'
                    AND soi.SO_ID='$SO_ID'";

            return $this->db->query($sql)->result_array();
        }

        public function GetItemPriceInfo($Item_ID, $Company_ID)
        {
            $sql = "SELECT Item_Price, Taxable_Status
                    FROM items
                    WHERE Company_ID='$Company_ID'
                    AND Item_ID='$Item_ID'";

            return $this->db->query($sql)->result_array();
        }

/**************************************************************/
/**************************************************************/
/******************** INSERT FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function InsertNewSalesOrderData($Customer_ID, $SO_Notes, $Item_ID, $Tax_Rate, $Company_ID, $User_ID)
        {
            $TimeStamp = date('Y-m-d H:i:s');
            $Default_Date = date('Y-m-d');
            
            // ATG:: INSERT THE SALES ORDER INFO
            $sql = array(
                'Customer_ID'               => $Customer_ID,
                'User_Input_Order_Date'     => $Default_Date,
                'User_Input_Delivery_Date'  => $Default_Date,
                'SO_Notes'                  => $SO_Notes,
                'SO_TimeStamp'              => $TimeStamp,
                'Company_ID'                => $Company_ID,
                'User_ID'                   => $User_ID,
                'SO_Status'                 => 'Open'
            );

            $this->db->insert('sales_orders', $sql);

            $SO_ID = $this->db->insert_id();

            // ATG:: INSERT THE LINE ITEMS
            $SO_Item_Info = $this->GetItemPriceInfo($Item_ID, $Company_ID);
            if(!empty($SO_Item_Info))
            {
                $SO_Item_Amount = $SO_Item_Info[0]['Item_Price'];
                $Taxable_Status = $SO_Item_Info[0]['Taxable_Status'];
    
                if($SO_Item_Amount == NULL)
                {
                    $SO_Item_Amount = 0.00;
                }
    
                if($Taxable_Status == 1)
                {
                    $SO_Item_Tax = $Tax_Rate * $SO_Item_Amount;
                }
                else
                {
                    $SO_Item_Tax = 0.00;
                }
    
                $sql2 = array(
                    'SO_ID' 			=> $SO_ID,
                    'Item_ID' 			=> $Item_ID,
                    'SO_Item_Quantity' 	=> 1,
                    'SO_Item_Amount' 	=> $SO_Item_Amount,
                    'SO_Item_Tax' 		=> $SO_Item_Tax,
                    'SO_Item_Notes' 	=> '',
                    'SO_Item_TimeStamp' => $TimeStamp,
                    'Company_ID'        => $Company_ID,
                    'User_ID'           => $User_ID,
                    );
                
                $this->db->insert('sales_order_items', $sql2);
            }

            return $SO_ID;
        }

        public function InsertNewSalesOrderItem($SO_ID, $Item_ID, $Tax_Rate, $Company_ID, $User_ID)
        {
            $TimeStamp = date('Y-m-d H:i:s');
            
            // ATG:: INSERT THE LINE ITEMS
            $SO_Item_Info = $this->GetItemPriceInfo($Item_ID, $Company_ID);
            $SO_Item_Amount = $SO_Item_Info[0]['Item_Price'];
            $Taxable_Status = $SO_Item_Info[0]['Taxable_Status'];

            if($SO_Item_Amount == NULL)
            {
                $SO_Item_Amount = 0.00;
            }

            if($Taxable_Status == 1)
            {
                $SO_Item_Tax = $Tax_Rate * $SO_Item_Amount;
            }
            else
            {
                $SO_Item_Tax = 0.00;
            }

            $sql2 = array(
                'SO_ID' 			=> $SO_ID,
                'Item_ID' 			=> $Item_ID,
                'SO_Item_Quantity' 	=> 1,
                'SO_Item_Amount' 	=> $SO_Item_Amount,
                'SO_Item_Tax' 		=> $SO_Item_Tax,
                'SO_Item_Notes' 	=> '',
                'SO_Item_TimeStamp' => $TimeStamp,
                'Company_ID'        => $Company_ID,
                'User_ID'           => $User_ID,
                );
            
            $this->db->insert('sales_order_items', $sql2);
        }

/**************************************************************/
/**************************************************************/
/********************* UPDATE FUNCTIONS ***********************/
/**************************************************************/
/**************************************************************/

    // ATG:: UPDATE FUNCTION FOR EDITING EXISTING ITEMS ON A SALES ORDER
    public function UpdateSalesOrderInfo($Column_Name, $Column_Value, $SO_ID, $Company_ID)
    {
        $sql = "UPDATE sales_orders
                SET $Column_Name='$Column_Value'
                WHERE SO_ID='$SO_ID'
                AND Company_ID='$Company_ID'";
        $this->db->query($sql);
    }
    // ATG:: UPDATE FUNCTION FOR EDITING EXISTING ITEMS ON A SALES ORDER
    public function UpdateSalesOrderItem($SO_Item_ID, $SO_Item_Quantity, $SO_Item_Amount, $SO_Item_Tax, $Company_ID)
    {
        $sql = "UPDATE sales_order_items
                SET SO_Item_Quantity='$SO_Item_Quantity',
                    SO_Item_Amount='$SO_Item_Amount',
                    SO_Item_Tax='$SO_Item_Tax'
                WHERE SO_Item_ID='$SO_Item_ID'
                AND Company_ID='$Company_ID'";
        $this->db->query($sql);
    }

    // ATG:: UPDATE FUNCTION TO RECALCULATE SO TOTALS
    public function UpdateSalesOrderTotalsDB($SO_ID, $Subtotal_Amount, $Tax_Amount, $Total_Amount,
        $Total_Taxable, $Total_NonTaxable, $Company_ID)
    {
        $sql = "UPDATE sales_orders
                SET Subtotal_Amount='$Subtotal_Amount',
                    Tax_Amount='$Tax_Amount',
                    Total_Amount='$Total_Amount',
                    Total_Taxable='$Total_Taxable',
                    Total_NonTaxable='$Total_NonTaxable'
                WHERE SO_ID='$SO_ID'
                AND Company_ID='$Company_ID'";

        $this->db->query($sql);
    }
        // public function UpdateCustomerData($First_Name, $Last_Name, $Billing_Address_1, $Billing_Address_2, 
        //     $Billing_City, $Billing_State, $Billing_Zip, $Delivery_Address_1, $Delivery_Address_2, 
        //     $Delivery_City, $Delivery_State, $Delivery_Zip, $Phone_1, $Phone_2, $Notes, $Company_ID, $Customer_ID, $Active)
        // {
        //     $sql = "UPDATE customers
        //             SET First_Name='$First_Name',
        //                 Last_Name='$Last_Name',
        //                 Billing_Address_1='$Billing_Address_1',
        //                 Billing_Address_2='$Billing_Address_2',
        //                 Billing_City='$Billing_City',
        //                 Billing_State='$Billing_State',
        //                 Billing_Zip='$Billing_Zip',
        //                 Delivery_Address_1='$Delivery_Address_1',
        //                 Delivery_Address_2='$Delivery_Address_2',
        //                 Delivery_City='$Delivery_City',
        //                 Delivery_State='$Delivery_State',
        //                 Delivery_Zip='$Delivery_Zip',
        //                 Phone_1='$Phone_1',
        //                 Phone_2='$Phone_2',
        //                 Notes='$Notes',
        //                 Active='$Active'
        //             WHERE Company_ID='$Company_ID'
        //             AND Customer_ID='$Customer_ID'";

        //     $this->db->query($sql);
        // }
    }

?>