<!--
*************************************************
* File Name: customers/form.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* Form to add or edit customers.
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
                    <form id='NewCustomerForm' action='".$FormInfo['Action']."' method='post' enctype='multipart/form-data'>
                        <div class='row d-flex flex-column'>";
                        
    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='First_Name'>First Name</label>
                                    <input name='First_Name' value='".$CustomerInfo['First_Name']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Last_Name'>(*) Last Name</label>
                                    <input name='Last_Name' value='".$CustomerInfo['Last_Name']."' type='text' class='form-control h-25 py-3' required>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Phone_1'>Phone 1</label>
                                    <input name='Phone_1' value='".$CustomerInfo['Phone_1']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Phone_2'>Phone 2</label>
                                    <input name='Phone_2' value='".$CustomerInfo['Phone_2']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Billing_Address_1'>Billing Address 1</label>
                                    <input name='Billing_Address_1' value='".$CustomerInfo['Billing_Address_1']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Billing_Address_2'>Billing Address 2</label>
                                    <input name='Billing_Address_2' value='".$CustomerInfo['Billing_Address_2']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-4 col-lg-4'>
                                    <label for='Billing_City'>Billing City</label>
                                    <input name='Billing_City' value='".$CustomerInfo['Billing_City']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-3 col-lg-2'>
                                    <label for='Billing_State'>Billing State</label>
                                    <select name='Billing_State' class='form-control h-25 py-3'>
                                        <option value='' selected disabled>STATE</option>";
    foreach(Helper_State_List() as $State)
    {
        $Selected = $CustomerInfo['Billing_State'] == $State ? 'selected' : '';
        echo "                          <option value='$State' $Selected>$State</option>";
    }
    echo "                          </select>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-4 col-lg-2'>
                                    <label for='Billing_Zip'>Billing Zip</label>
                                    <input name='Billing_Zip' value='".$CustomerInfo['Billing_Zip']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Delivery_Address_1'>Delivery Address 1</label>
                                    <input name='Delivery_Address_1' value='".$CustomerInfo['Delivery_Address_1']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Delivery_Address_2'>Delivery Address 2</label>
                                    <input name='Delivery_Address_2' value='".$CustomerInfo['Delivery_Address_2']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-4 col-lg-4'>
                                    <label for='Delivery_City'>Delivery City</label>
                                    <input name='Delivery_City' value='".$CustomerInfo['Delivery_City']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-3 col-lg-2'>
                                    <label for='Delivery_State'>Delivery State</label>
                                    <select name='Delivery_State' class='form-control h-25 py-3' required>
                                        <option selected disabled>STATE</option>";
    foreach(Helper_State_List() as $State)
    {
        $Selected = $CustomerInfo['Delivery_State'] == $State ? 'selected' : '';
        echo "                          <option value='$State' $Selected>$State</option>";
    }
    echo "                          </select>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-4 col-lg-2'>
                                    <label for='Delivery_Zip'>Delivery Zip</label>
                                    <input name='Delivery_Zip' value='".$CustomerInfo['Delivery_Zip']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-8'>
                                    <label for='Notes'>Notes</label>
                                    <input name='Notes' value='".$CustomerInfo['Notes']."' type='textarea' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center mb-3'>
                                <button type='submit' class='btn btn-secondary'>".$FormInfo['ButtonTitle']."</button>
                            </div>";

    echo "              </div>
                    </form>
                </div>";
    echo "  </main>";