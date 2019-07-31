<?php
// *************************************************
// * File Name: vendor_db.php
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

    class Vendor_DB extends CI_Model
    {

/**************************************************************/
/**************************************************************/
/*********************** GET FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function GetVendorList($Company_ID)
        {
            $sql = "SELECT *
                    FROM vendors
                    WHERE Company_ID='$Company_ID'
                    ORDER BY Active DESC, Vendor_Name ASC";

            return $this->db->query($sql)->result_array();
        }

        public function GetVendorByID($Vendor_ID, $Company_ID)
        {
            $sql = "SELECT *
                    FROM vendors
                    WHERE Company_ID='$Company_ID'
                    AND Vendor_ID='$Vendor_ID'
                    LIMIT 1";

            return $this->db->query($sql)->result_array();
        }

/**************************************************************/
/**************************************************************/
/******************** INSERT FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function InsertNewVendorData($Vendor_Name, $Vendor_Address_1, $Vendor_Address_2, $Vendor_City, $Vendor_State, 
            $Vendor_Zip, $Vendor_Country, $Phone, $Fax, $Website, $Vendor_Notes, $Company_ID, $User_ID)
        {
            $sql = array(
                'Vendor_Name' => $Vendor_Name,
                'Vendor_Address_1' => $Vendor_Address_1,
                'Vendor_Address_2' => $Vendor_Address_2,
                'Vendor_City' => $Vendor_City,
                'Vendor_State' => $Vendor_State,
                'Vendor_Zip' => $Vendor_Zip,
                'Vendor_Country' => $Vendor_Country,
                'Phone' => $Phone,
                'Fax' => $Fax,
                'Website' => $Website,
                'Vendor_Notes' => $Vendor_Notes,
                'Company_ID' => $Company_ID,
                'User_ID' => $User_ID,
                'Active' => '1'
            );

            $this->db->insert('vendors', $sql);

            return $this->db->insert_id();
        }

/**************************************************************/
/**************************************************************/
/********************* UPDATE FUNCTIONS ***********************/
/**************************************************************/
/**************************************************************/

        public function UpdateVendorData($Vendor_Name, $Vendor_Address_1, $Vendor_Address_2, $Vendor_City, 
            $Vendor_State, $Vendor_Zip, $Phone, $Fax, $Vendor_Notes, $Website, $Company_ID, $Vendor_ID, $Active)
        {
            $sql = "UPDATE vendors
                    SET Vendor_Name='$Vendor_Name',
                        Vendor_Address_1='$Vendor_Address_1',
                        Vendor_Address_2='$Vendor_Address_2',
                        Vendor_City='$Vendor_City',
                        Vendor_State='$Vendor_State',
                        Vendor_Zip='$Vendor_Zip',
                        Phone='$Phone',
                        Fax='$Fax',
                        Website='$Website',
                        Vendor_Notes='$Vendor_Notes',
                        Active='$Active'
                    WHERE Company_ID='$Company_ID'
                    AND Vendor_ID='$Vendor_ID'";

            $this->db->query($sql);
        }
    }

?>