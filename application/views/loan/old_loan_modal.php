<!-- The Modal -->
<div class="modal" id="oldLoanModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Old Loan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!--                <h4 class="card-title">Basic form</h4>-->
                <!--                <p class="card-description">Basic form elements </p>-->
                <form id="oldLoanForm" action="#" method="post">



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer ID</label>
                                <input type="text" class="form-control" name="old_loan_cid" placeholder="Customer ID">
                                <p id="error_old_loan_cid" class="text-warning">Customer ID field is required!</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Loan Type</label>
                                <select class="form-control" name="old_loan_type">
                                    <?php
                                    if (!empty($get_loanTypes)) {
                                        foreach ($get_loanTypes as $row) {
                                            if (!empty($row['idloan_type'])) {
                                                echo $row['idloan_type'];
                                    ?>
                                                <option value="<?php echo $row['idloan_type'] ?>"><?php echo $row['loan_name'] ?></option>
                                            <?php } ?>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="old_loan_amount" placeholder="Amount">
                                <p id="error_old_loan_amount" class="text-warning">Loan amount field is required!</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Interest</label>
                                <input type="text" class="form-control" name="old_loan_interest" placeholder="Interest">
                                <p id="error_old_loan_interest" class="text-warning">Loan interest field is required!</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Duration (Months)</label>
                                <input type="text" class="form-control" name="old_loan_duration" placeholder="Duration">
                                <p id="error_old_loan_duration" class="text-warning">Loan duration field is required!</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Create Date</label>
                                <input type="text" class="form-control" name="old_loan_create_date" placeholder="YYYY/MM/DD">
                                <p id="error_old_loan_create_date" class="text-warning">Loan create date field is required!</p>
                                <p id="error_old_loan_create_date2" class="text-warning">Invalid Date!</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Current Loan Balance</label>
                                <input type="text" class="form-control" name="old_loan_balance" placeholder="Loan Balance">
                                <p id="error_old_loan_balance" class="text-warning">Loan balance field is required!</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Payment Date</label>
                                <input type="text" class="form-control" name="old_loan_last_payment_date" placeholder="YYYY/MM/DD">
                                <p id="error_old_loan_last_payment_date" class="text-warning">Loan last payment date field is required!</p>
                                <p id="error_old_loan_last_payment_date2" class="text-warning">Invalid Date!</p>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label>Loan Status</label>
                        <select class="form-control" name="loan_status">
                            <option value="Active">Active</option>
                            <option value="Belated">Belated</option>
                            <option value="Bad Debt">Bad Debt</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div> -->
                    <div class="text-right mt-5">
                        <button type="button" class="btn left btn-success mr-2" onclick="saveOldLoan()" id="loanFormSubmitBtn">Submit</button>
                        <button type="button" class="btn left btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <!--            <div class="modal-footer">-->
            <!--                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
            <!--            </div>-->

        </div>
    </div>
</div>


<script>
    var oldLoanInputArray = [
        'old_loan_cid',
        'old_loan_amount',
        'old_loan_interest',
        'old_loan_duration',
        'old_loan_create_date',
        'old_loan_balance',
        'old_loan_last_payment_date'
    ];
    var oldLoanDateInputArray = [
        'old_loan_create_date',
        'old_loan_last_payment_date'
    ];

    function createOldLoanModal() {
        selected_loan = null;
        $('#oldLoanForm')[0].reset();
        // $('.modal-title').text('Create Loan');
        $('#oldLoanModal').modal('show');
        hideOldLoanErrorMsgs();
    }

    function hideOldLoanErrorMsgs() {
        $.each(oldLoanInputArray, function(key, value) {
            $("#error_" + value).hide();
            if (oldLoanDateInputArray.includes(value)) {
                $("#error_" + value + "2").hide();
            }
        })
    }

    function checkOldLoanInputs() {
        let oldFormStatus = true;
        $.each(oldLoanInputArray, function(key, value) {
            let inputValue = $("input[name=" + value + "]").val();
            if (inputValue === "") {
                $("#error_" + value).show();
                oldFormStatus = false;
            } else {
                if (oldLoanDateInputArray.includes(value) && !moment(inputValue, "YYYY/MM/DD", true).isValid()) {
                    $("#error_" + value + "2").show();
                    oldFormStatus = false;
                }
            }
        });
        return oldFormStatus;
    }

    function saveOldLoan() {
        hideOldLoanErrorMsgs();
        let formStatus = checkOldLoanInputs();

        if (formStatus) {
            $.ajax({
                url: "<?php echo site_url('loan/old_loan_create') ?>",
                type: "POST",
                data: $('#oldLoanForm').serialize(),
                dataType: "JSON",
                success: function(data) {
                    console.log(data);

                    if (data.status) {
                        $('#oldLoanModal').modal('hide');
                        swal("Success!", "Loan saved successfully!", "success").then((value) => {
                            location.reload();
                        });
                        // if (selected_loan === null) {
                        //     swal("Success!", "Loan saved successfully!", "success").then((value) => {
                        //         location.reload();
                        //     });
                        // } else {
                        //     swal("Success!", "Loan updated successfully!", "success").then((value) => {
                        //         location.reload();
                        //     });
                        // }
                    } else {
                        swal("Oops", "Failed to Save Loan, " + data.error + "!", "error")
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                    alert(errorThrown);
                    alert(jqXHR);
                    swal("Oops", "Failed to Save Loan, Something went wrong!", "error")
                    // if (selected_loan === null) {
                    //     swal("Oops", "Failed to Save Loan, Something went wrong!", "error")
                    // } else {
                    //     swal("Oops", "Failed to Update Loan, Something went wrong!", "error")
                    // }
                }
            });
        } else {}
    }
</script>