<!--
*************************************************
* File Name: sales_orders/form.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* Form to add or edit sales orders.
*************************************************
-->

<?php
    echo "  <main class='container-fluid'>
                <header class='d-flex justify-content-center align-items-middle col-12'>
                    <nav class='d-flex flex-column'>
                        <div class='text-center'>
                            <h2 class='text-secondary text-center mb-1'>".$FormInfo['PageTitle']."</h2>
                        </div>
                    </nav>
                </header>";

    echo "      <div class='container'>
                    <form id='".$FormInfo['FormID']."' action='".$FormInfo['Action']."' method='post' enctype='multipart/form-data'>";
    echo "              <div class='row d-flex flex-column'>";
    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-8'>
                                    <label for='Customer_ID'>Customer</label>
                                    <select name='Customer_ID' class='form-control h-25 py-3 mb-5' required>
                                        <option value='' selected disabled>Customer</option>";
    foreach($CustomerList as $Customer)
    {
        $Customer_Name = $Customer['Last_Name'].', '.$Customer['First_Name'];
        $Selected = $SalesOrderInfo['Customer_ID'] == $Customer['Customer_ID'] ? 'selected' : '';
        echo "                          <option value='".$Customer['Customer_ID']."' $Selected>$Customer_Name</option>";
    }
    echo "                          </select>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-8'>
                                    <label for='SO_Notes'>Order Notes</label>
                                    <input name='SO_Notes' value='".$SalesOrderInfo['SO_Notes']."' type='textarea' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Item_ID'>Item</label>
                                    <select name='Item_ID' class='form-control h-25 py-3 mb-5'>
                                        <option value='' selected disabled>Item</option>";
    foreach($ItemList as $Item)
    {
    $Item_Name = $Item['Part_Number'].' - '.$Item['Item_Name'];
    echo "                              <option value='".$Item['Item_ID']."' $Selected>$Item_Name</option>";
    }
    echo "                          </select>";

    echo "                          <button type='submit' class='bt btn-secondary'>Add Item</button>";
    echo "                      </div>";
    echo "                  </div>";

    echo "                  <div class='d-flex justify-content-center mb-3'>
                                <button type='submit' class='btn btn-secondary'>".$FormInfo['ButtonTitle']."</button>
                            </div>";

    echo "              </div>
                    </form>
                </div>";
    echo "  </main>";