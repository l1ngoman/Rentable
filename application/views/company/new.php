<?php

    echo "  <main class='container'>
                <header class='d-flex justify-content-center align-items-middle col-12'>
                    <nav class='d-flex flex-column'>
                        <div class='text-center'>
                            <h2 class='text-secondary text-center mb-1'>Add New Company</h2>
                        </div>
                    </nav>
                </header>";

    echo "      <form id='NewCompanyForm' action='/index.php/company/SubmitNewCompanyData' method='post' enctype='multipart/form-data'>";
    echo "          <div>
                        <label for='Company_Name'>Company Name</label>
                        <input name='Company_Name' placeholder='Name'>
                    </div>";

    echo "          <div>
                        <label for='Address_1'>Address 1</label>
                        <input name='Address_1' placeholder='123 Main St'>
                    </div>";

    echo "          <div>
                        <label for='Address_2'>Address 2</label>
                        <input name='Address_2' placeholder='Apt C'>
                    </div>";

    echo "          <div>
                        <label for='City'>City</label>
                        <input name='City' placeholder='San Diego'>
                    </div>";

    echo "          <div>
                        <label for='State'>State</label>
                        <input name='State' placeholder='CA'>
                    </div>";

    echo "          <div>
                        <label for='Zip'>Zip</label>
                        <input name='Zip' placeholder='92101'>
                    </div>";

    echo "          <div>
                        <label for='Country'>Country</label>
                        <input name='Country' placeholder='USA' value='USA'>
                    </div>";

    echo "          <div>
                        <label for='Phone'>Phone</label>
                        <input name='Phone' placeholder='800-555-5555'>
                    </div>";

    echo "          <div>
                        <label for='Fax'>Fax</label>
                        <input name='Fax' placeholder='800-555-5556'>
                    </div>";

    echo "          <div>
                        <label for='Website'>Website</label>
                        <input name='Website' placeholder='www.example.com'>
                    </div>";

    echo "          <div>
                        <label for='Sales_Tax_Rate'>Tax Rate</label>
                        <input name='Sales_Tax_Rate' placeholder='2.5%'>
                    </div>";

    echo "          <div>
                        <input type='submit' value='Add Company'>
                    </div>";

    echo "       </form>";
    echo "  </main>";
        

?>