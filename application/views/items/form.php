<!--
*************************************************
* File Name: items/form.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* Form to add or edit items.
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
                    <form id='".$FormInfo['FormID']."' action='".$FormInfo['Action']."' method='post' enctype='multipart/form-data'>
                        <div class='row d-flex flex-column'>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-4 col-lg-4'>
                                    <label for='Date_In_Service'>(*) Date In Service</label>";

    // ATG:: IF THIS IS A NEW ENTRY, IE. DATE IS BLANK, DEFAULT IT TO TODAY'S DATE
    $Date = $ItemInfo['Date_In_Service'] == '' ? $Today : date('Y-m-d',strtotime($ItemInfo['Date_In_Service']));

    echo "                          <input name='Date_In_Service' value='$Date' type='date' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-4 col-lg-4'>
                                    <label for='Taxable_Status'>(*) Tax</label>";

    $Tax = $ItemInfo['Taxable_Status'] == '1' ? 'selected' : '';
    $Non = $ItemInfo['Taxable_Status'] == '0' ? 'selected' : '';

    echo "                          <select name='Taxable_Status' class='form-control h-25 py-3'>
                                        <option value='1' $Tax>Taxable</option>
                                        <option value='0' $Non>Non-Taxable</option>
                                    </select>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Part_Number'>(*) Part No.</label>
                                    <input name='Part_Number' value='".$ItemInfo['Part_Number']."' type='text' class='form-control h-25 py-3' required>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Item_Name'>(*) Item Name</label>
                                    <input name='Item_Name' value='".$ItemInfo['Item_Name']."' type='text' class='form-control h-25 py-3' required>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4 pb-4'>
                                    <label for='Vendor_ID'>(*) Vendor</label>
                                    <select name='Vendor_ID' class='form-control h-50 py-3' required>
                                        <option value='' selected disabled>Vendor</option>";
    foreach($VendorList as $Vendor)
    {
        $Selected = $ItemInfo['Vendor_ID'] == $Vendor['Vendor_ID'] ? 'selected' : '';
        echo "                          <option value='".$Vendor['Vendor_ID']."' $Selected>".$Vendor['Vendor_Name']."</option>";
    }
    echo "                          </select>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4 pb-4'>
                                    <label for='Item_Category_ID'>(*) Category</label>
                                    <select name='Item_Category_ID' class='form-control h-50 py-3' required>
                                        <option value='' selected disabled>Category</option>";
    foreach($ItemCategoryList as $Category)
    {
        $Selected = $ItemInfo['Item_Category_ID'] == $Category['Item_Category_ID'] ? 'selected' : '';
        echo "                          <option value='".$Category['Item_Category_ID']."' $Selected>".$Category['Name']."</option>";
    }
    echo "                          </select>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Serial_Number'>Serial No.</label>
                                    <input name='Serial_Number' value='".$ItemInfo['Serial_Number']."' type='text' class='form-control h-25 py-3'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Tracking_Number'>Tracking No.</label>
                                    <input name='Tracking_Number' value='".$ItemInfo['Tracking_Number']."' type='text' class='form-control h-25 py-3'>
                                </div>
                            </div>";

    echo "                  <div class='d-flex justify-content-center mb-3'>
                                <button type='submit' class='btn btn-secondary'>".$FormInfo['ButtonTitle']."</button>
                            </div>";

    echo "              </div>
                    </form>
                </div>";
    echo "  </main>";