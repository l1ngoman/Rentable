<!--
*************************************************
* File Name: footer.php
*************************************************
* Authors:
*
* Andrew T. Garrett
*
*************************************************
* Description:
*
* Footer view for entire application. Load all 
* script files here.
*************************************************
-->


<!-- <script type="text/javascript" src="/salesOrder.js"></script> -->
<!-- <script src='js/bootstrap-dropselect.js'></script> -->

<script>
    
function UpdateExtAmount(fieldNumber){
    let qty = $("#SO_Item_Quantity"+fieldNumber).val();
    let cost = $("#SO_Item_Amount"+fieldNumber).val();

    let ext = qty * cost;
    ext = parseFloat(Math.round(ext * 100) / 100).toFixed(2);

    $("#SO_Extended_Amount"+fieldNumber).val(ext);
}

function UpdateExtAmountEditSO(Counter){
    let qty = $("#SO_Item_Quantity"+Counter).val();
    let cost = $("#SO_Item_Amount"+Counter).val();
    let Taxable_Status = $("#Taxable_Status"+Counter).val();
    let Tax_Rate = $("#Tax_Rate").val();
    let counter = $("#NumberOfEntries").val();
    let grandTotal = 0;
    let ext_tax = 0.00;
    let ext_tax_formatted = 0.00;


    // ATG:: GET NEW EXT AMOUNT
    let ext_amount = qty * cost;
    ext_amount_formatted = parseFloat(Math.round(ext_amount * 100) / 100).toFixed(2);

    if(Taxable_Status == 1)
    {
        // ATG:: GET NEW EXT TAX AMOUNT
        ext_tax = ext_amount * Tax_Rate;
        ext_tax_formatted = parseFloat(Math.round(ext_tax * 100) / 100).toFixed(2);
    }

    // ATG:: GET NEW TOTAL AMOUNT
    let total_amount = ext_amount + ext_tax;
    total_amount_formatted = parseFloat(Math.round(total_amount * 100) / 100).toFixed(2);

    $("#SO_Item_Tax_Amount"+Counter).val(ext_tax_formatted);
    $("#SO_Extended_Amount"+Counter).val(ext_amount_formatted);
    $("#SO_Item_Total_Amount"+Counter).val(total_amount_formatted);

    for(i=1; i <= counter; i++)
    {
        grandTotal += parseFloat($("#SO_Item_Total_Amount"+i).val());
    }
    grandTotal_formatted = parseFloat(Math.round(grandTotal * 100) / 100).toFixed(2);

    $("#SO_Extended_Order_Total").val(grandTotal_formatted);
}

function ValidateCurrency()
{
    const twoDecimals = Math.round(event.target.value * 100) / 100;
    $(`#${event.target.id}`).val(twoDecimals);
}

// $(function() {
//     $('#CustomerSearch').dropselect();
// })

</script>