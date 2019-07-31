<?php
// *************************************************
// * File Name: customer_db.php
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

    class Customer_DB extends CI_Model
    {

/**************************************************************/
/**************************************************************/
/*********************** GET FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function GetCustomerList($Company_ID)
        {
            $sql = "SELECT *
                    FROM customers
                    WHERE Company_ID='$Company_ID'
                    ORDER BY Active DESC, Last_Name ASC";

            return $this->db->query($sql)->result_array();
        }

        public function GetCustomerByID($Customer_ID, $Company_ID)
        {
            $sql = "SELECT *
                    FROM customers
                    WHERE Company_ID='$Company_ID'
                    AND Customer_ID='$Customer_ID'
                    LIMIT 1";

            return $this->db->query($sql)->result_array();
        }

/**************************************************************/
/**************************************************************/
/******************** INSERT FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function InsertNewCustomerData($First_Name, $Last_Name, $Billing_Address_1, $Billing_Address_2, 
            $Billing_City, $Billing_State, $Billing_Zip, $Billing_Country, $Delivery_Address_1, $Delivery_Address_2, 
            $Delivery_City, $Delivery_State, $Delivery_Zip, $Delivery_Country, $Phone_1, $Phone_2, $Notes, $Company_ID, $User_ID)
        {
            $sql = array(
                'First_Name' => $First_Name,
                'Last_Name' => $Last_Name,
                'Billing_Address_1' => $Billing_Address_1,
                'Billing_Address_2' => $Billing_Address_2,
                'Billing_City' => $Billing_City,
                'Billing_State' => $Billing_State,
                'Billing_Zip' => $Billing_Zip,
                'Billing_Country' => $Billing_Country,
                'Delivery_Address_1' => $Delivery_Address_1,
                'Delivery_Address_2' => $Delivery_Address_2,
                'Delivery_City' => $Delivery_City,
                'Delivery_State' => $Delivery_State,
                'Delivery_Zip' => $Delivery_Zip,
                'Delivery_Country' => $Delivery_Country,
                'Phone_1' => $Phone_1,
                'Phone_2' => $Phone_2,
                'Notes' => $Notes,
                'Company_ID' => $Company_ID,
                'User_ID' => $User_ID,
                'Active' => '1'
            );

            $this->db->insert('customers', $sql);

            return $this->db->insert_id();
        }

/**************************************************************/
/**************************************************************/
/********************* UPDATE FUNCTIONS ***********************/
/**************************************************************/
/**************************************************************/

        public function UpdateCustomerData($First_Name, $Last_Name, $Billing_Address_1, $Billing_Address_2, 
            $Billing_City, $Billing_State, $Billing_Zip, $Delivery_Address_1, $Delivery_Address_2, 
            $Delivery_City, $Delivery_State, $Delivery_Zip, $Phone_1, $Phone_2, $Notes, $Company_ID, $Customer_ID, $Active)
        {
            $sql = "UPDATE customers
                    SET First_Name='$First_Name',
                        Last_Name='$Last_Name',
                        Billing_Address_1='$Billing_Address_1',
                        Billing_Address_2='$Billing_Address_2',
                        Billing_City='$Billing_City',
                        Billing_State='$Billing_State',
                        Billing_Zip='$Billing_Zip',
                        Delivery_Address_1='$Delivery_Address_1',
                        Delivery_Address_2='$Delivery_Address_2',
                        Delivery_City='$Delivery_City',
                        Delivery_State='$Delivery_State',
                        Delivery_Zip='$Delivery_Zip',
                        Phone_1='$Phone_1',
                        Phone_2='$Phone_2',
                        Notes='$Notes',
                        Active='$Active'
                    WHERE Company_ID='$Company_ID'
                    AND Customer_ID='$Customer_ID'";

            $this->db->query($sql);
        }
    }

?>