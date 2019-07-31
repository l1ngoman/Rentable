<?php
// *************************************************
// * File Name: sales_orders/edit.php
// *************************************************
// * Authors:
// *
// * Andrew T. Garrett
// *
// *************************************************
// * Description:
// *
// * Edit page for each sales order
// *************************************************


$Customer_Name          = $SalesOrderInfo['First_Name'].' '.$SalesOrderInfo['Last_Name'];
$SO_ID                  = $SalesOrderInfo['SO_ID'];
$User_Order_Date        = $SalesOrderInfo['User_Input_Order_Date'];
$User_Delivery_Date     = $SalesOrderInfo['User_Input_Delivery_Date'];
$SO_Notes               = $SalesOrderInfo['SO_Notes'];
$Order_Total            = 0.00;
$Counter                = 0;
$Hidden_Fields          = "<div class='container'>";

echo "  <form id='EditSalesOrderForm' action='/index.php/sales_orders/AddItemExistingSalesOrder' method='post' enctype='multipart/form-data'>
            <div class='container-fluid'>
                <div class='row'>
                    <div class='col-12'>
                        <div class='d-flex justify-content-around'>
                            <div class='d-flex align-items-center'>
                                <div class='d-flex flex-column'>
                                    <div class='d-flex align-items-center font-weight-bold'>
                                        Order # $SO_ID
                                    </div>
                                    <div class='font-weight-bold'>
                                        Customer: 
                                    </div>
                                </div>
                                <div class=''>
                                    <select name='Customer_ID' class='form-control w-100' required>
                                        <option value='' selected disabled>Customer</option>";
foreach($CustomerList as $Customer)
{
$Customer_Name = $Customer['Last_Name'].', '.$Customer['First_Name'];
$Selected = $SalesOrderInfo['Customer_ID'] == $Customer['Customer_ID'] ? 'selected' : '';
echo "                                          <option value='".$Customer['Customer_ID']."' $Selected>$Customer_Name</option>";
}
echo "                              </select>
                                </div>
                            </div>
                            <div class='d-flex flex-column'>
                                <div class='input-group justify-content-end'>
                                    <label>Order Date:</label>
                                    <input name='User_Input_Order_Date' class='text-center' value='$User_Order_Date' type='date' required>
                                </div>
                                <div class='input-group justify-content-end'>
                                    <label>Delivery Date:</label>
                                    <input name='User_Input_Delivery_Date' class='text-center' value='$User_Delivery_Date' type='date' required>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input name='SO_Notes' value='$SO_Notes' type='textarea'>
                        </div>";

// echo "                  <div class='container-fluid mb-0'>
//                             <div class='row no-gutters'>
//                                 <
//                             </div>
//                         </div>";


echo "                  <table class='table table-responsive-sm table-lg'>
                            <thead>
                                <tr>
                                    <td class='testing' scope='row'>Qty</td>
                                    <td colspan='5'>Item Name</td>
                                    <td scope='col'>Price</td>
                                    <td scope='col'>Ext Price</td>
                                </tr>
                            </thead>
                            <tbody>";
foreach($SalesOrderItemsInfo as $ItemInfo)
{
    $Counter++;
    $SO_Item_ID      = $ItemInfo['SO_Item_ID'];
    $Part_Number     = $ItemInfo['Part_Number'];
    $Item_Name       = $ItemInfo['Item_Name'];
    $Taxable_Status  = $ItemInfo['Taxable_Status'];
    $Quantity        = $ItemInfo['SO_Item_Quantity'];
    $Price           = $ItemInfo['SO_Item_Amount'];
    $Item_Tax        = $ItemInfo['SO_Item_Tax'];
    $Ext_Tax         = $Item_Tax * $Quantity;
    $SubTotal        = $Price * $Quantity;
    $Ext_Total       = ($Price + $Item_Tax) * $Quantity;
    $Order_Total    += $Ext_Total;
    $Hidden_Fields  .= "<input id='SO_Item_ID$Counter' name='SO_Item_ID$Counter' value='$SO_Item_ID' hidden readonly>";
    $Hidden_Fields  .= "<input id='Taxable_Status$Counter' name='Taxable_Status$Counter' value='$Taxable_Status' hidden readonly>";

    echo "                      <tr class='container-fluid'>
                                    <td class='row'>
                                        <label for='SO_Item_Quantity$Counter'>
                                            <input id='SO_Item_Quantity$Counter' name='SO_Item_Quantity$Counter' value='$Quantity' class='text-center' type='number' min='1' step='any' onchange='UpdateExtAmountEditSO($Counter)'>
                                        </label>
                                    </td>
                                    <td colspan='5'>
                                        $Part_Number - $Item_Name
                                    </td>
                                    <td class=''>
                                        <label for='SO_Item_Amount$Counter'>
                                            <input id='SO_Item_Amount$Counter' name='SO_Item_Amount$Counter' value='$Price' onchange='UpdateExtAmountEditSO($Counter)'>
                                        </label>
                                    </td>
                                    <td class=''>
                                        <label for='SO_Extended_Amount$Counter'>
                                            <input id='SO_Extended_Amount$Counter' name='SO_Extended_Amount$Counter' value='$SubTotal' readonly>
                                        </label>
                                    </td>
                                </tr>";
}
echo "                          <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>TOTAL:</td>
                                    <td>
                                        <input id='SO_Extended_Order_Total' name='SO_Extended_Order_Total' value='$Order_Total' readonly>
                                    </td>
                                </tr>";
echo "                      </tbody>
                        </table>
                        </div>";
echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                            <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                <label for='New_Item_ID'>Item</label>
                                <select name='New_Item_ID' class='form-control h-25 py-3 mb-5'>
                                    <option value='' selected disabled>Item</option>";
foreach($ItemList as $Item)
{
    $Item_Name = $Item['Part_Number'].' - '.$Item['Item_Name'];
    echo "                          <option value='".$Item['Item_ID']."'>$Item_Name</option>";
}
echo "                          </select>";

echo "                          <button type='submit' class='bt btn-secondary'>Add Item</button>";
echo "                      </div>
                        </div>";
$Hidden_Fields .= "<input id='SO_ID' name='SO_ID' value='$SO_ID' hidden readonly>";
$Hidden_Fields .= "<input id='Tax_Rate' name='Tax_Rate' value='$Tax_Rate' hidden readonly>";
$Hidden_Fields .= "<input id='NumberOfEntries' name='NumberOfEntries' value='$Counter' hidden readonly>";                        
$Hidden_Fields .= "</div>";
echo $Hidden_Fields;
echo "              </div> <!-- END COL-10 -->
                </div> <!-- END ROW -->
            </div> <!-- END CONTAINER-FLUID -->
        </form>"; 