// *************************************************
// * File Name: salesOrder.js
// *************************************************
// * Authors:
// *
// * Andrew T. Garrett
// *
// *************************************************
// * Description:
// *
// * All js functions for sales orders should go in 
// * this file.
// *************************************************


// function UpdateExtAmount(){
//     let qty = $("#SO_Item_Quantity1").val();
//     let cost = $("#SO_Item_Amount1").val();

//     let ext = qty * cost;
//     ext = parseFloat(Math.round(ext * 100) / 100).toFixed(2);

//     $("#SO_Extended_Amount1").val(ext);
// }

function UpdateExtAmountEditSO(Counter){
    let qty = $("#SO_Item_Quantity"+Counter).val();
    let cost = $("#SO_Item_Amount"+Counter).val();

    let ext = qty * cost;
    ext = parseFloat(Math.round(ext * 100) / 100).toFixed(2);

    $("#SO_Extended_Amount"+Counter).val(ext);
}

