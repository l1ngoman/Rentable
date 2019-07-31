<?php
// <!--
// *************************************************
// * File Name: item_db.php
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
    class Item_DB extends CI_Model
    {

/**************************************************************/
/**************************************************************/
/*********************** GET FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function GetItemList($Company_ID)
        {
            $sql = "SELECT *
                    FROM items
                    WHERE Company_ID='$Company_ID'
                    ORDER BY Active DESC, Item_Name ASC";

            return $this->db->query($sql)->result_array();
        }

        public function GetVendorList($Company_ID)
        {
            $sql = "SELECT *
                    FROM vendors
                    WHERE Company_ID='$Company_ID'
                    ORDER BY Active DESC, Vendor_Name ASC";

            return $this->db->query($sql)->result_array();
        }

        public function GetItemCategoryList($Company_ID)
        {
            $sql = "SELECT *
                    FROM item_categories
                    WHERE Company_ID='$Company_ID'
                    ORDER BY Active DESC, Name ASC";

            return $this->db->query($sql)->result_array();
        }

        public function GetItemByID($Item_ID, $Company_ID)
        {
            $sql = "SELECT *
                    FROM items
                    WHERE Company_ID='$Company_ID'
                    AND Item_ID='$Item_ID'
                    LIMIT 1";

            return $this->db->query($sql)->result_array();
        }

        public function GetItemTaxStatus($Item_ID)
        {
            $sql = "SELECT Taxable_Status
                    FROM items
                    WHERE Item_ID='$Item_ID'
                    LIMIT 1";

            return $this->db->query($sql)->result_array();
        }

/**************************************************************/
/**************************************************************/
/******************** INSERT FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function InsertNewItemData($Item_Category_ID, $Vendor_ID, $Item_Name, $Part_Number, $Serial_Number, 
        $Tracking_Number, $Status, $Date_In_Service, $Taxable_Status, $Company_ID, $User_ID)
        {
            $Item_TimeStamp = date('Y-m-d H:i:s');

            $sql = array(
                'Item_Category_ID' => $Item_Category_ID,
                'Vendor_ID' => $Vendor_ID,
                'Item_Name' => $Item_Name,
                'Part_Number' => $Part_Number,
                'Serial_Number' => $Serial_Number,
                'Tracking_Number' => $Tracking_Number,
                'Status' => $Status,
                'Date_In_Service' => $Date_In_Service,
                'Taxable_Status' => $Taxable_Status,
                'Company_ID' => $Company_ID,
                'User_ID' => $User_ID,
                'Item_TimeStamp' => $Item_TimeStamp,
                'Status' => 'On-Hand',
                'Active' => '1'
            );

            $this->db->insert('items', $sql);

            return $this->db->insert_id();
        }

/**************************************************************/
/**************************************************************/
/********************* UPDATE FUNCTIONS ***********************/
/**************************************************************/
/**************************************************************/

        public function UpdateItemData($Item_Category_ID, $Vendor_ID, $Item_Name, $Part_Number, $Serial_Number, 
            $Tracking_Number, $Date_In_Service, $Taxable_Status, $Active, $Item_ID, $Company_ID)
        {
            $sql = "UPDATE items
                    SET Item_Category_ID='$Item_Category_ID',
                        Vendor_ID='$Vendor_ID',
                        Item_Name='$Item_Name',
                        Part_Number='$Part_Number',
                        Serial_Number='$Serial_Number',
                        Tracking_Number='$Tracking_Number',
                        Date_In_Service='$Date_In_Service',
                        Taxable_Status='$Taxable_Status',
                        Active='$Active'
                    WHERE Company_ID='$Company_ID'
                    AND Item_ID='$Item_ID'";

            $this->db->query($sql);
        }
    }

?>