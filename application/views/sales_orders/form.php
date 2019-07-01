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
                    <form id='".$FormInfo['FormID']."' action='".$FormInfo['Action']."' method='post' enctype='multipart/form-data'>
                        <div>
                            <input name='NumberOfEntries' value='2' hidden readonly>
                        </div>
                        <div class='row d-flex flex-column'>";
    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-8'>
                                    <label for='Customer_ID'>Customer</label>
                                    <select name='Customer_ID' class='form-control h-25 py-3 mb-5'>
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
                                    <label for='Item_ID1'>Item</label>
                                    <select name='Item_ID1' class='form-control h-25 py-3 mb-5'>
                                        <option value='' selected disabled>Item</option>";
    foreach($ItemList as $Item)
    {
        $Item_Name = $Item['Part_Number'].' - '.$Item['Item_Name'];
        // $Selected = $SalesOrderInfo['Customer_ID'] == $Customer['Customer_ID'] ? 'selected' : '';
        echo "                          <option value='".$Item['Item_ID']."' $Selected>$Item_Name</option>";
    }
    echo "                          </select>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-2'>
                                    <label for='SO_Item_Quantity1'>Qty</label>
                                    <input id='SO_Item_Quantity1' name='SO_Item_Quantity1' value='1' type='number' step='1' min='0' class='form-control h-25 py-3' onchange='UpdateExtAmount()'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-2'>
                                    <label for='SO_Item_Amount1'>Price</label>
                                    <input id='SO_Item_Amount1' name='SO_Item_Amount1' value='0.00' type='number' step='.01' min='0' class='form-control h-25 py-3' onchange='UpdateExtAmount()'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-2'>
                                    <label for='SO_Extended_Amount1'>Ext</label>
                                    <input id='SO_Extended_Amount1' name='SO_Extended_Amount1' value='0.00' type='number' step='any' min='0' class='form-control h-25 py-3' readonly>
                                </div>
                                <input name='SO_Item_Notes1' value='' hidden readonly>
                            </div>";

    echo "                  <div class='d-flex justify-content-center flex-wrap mb-0 pb-0'>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-5 col-lg-4'>
                                    <label for='Item_ID2'>Item</label>
                                    <select name='Item_ID2' class='form-control h-25 py-3 mb-5'>
                                        <option value='' selected disabled>Item</option>";
    foreach($ItemList as $Item)
    {
        $Item_Name = $Item['Part_Number'].' - '.$Item['Item_Name'];
        // $Selected = $SalesOrderInfo['Customer_ID'] == $Customer['Customer_ID'] ? 'selected' : '';
        echo "                          <option value='".$Item['Item_ID']."' $Selected>$Item_Name</option>";
    }
    echo "                          </select>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-2'>
                                    <label for='SO_Item_Quantity2'>Qty</label>
                                    <input id='SO_Item_Quantity2' name='SO_Item_Quantity2' value='1' type='number' step='1' min='0' class='form-control h-25 py-3' onchange='UpdateExtAmount()'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-2'>
                                    <label for='SO_Item_Amount2'>Price</label>
                                    <input id='SO_Item_Amount2' name='SO_Item_Amount2' value='0.00' type='number' step='.01' min='0' class='form-control h-25 py-3' onchange='UpdateExtAmount()'>
                                </div>
                                <div class='form-group mb-0 col-9 col-sm-7 col-md-2'>
                                    <label for='SO_Extended_Amount2'>Ext</label>
                                    <input id='SO_Extended_Amount2' name='SO_Extended_Amount2' value='0.00' type='number' step='any' min='0' class='form-control h-25 py-3' readonly>
                                </div>
                                <input name='SO_Item_Notes2' value='' hidden readonly>
                            </div>";

    echo "                  <div class='d-flex justify-content-center mb-3'>
                                <button type='submit' class='btn btn-secondary'>".$FormInfo['ButtonTitle']."</button>
                            </div>";

    echo "              </div>
                    </form>
                </div>";
    echo "  </main>";

?>

<script>

function UpdateExtAmount(){
    let qty = $("#SO_Item_Quantity").val();
    let cost = $("#SO_Item_Amount").val();

    let ext = qty * cost;

    $("#SO_Extended_Amount").val(ext);
}

</script>