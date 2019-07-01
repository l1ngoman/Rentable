<!--
*************************************************
* File Name: vendors/form.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* Form to add or edit vendors.
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
                    <form id='NewVendorForm' action='".$FormInfo['Action']."' method='post' enctype='multipart/form-data'>
                        <div class='row d-flex flex-column'>";
                        
    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Vendor_Name'>Vendor Name</label>
                                    <input name='Vendor_Name' value='".$VendorInfo['Vendor_Name']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Website'>Website</label>
                                    <input name='Website' value='".$VendorInfo['Website']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Phone'>Phone</label>
                                    <input name='Phone' value='".$VendorInfo['Phone']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Fax'>Fax</label>
                                    <input name='Fax' value='".$VendorInfo['Fax']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Vendor_Address_1'>Vendor Address 1</label>
                                    <input name='Vendor_Address_1' value='".$VendorInfo['Vendor_Address_1']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Vendor_Address_2'>Vendor Address 2</label>
                                    <input name='Vendor_Address_2' value='".$VendorInfo['Vendor_Address_2']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-4 col-lg-4'>
                                    <label for='Vendor_City'>Vendor City</label>
                                    <input name='Vendor_City' value='".$VendorInfo['Vendor_City']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-3 col-lg-2'>
                                    <label for='Vendor_State'>Vendor State</label>
                                    <select name='Vendor_State' class='form-control h-25 py-3'>
                                        <option value='' selected disabled>STATE</option>";
    foreach(Helper_State_List() as $State)
    {
        $Selected = $VendorInfo['Vendor_State'] == $State ? 'selected' : '';
        echo "                          <option value='$State' $Selected>$State</option>";
    }
    echo "                          </select>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-4 col-lg-2'>
                                    <label for='Vendor_Zip'>Vendor Zip</label>
                                    <input name='Vendor_Zip' value='".$VendorInfo['Vendor_Zip']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-8'>
                                    <label for='Vendor_Notes'>Notes</label>
                                    <input name='Vendor_Notes' value='".$VendorInfo['Vendor_Notes']."' type='textarea' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center mb-3'>
                                <button type='submit' class='btn btn-secondary'>".$FormInfo['ButtonTitle']."</button>
                            </div>";

    echo "              </div>
                    </form>
                </div>";
    echo "  </main>";