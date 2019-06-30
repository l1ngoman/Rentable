<!--
*************************************************
* File Name: customers/index.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* Index view of all customers
*************************************************
-->
<?php

    echo "
        <main class=''>
            <header class='d-flex justify-content-center align-items-middle col-12'>
                <nav class='d-flex flex-column'>
                    <div class='text-center'>
                        <h2 class='text-secondary text-center mb-1'>Customer List</h2>
                    </div>
                    <div class='text-center mb-4'>
                        <a href='/index.php/customers/NewCustomer' class='text-secondary'>
                            New Customer
                        </a>
                    </div>
                </nav>
            </header>";
            
    if(!empty($CustomerArray))
    {
        echo "  
            <table class='table table-striped col-12'>
                <tbody>
                    <tr>
                        <th scope='col' style='width='30px'></th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Customer Name</span>
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
        foreach($CustomerArray as $Customer)
        {
            $Status = $Customer['Active'] == 1 ? 'text-primary' : 'text-danger';
            $Customer_ID = $Customer['Customer_ID'];
            $Name = $Customer['Last_Name'].', '.$Customer['First_Name'];
            $Phone = HelperFormatPhoneNumber($Customer['Phone_1']);
            $Address = $Customer['Billing_Address_2'] == '' ? $Customer['Billing_Address_1'] : $Customer['Billing_Address_1'].' '.$Customer['Billing_Address_2'];
            $Billing_City = $Customer['Billing_City'];
            $Billing_State = $Customer['Billing_State'];
            $Billing_Zip = $Customer['Billing_Zip'];

            echo "  <tr>
                        <td style='width='30px'>
                            <a href='#'>
                                <i class='fa fa-pencil-alt text-muted'></i>
                            </a>
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <a href='/index.php/customers/EditCustomer/$Customer_ID' class='$Status'>
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
                            <span class='d-none d-sm-inline-block'>$Billing_City</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Billing_State</span>
                            <span class='d-sm-none'></span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Billing_Zip</span>
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
            <h4 class='d-flex justify-content-center col-12'>There are no customers setup.</h4>";
    }

    echo "  
        </main>";
