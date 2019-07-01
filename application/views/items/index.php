<!--
*************************************************
* File Name: items/index.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* Index view of all items
*************************************************
-->
<?php

    echo "
        <main class=''>
            <header class='d-flex justify-content-center align-items-middle col-12'>
                <nav class='d-flex flex-column'>
                    <div class='text-center'>
                        <h2 class='text-secondary text-center mb-1'>Item List</h2>
                    </div>
                    <div class='text-center mb-4'>
                        <a href='/index.php/items/NewItem' class='text-secondary'>
                            New Item
                        </a>
                    </div>
                </nav>
            </header>";
            
    if(!empty($ItemArray))
    {
        echo "  
            <table class='table table-striped col-12'>
                <tbody>
                    <tr>
                        <th scope='col' style='width='30px'></th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Part No.</span>
                            <span class='d-sm-none'>Part No.</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Item Name</span>
                            <span class='d-sm-none'>Name</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Tracking No.</span>
                            <span class='d-sm-none'>Tracking</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                        <th scope='col' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>Status</span>
                            <span class='d-sm-none'>Status</span> <!-- ATG:: MOBILE VIEW -->
                        </th>
                    </tr>";
        foreach($ItemArray as $Item)
        {
            $Active = $Item['Active'] == 1 ? 'text-primary' : 'text-danger';
            $Item_ID = $Item['Item_ID'];
            $Item_Name = $Item['Item_Name'];
            $Part_Number = $Item['Part_Number'];
            $Tracking_Number = $Item['Tracking_Number'];
            $Item_Status = $Item['Status'];

            echo "  <tr>
                        <td style='width='30px'>
                            <a href='#'>
                                <i class='fa fa-pencil-alt text-muted'></i>
                            </a>
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <a href='/index.php/items/EditItem/$Item_ID' class='$Active'>
                                <span class='d-none d-sm-inline-block'>$Part_Number</span>
                                <span class='d-sm-none'><small>$Part_Number</small></span> <!-- ATG:: MOBILE VIEW -->
                            </a>
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Item_Name</span>
                            <span class='d-sm-none'>$Item_Name</span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Tracking_Number</span>
                            <span class='d-sm-none'><small>$Tracking_Number</small></span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                        <td col='1' class='p-0 p-sm-2 m-0'>
                            <span class='d-none d-sm-inline-block'>$Item_Status</span>
                            <span class='d-sm-none'>$Item_Status</span> <!-- ATG:: MOBILE VIEW -->
                        </td>
                    </tr>";
        }
        echo "  </tbody>
            </table>";
    }
    else
    {
        echo "  
            <h4 class='d-flex justify-content-center col-12'>There are no items setup.</h4>";
    }

    echo "  
        </main>";
