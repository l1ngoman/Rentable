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

?>