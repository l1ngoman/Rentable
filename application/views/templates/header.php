

<!DOCTYPE html>

    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <title>Rentable</title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/189bc913c5.js"></script>
    </head>
    <body>
<?php
    echo "  
        <nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <a class='navbar-brand' href='#'>
                <strong>RENT<i class='fas fa-arrows-alt-h'></i>ABLE</strong>
            </a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNavDropdown' aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNavDropdown'>
                <ul class='navbar-nav'>";
    echo "          <li class='nav-item active'>
                        <a class='nav-link' href='#'>Home <span class='sr-only'>(current)</span></a>
                    </li>";
    echo "          <li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Customers
                        </a>
                        <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>";
    echo "                  <a class='dropdown-item' href='/index.php/customers/CustomerList'>Customer List</a>";
    echo "                  <div class='dropdown-divider'></div>
                            <a class='dropdown-item' href='/index.php/customers/NewCustomer'>New Customer</a>";
    echo "              </div>
                    </li>";
    echo "          <li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Inventory
                        </a>
                        <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>";
    echo "                  <a class='dropdown-item' href='#'>New Item</a>";
    // echo "                  <a class='dropdown-item' href='#'>Another action</a>";
    echo "              </div>
                    </li>";
    // echo "      <li class='nav-item'>
    //                 <a class='nav-link' href='#'>Features</a>
    //             </li>";

    echo "      </ul>
            </div>
        </nav>";