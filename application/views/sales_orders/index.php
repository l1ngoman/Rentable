<!--
*************************************************
* File Name: sales_orders/index.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* Index view of all sales orders
*************************************************
-->
<?php

    echo "
        <main class=''>
            <header class='d-flex justify-content-center align-items-middle col-12'>
                <nav class='d-flex flex-column'>
                    <div class='text-center'>
                        <h2 class='text-secondary text-center mb-1'>Sales Order List</h2>
                    </div>
                    <div class='text-center mb-4'>
                        <a href='/index.php/sales_orders/NewSalesOrder' class='text-secondary'>
                            New Sales Order
                        </a>
                    </div>
                </nav>
            </header>";
            
    if(!empty($SalesOrderArray))
    {
        echo "  
            <table class='table table-striped col-12'>
                <tbody>
                    <tr>
                        <th scope='col' style='width='30px'></th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Order No.</span>
                            <span class='d-sm-none'>Order</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Order Date</span>
                            <span class='d-sm-none'>Date</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Customer</span>
                            <span class='d-sm-none'>Customer</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Employee</span>
                            <span class='d-sm-none'>User</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                    </tr>";
        foreach($SalesOrderArray as $Order)
        {
            $Status = $Order['Status'] == 'Open' ? 'text-primary' : 'text-secondary';
            $Order_ID = $Order['Order_ID'];
            $Customer_Name = $Order['Customer_Last'].', '.$Order['Customer_First'];
            $SO_Date = $Order['SO_TimeStamp'];
            $User_Name = $Order['User_First'].' '.$Order['User_Last'][0];
    
            echo "  <tr>
                        <td style='width='30px'>
                            <a href='#'>
                                <i class='fa fa-pencil-alt text-muted'></i>
                            </a>
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <a href='/index.php/sales_orders/EditSalesOrder/$Order_ID' class='$Status'>
                                <span class='d-none d-sm-inline-block'>$Order_ID</span>
                                <span class='d-sm-none'><small>$Order_ID</small></span> <!-- ATG:: MOBILE VIEW -->
                            </a>
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$SO_Date</span>
                            <span class='d-sm-none'>$SO_Date</span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Customer_Name</span>
                            <span class='d-sm-none'><small>$Customer_Name</small></span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$User_Name</span>
                            <span class='d-sm-none'>$User_Name</span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                    </tr>";
        }
        echo "  </tbody>
            </table>";
    }
    else
    {
        echo "  
            <h4 class='d-flex justify-content-center col-12'>There are no Sales Orders created.</h4>";
    }

    echo "  
        </main>";
