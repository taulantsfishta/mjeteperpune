<style>

    tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: medium;
}

.table-hover > tbody > tr:hover {
  background-color: #7395b3;
}
.no-border {
            border: none !important;
        }
.product_name, .quantity, .price, .code,.total_product_price {
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 0.1px solid #e4e7ea;;
}

textarea:focus, input:focus{
    outline: none;
}

.selected-row {
    background-color: #d1e7dd !important;
}

.table-col-5 { width: 5%; }
.table-col-35 { width: 35%; }
.table-col-12 { width: 12%; }
.table-col-36 { width: 41%; }
.table-col-20 { width: 20%; }

#total_price{
    border-right: none;
}

#total_price_employee{
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 1px solid #e4e7ea;;
}

#total_price_employee_name{
    border-right: none;
}

#search_results_container {
            width: 100%;
            height: auto;
            overflow-y: auto;
            transition: height 0.3s ease-in-out;
}

#employeeDetailsContainer {
        padding: 15px;
        margin-top: 20px;
        background-color: #f8f9fa;
        border: 1px solid #e4e7ea;
        border-radius: 5px;
    }
#employeeDetailsContainer h3 {
        margin-bottom: 10px;
}
table {
    width: 100%;
    border-collapse: collapse;
}

td, th {
    padding: 10px;
    text-align: center; /* Default horizontal centering */
    vertical-align: middle; /* Default vertical centering */
}

/* Custom CSS for larger modal */
#loanModal .modal-dialog {
    max-width: 50%; /* Adjust the percentage as needed */
    width: 50%; /* Ensure width matches max-width for consistency */
}

#loanModal .modal-content {
    font-size: 16px; /* Optional: Adjust font size for better readability */
}
</style>
<div class="row" id='employeesStructure'>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6"><input class="form-control" id="myInput" type="text" placeholder="Kerko..."></div>
            <div class="col-lg-3"></div>
        </div>
        <br>
        <table class="table table-bordered table-striped table-hover" data-tablesaw-mode="columntoggle" id="employeeData" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <thead>
                <tr>
                    <th  class="table-col-5">ID</th>
                    <th class="table-col-12">PUNËTORI</th>
                    <th class="table-col-12">KRIJIMI</th>
                    <th class="table-col-5">VEPRIMI</th>
                </tr>
            </thead>
            <tbody id="employeesStructureBody">
            <?php if(isset($employeeList)) { ?>
                    <?php foreach ($employeeList as $key => $value) { ?>
                    <tr data-id="<?php echo $value['id']; ?>">
                        <td class="table-col-5"><?php echo htmlspecialchars($value['id']); ?></td>
                        <td class="table-col-12"><?php echo htmlspecialchars($value['name']); ?></td>
                        <td class="table-col-12"><?php echo htmlspecialchars($value['created_at']); ?></td>
                        <td class="table-col-5"><a href="<?php echo base_url('admin/employee/delete_employee/' . $value['id']); ?>" data-toggle="modal" data-target="#confirmDeleteModal" data-employeeid="<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="icon-trash"></i></button></a></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                A jeni i sigurt qe deshironi te fshini kete punëtor?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                <a id="deleteProductLink" href="#" class="btn btn-danger">Fshije</a>
            </div>
        </div>
    </div>
</div>

<div class="row" id="employeeTableData" style="display:none;">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-5 text-left">
                <button type="button" class="btn btn-info" style="color:white;background:#7396CE;"  id="backButton"><i class="fa fa-arrow-left"></i> Kthehu</button>
            </div>
            <div class="col-lg-3">
                <p id="employeeName" style="font-size:15px;"></p>
            </div>
            <div class="col-lg-3">
                <p id="employeeName" style="font-size:15px;"></p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div id="search_results_container" >
                <table class="table table-bordered table-striped table-hover" data-tablesaw-mode="columntoggle" id="search_results_table" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;"  style="display: none;">
                        <thead>
                            <tr>
                                <th class="table-col-8">FILLIMI I PUNËS</th>
                                <th class="table-col-10">RROGA KRYESORE</th>
                                <th class="table-col-10">RROGA DITORE</th>
                                <th class="table-col-10">RROGA DERI NE KETE DITE TE MUAJIT</th>
                                <th class="table-col-10">RROGA MUJORE PAS HUAS SE MARRE</th>
                                <th class="table-col-10">DETAJET PER HUAT</th>
                            </tr>
                        </thead>
                        <br>
                        <tbody id="search_results_body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="employeeLoanTableData" style="display:none;">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3 text-left">
                <button type="button" class="btn btn-info" style="color:white;background:#7396CE;"  id="backButtonEmployeeDetails"><i class="fa fa-arrow-left"></i> Kthehu</button>
            </div>
            <div class="col-lg-5">
            </div>
            <div class="col-lg-2">
                <p id="addLoan" style="font-size:15px;" data-toggle="modal" data-target="#loanModal" data-employee-id="123">
                    <button class="btn btn-block" style="background:#ffcd35;"> 
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;Shto Huan
                    </button>
                </p>
            </div>
            <div class="col-lg-2">
                <p id="addPrepayment" data-toggle="modal" data-target="#prepaymentModal" style="font-size:15px;">
                    <button class="btn btn-block" style="background:#ffcd35;"> 
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;Shto Parapagimin
                    </button>
                </p>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-6">
                <p id="employeeLoanName" style="font-size:15px;"></p>  
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="search_results_container" >
                    <table class="table table-bordered table-striped table-hover" data-tablesaw-mode="columntoggle" id="search_results_loan_table" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;"  style="display: none;">
                            <thead>
                                <tr>
                                    <th class="table-col-8">ID</th>
                                    <th class="table-col-10">SHUMA E HUAS</th>
                                    <th class="table-col-10">KOHEZGJATJA NE MUAJ E HUAS</th>
                                    <th class="table-col-10">SHUMA E MBETUR</th>
                                    <th class="table-col-10">SHUMA E ZBRITUR NE MUAJ</th>
                                    <th class="table-col-10">PARAPAGIMI I HUAS</th>
                                    <th class="table-col-10">DATA</th>
                                </tr>
                            </thead>
                            <br>
                            <tbody id="search_results_loan_body"></tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="prepaymentModal" tabindex="-1" role="dialog" aria-labelledby="prepaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prepaymentModalLabel">Konfirmo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
                A jeni i sigurt qe deshironi te fshini kete punëtor?
            </div> -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                <a id="deleteProductLink" href="#" class="btn btn-danger">Fshije</a>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="loanModal" tabindex="-1" role="dialog" aria-labelledby="loanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loanModalLabel">SHTO HUAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-sm-3 col-xs-3"></div>
                <div class="col-sm-6 col-xs-6">
                    <!-- The form action will be updated dynamically via JS -->
                    <form method="post" action="#">
                        <div class="form-group">
                            <label for="loan_amount" class="col-sm-12 control-label col-form-label"><b>SHUMA E HUAS: </b></label>
                            <input type="text" class="form-control" id="loan_amount" name="loan_amount" placeholder="" required style='font-size:15px;'>
                        </div>
                        <div class="form-group">
                            <label for="months" class="col-sm-12 control-label col-form-label"><b>KOHEZGJATJA NE MUAJ E HUAS:</b></label>
                            <input type="text" class="form-control" id="months" name="months" placeholder="" required style='font-size:15px;'>
                        </div>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <br><br>
                        <div class="form-group">
                            <button type="submit" class="col-sm-12 col-xs-12 btn btn-block btn-info">Ruaj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var employeeId;
    // Store the base URL dynamically
    window.base_url = <?php echo json_encode(base_url()); ?>;

    // Filter employees based on input
    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#employeesStructureBody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Back button functionality
    $("#backButton").click(function () {
        $("#employeeTableData").hide(); // Hide the details table
        $("#employeesStructure").show(); // Show the main employee list
    });

    $("#backButtonEmployeeDetails").click(function () {
        $("#employeesStructure").hide(); // Show the main employee list
        $("#employeeLoanTableData").hide(); // Show the main employee list
        $("#employeeTableData").show(); // Hide the details table
    });

    // Event listener for clicking on a row to load employee details
    $("#employeeData").on("click", "tr", function (e) {
        if (e.target.tagName === "TD" || e.target.tagName === "TR") {
            employeeId = $(this).data("id"); // Get employee ID from the row
            loadDetailsTable(employeeId); // Call the function to fetch and display details
        }
    });

    // Load the employee's details into the table
    function loadDetailsTable(employeeId) {
        $.ajax({
            url: window.base_url + "admin/employee/get_employee_details", // Adjust to match your endpoint
            method: "GET",
            data: { id: employeeId }, // Pass the employee ID to the server
            success: function (response) {
                // Populate the details container with the data
                $("#employeeTableData .white-box").html(response);

                // Show the details table and hide the main table
                $("#employeesStructure").hide();
                $("#employeeTableData").show();

                var results = JSON.parse(response);
                var resultsOne = results.employeeDetails;
                
                document.getElementById('employeeName').textContent = results.employeeName;

                var tableBody = $('#search_results_body');
                tableBody.empty(); // Clear existing results

                if (resultsOne.length > 0) {
                    $.each(resultsOne, function(index, result) {
                        var searchRow = `
                            <tr tabindex="0">
                                <td class="table-col-8">${result.month_year}</td>
                                <td class="table-col-10">${result.salary}</td>
                                <td class="table-col-10">${result.daily_paid_per_month}</td>
                                <td class="table-col-10">${result.salary_to_this_day}</td>
                                <td class="table-col-10">${result.salary_after_loan}</td>
                                <td class="table-col-10"><button type="submit" onclick="loadLoanTable(${employeeId})" class="btn" style="color:white;background:#7396CE;text-align: center;" ><i class="fa fa-edit"></i> DETAJET</button></td>
                            </tr>
                        `;
                        tableBody.append(searchRow);
                    });

                    // Show the search results table
                    $('#search_results_table').show();
                }
                
            },
            error: function (error) {
                console.error("Error fetching employee details:", error);
                alert("Could not fetch employee details. Please try again.");
            },
        });
    }

    $("#addLoan").click(function () {
        // Update the form action dynamically
        $("#loanModal").find("form").attr("action", window.base_url + "admin/employee/add_loan_employee/" + employeeId);

        // Optionally set any additional modal data if needed
        console.log("Employee ID set for loan:", employeeId);
    });
});

function loadLoanTable(employeeId){
        $.ajax({
            url: window.base_url + "admin/employee/get_employee_loan_details", // Adjust to match your endpoint
            method: "GET",
            data: { id: employeeId }, // Pass the employee ID to the server
            success: function (response) {
                // Populate the details container with the data
                $("#employeeLoanTableData .white-box").html(response);

                // Show the details table and hide the main table
                $("#employeesStructure").hide();
                $("#employeeTableData").hide();
                $("#employeeLoanTableData").show();

                var results = JSON.parse(response);
                var resultsOne = results.employeeLoanDetails;
                
                document.getElementById('employeeLoanName').textContent = results.employeeName;

                var tableBody = $('#search_results_loan_body');
                tableBody.empty(); // Clear existing results

                if (resultsOne.length > 0) {
                    $.each(resultsOne, function(index, result) {
                        var searchRow = `
                            <tr tabindex="0">
                                <td class="table-col-2">${result.loan_id}</td>
                                <td class="table-col-8">${result.loan_amount}</td>
                                <td class="table-col-8">${result.months}</td>
                                <td class="table-col-8">${result.remaining_amount}</td>
                                <td class="table-col-8">${result.monthly_deduction}</td>
                                <td class="table-col-8">${result.prepayment_loan}</td>
                                <td class="table-col-8">${result.created_at}</td>
                            </tr>
                        `;
                        tableBody.append(searchRow);
                    });

                    // Show the search results table
                    $('#search_results_loan_table').show();
                }
                
            },
            error: function (error) {
                console.error("Error fetching employee details:", error);
                alert("Could not fetch employee details. Please try again.");
            },
        });
    }

$(document).ready(function() {
    // Listen for the modal's "Delete" button click event
    $('#confirmDeleteModal').on('show.bs.modal', function(e) {
    var employeeID = $(e.relatedTarget).data('employeeid'); // Get the product ID
    var deleteButton = $(this).find('#deleteProductLink'); // Get the "Delete" button in the modal

    // Update the "Delete" button link with the appropriate product ID
    deleteButton.attr('href', '<?php echo base_url("admin/employee/delete_employee/"); ?>' + employeeID);
    });
});

//MODALI I HUASA
$(document).ready(function() {
    // Listen for the modal's "Delete" button click event
    $('#loanModal').on('show.bs.modal', function(e) {
    var employeeID = $(e.relatedTarget).data('employeeid'); // Get the product ID
    var deleteButton = $(this).find('#deleteProductLink'); // Get the "Delete" button in the modal

    // Update the "Delete" button link with the appropriate product ID
    deleteButton.attr('href', '<?php echo base_url("admin/employee/delete_employee/"); ?>' + employeeID);
    });
});
</script>
