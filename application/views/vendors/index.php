<!--
*************************************************
* File Name: vendors/index.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* Index view of all vendors
*************************************************
-->
<?php

    echo "
        <main class=''>
            <header class='d-flex justify-content-center align-items-middle col-12'>
                <nav class='d-flex flex-column'>
                    <div class='text-center'>
                        <h2 class='text-secondary text-center mb-1'>Vendor List</h2>
                    </div>
                    <div class='text-center mb-4'>
                        <a href='/index.php/vendors/NewVendor' class='text-secondary'>
                            New Vendor
                        </a>
                    </div>
                </nav>
            </header>";
            
    if(!empty($VendorArray))
    {
        echo "  
            <table class='table table-striped col-12'>
                <tbody>
                    <tr>
                        <th scope='col' style='width='30px'></th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Vendor Name</span>
                            <span class='d-sm-none'>Name</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Phone</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Address</span>
                            <span class='d-sm-none'>Address</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>City</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>State</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Zip</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                    </tr>";
        foreach($VendorArray as $Vendor)
        {
            $Status = $Vendor['Active'] == 1 ? 'text-primary' : 'text-danger';
            $Vendor_ID = $Vendor['Vendor_ID'];
            $Name = $Vendor['Vendor_Name'];
            $Phone = HelperFormatPhoneNumber($Vendor['Phone']);
            $Address = $Vendor['Vendor_Address_2'] == '' ? $Vendor['Vendor_Address_1'] : $Vendor['Vendor_Address_1'].' '.$Vendor['Vendor_Address_2'];
            $Vendor_City = $Vendor['Vendor_City'];
            $Vendor_State = $Vendor['Vendor_State'];
            $Vendor_Zip = $Vendor['Vendor_Zip'];

            echo "  <tr>
                        <td style='width='30px'>
                            <a href='#'>
                                <i class='fa fa-pencil-alt text-muted'></i>
                            </a>
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <a href='/index.php/vendors/EditVendor/$Vendor_ID' class='$Status'>
                                <span class='d-none d-sm-inline-block'>$Name</span>
                                <span class='d-sm-none'><small>$Name</small></span> <!-- ATG:: MOBILE VIEW -->
                            </a>
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Phone</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Address</span>
                            <span class='d-sm-none'><small>$Address</small></span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Vendor_City</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Vendor_State</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Vendor_Zip</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                    </tr>";
        }
        echo "  </tbody>
            </table>";
    }
    else
    {
        echo "  
            <h4 class='d-flex justify-content-center col-12'>There are no vendors setup.</h4>";
    }

    echo "  
        </main>";
