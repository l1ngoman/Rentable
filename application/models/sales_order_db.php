<!--
*************************************************
* File Name: sales_order_db.php
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

        // public function GetCustomerByID($Customer_ID, $Company_ID)
        // {
        //     $sql = "SELECT *
        //             FROM customers
        //             WHERE Company_ID='$Company_ID'
        //             AND Customer_ID='$Customer_ID'
        //             LIMIT 1";

        //     return $this->db->query($sql)->result_array();
        // }

/**************************************************************/
/**************************************************************/
/******************** INSERT FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function InsertNewSalesOrderData($Customer_ID, $SO_Notes, $Item_ID, $SO_Item_Quantity, 
        $SO_Item_Amount, $SO_Extended_Amount, $Company_ID, $User_ID)
        {
            $SO_TimeStamp = date('Y-m-d H:i:s');
            
            // ATG:: INSERT THE SALES ORDER INFO
            $sql = array(
                'Customer_ID' => $Customer_ID,
                'Subtotal_Amount' => $Subtotal_Amount,
                'Tax_Amount' => $Tax_Amount,
                'Total_Amount' => $Total_Amount,
                'Total_Taxable' => $Total_Taxable,
                'Total_NonTaxable' => $Total_NonTaxable,
                'SO_Notes' => $SO_Notes,
                'SO_TimeStamp' => $SO_TimeStamp,
                'Company_ID' => $Company_ID,
                'User_ID' => $User_ID,
                'SO_Status' => 'Open'
            );

            $this->db->insert('customers', $sql);

            // ATG:: INSERT THE LINE ITEMS

            $Line_Items = array(
                'Item_ID' => $Item_ID,
                'SO_Item_Quantity' => $SO_Item_Quantity,
                'SO_Item_Amount' => $SO_Item_Amount,
                'SO_Extended_Amount' => $SO_Extended_Amount,
            );
        }

/**************************************************************/
/**************************************************************/
/********************* UPDATE FUNCTIONS ***********************/
/**************************************************************/
/**************************************************************/

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