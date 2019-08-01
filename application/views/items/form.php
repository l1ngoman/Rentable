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
// echo "<pre>";
// var_dump($ItemInfo);
// echo "</pre>";
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
                        <div class='row justify-content-center flex-wrap'>";
    echo "                  <div class='col-10 col-sm-8 col-md-6 col-lg-4 d-flex flex-column mb-0 pb-0 border border-light'>
                                <div class='form-group my-1'>
                                    <label for='Part_Number'>(*) Part No.</label>
                                    <input name='Part_Number' value='".$ItemInfo['Part_Number']."' type='text' class='form-control' placeholder='Part Number' required>
                                </div>
                                <div class='form-group my-1'>
                                    <label for='Item_Name'>(*) Item Name</label>
                                    <input name='Item_Name' value='".$ItemInfo['Item_Name']."' type='text' class='form-control' placeholder='Item Name' required>
                                </div>
                                <div class='form-group my-1'>
                                    <label for='Item_Category_ID'>(*) Item Category</label>
                                    <select name='Item_Category_ID' class='form-control' required>
                                        <option value='' selected disabled>Item Category</option>";
    foreach($ItemCategoryList as $Category)
    {
        $Selected = $ItemInfo['Item_Category_ID'] == $Category['Item_Category_ID'] ? 'selected' : '';
        echo "                          <option value='".$Category['Item_Category_ID']."' $Selected>".$Category['Name']."</option>";
    }
    echo "                          </select>
                                </div>";
    echo "                  </div>";

    echo "                  <div class='col-10 col-sm-8 col-md-6 col-lg-4 d-flex flex-column mb-0 pb-0 border border-light'>";
    echo "                      <div class='form-group my-1' title='Custom item attribute field.'>
                                    <label for='Item_Attribute'>Attribute</label>
                                    <input name='Item_Attribute' value='".$ItemInfo['Item_Attribute']."' class='form-control' type='text' maxlength='20'>
                                </div>
                                <div class='form-group my-1' title='Custom item size field.'>
                                    <label for='Item_Size'>Size</label>
                                    <input name='Item_Size' value='".$ItemInfo['Item_Size']."' class='form-control' type='text' maxlength='20'>
                                </div>
                                <div class='form-group my-1' title='Custom item size field.'>
                                    <label for='Item_Weight'>Weight</label>
                                    <input name='Item_Weight' value='".$ItemInfo['Item_Weight']."' class='form-control' type='text' maxlength='12'>
                                </div>
                            </div>";

    echo "                  <div class='col-10 col-sm-8 col-md-6 col-lg-4 d-flex flex-column mb-0 pb-0 border border-light'>
                                <div class='form-group my-1'>
                                    <label for='Vendor_ID'>(*) Vendor Name</label>
                                    <select name='Vendor_ID' class='form-control' required>
                                        <option value='' selected disabled>Vendor</option>";
    foreach($VendorList as $Vendor)
    {
        $Selected = $ItemInfo['Vendor_ID'] == $Vendor['Vendor_ID'] ? 'selected' : '';
        echo "                          <option value='".$Vendor['Vendor_ID']."' $Selected>".$Vendor['Vendor_Name']."</option>";
    }
    echo "                          </select>
                                </div>";

    echo "                      <div class='form-group my-1'>
                                    <label for='Vendor_Cost'>(*) Vendor Cost</label>
                                    <div class='input-group'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>$</span>
                                        </div>
                                        <input id='Vendor_Cost' name='Vendor_Cost' value='".$ItemInfo['Vendor_Cost']."' type='number' step='0.01' min='0.00' class='form-control' placeholder='0.00' onchange='ValidateCurrency()' required>
                                    </div>
                                </div>";

    echo "                      <div class='form-group my-1'>
                                    <label for='Sale_Price'>(*) Sale Price</label>
                                    <div class='input-group'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text'>$</span>
                                        </div>
                                        <input id='Sale_Price' name='Sale_Price' value='".$ItemInfo['Sale_Price']."' type='number' step='0.01' min='0.00' class='form-control' placeholder='0.00' onchange='ValidateCurrency()' required>
                                    </div>
                                </div>";
    echo "                  </div>";

    echo "                  <div class='col-10 col-sm-8 col-md-6 col-lg-4 d-flex flex-column mb-0 pb-0 border border-light'>";
    echo "                      <div class='form-group my-1' title='Select if this item is taxable or not.'>
                                    <label for='Taxable_Status'>(*) Taxable Status</label>";
    echo "                          <select name='Taxable_Status' class='form-control' required>";
    foreach($ItemTaxReasonList as $Tax)
    {
        // ATG:: IF ON THE NEW ITEM PAGE, DEFAULT TO TAXABLE ITEM
        if($FormInfo['PageTitle'] == 'New Item')
        {
            $Selected = $Tax['Reason_Title'] == 'Taxable' ? 'selected' : '';
        }
        // ATG:: ELSE IF ON EDIT PAGE, USE PRE-EXISTING INFO FROM ITEM RECORD
        else
        {
            $Selected = $ItemInfo['Item_Tax_Reason_ID'] == $Tax['Item_Tax_Reason_ID'] ? 'selected' : '';
        }
        echo "                          <option value='".$Tax['Tax_Reason_ID']."' title='".$Tax['Reason_Description']."' $Selected>".$Tax['Reason_Title']."</option>";
    }
    echo "                          </select>
                                </div>
                            </div>";

    echo "                  <div class='col-10 col-sm-8 col-md-6 col-lg-4 d-flex flex-column mb-0 pb-0 border border-light'>";
    echo "                      <div class='form-group my-1' title='Choose the base unit of measure for how you will stock inventory for this item.'>
                                    <label for='Stock_Unit_Name_ID'>(*) Base Unit for Stock</label>";
    echo "                          <select name='Stock_Unit_Name_ID' class='form-control' required>";
    foreach($ItemUnitNameList as $Unit)
    {
        // ATG:: IF ON THE NEW ITEM PAGE, DEFAULT TO EACH
        if($FormInfo['PageTitle'] == 'New Item')
        {
            $Selected = $Unit['Unit_Name'] == 'each' ? 'selected' : '';
        }
        // ATG:: ELSE IF ON EDIT PAGE, USE PRE-EXISTING INFO FROM ITEM RECORD
        else
        {
            $Selected = $ItemInfo['Stock_Unit_Name_ID'] == $Unit['Item_Unit_Name_ID'] ? 'selected' : '';
        }
        echo "                          <option value='".$Unit['Item_Unit_Name_ID']."' $Selected>".$Unit['Unit_Name']." (".$Unit['Unit_Abbreviation'].")</option>";
    }
    echo "                          </select>
                                </div>
                            </div>";

    echo "                  <div class='col-10 col-sm-8 col-md-6 col-lg-4 d-flex flex-column mb-0 pb-0 border border-light'>";
    echo "                      <div class='form-group my-1' title='Custom item notes.'>
                                    <label for='Item_Notes'>Notes</label>
                                    <textarea name='Item_Notes' value='".$ItemInfo['Item_Notes']."' class='form-control' style='resize: none' rows='4' maxlength='255'></textarea>
                                </div>
                            </div>";
    echo "              </div>"; // END ROW

    echo "              <div class='d-flex justify-content-center my-3'>
                            <button type='submit' class='btn btn-secondary'>".$FormInfo['ButtonTitle']."</button>
                        </div>";

    echo "          </form>
                </div>";
    echo "  </main>";