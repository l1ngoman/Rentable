<!--
*************************************************
* File Name: company_db.php
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

    class Company_DB extends CI_Model
    {

/**************************************************************/
/**************************************************************/
/*********************** GET FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function GetCompanyTimeZone($Company_ID)
        {
            $sql = "SELECT Local_Timezone
                    FROM companies
                    WHERE Company_ID='$Company_ID'
                    LIMIT 1";

            return $this->db->query($sql)->result_array();
        }

        public function GetSalesTaxRate($Company_ID)
        {
            $sql = "SELECT Sales_Tax_Rate
                    FROM companies
                    WHERE Company_ID='$Company_ID'
                    LIMIT 1";

            return $this->db->query($sql)->result_array();
        }

/**************************************************************/
/**************************************************************/
/******************** INSERT FUNCTIONS ************************/
/**************************************************************/
/**************************************************************/

        public function InsertNewCompanyData($Company_Name, $Address_1, $Address_2, $City, $State, $Zip, 
            $Country, $Phone, $Fax, $Website, $Sales_Tax_Rate)
        {
            $sql = array(
                'Company_Name' => $Company_Name,
                'Address_1' => $Address_1,
                'Address_2' => $Address_2,
                'City' => $City,
                'State' => $State,
                'Zip' => $Zip,
                'Country' => $Country,
                'Phone' => $Phone,
                'Fax' => $Fax,
                'Website' => $Website,
                'Sales_Tax_Rate' => $Sales_Tax_Rate
            );

            $this->db->insert('company', $sql);
        }
    }

/**************************************************************/
/**************************************************************/
/********************* UPDATE FUNCTIONS ***********************/
/**************************************************************/
/**************************************************************/


?>