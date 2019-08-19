<?php

/**
 * Created by PhpStorm.
 * User: buddhi_hasanka
 * Date: 09-Feb-19
 * Time: 4:57 PM
 */
?>


<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-1">
                            <button type="button" class="btn btn-icons btn-rounded btn-success" onclick="createModal()">
                                <i class="mdi mdi-plus"></i>
                            </button>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="search" id="searchLoan" class="form-control form-control-lg" placeholder="Type here what you want to search" aria-label="Search" />
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-rounded btn-fw" onclick="searchLoans()">Search
                            </button>
                        </div>
                        <div class="col-md-1">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="rowCountDDBTN" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $rowCount[0] ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php foreach ($rowCount as $value) { ?>
                                        <a class="dropdown-item" onclick="setRowCount('<?php echo $value ?>')"><?php echo $value; ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="my-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Loan ID</th>
                                    <th>Customer</th>
                                    <th>Loan Type</th>
                                    <th>Amount</th>
                                    <th>Interest</th>
                                    <th>Duration</th>
                                    <th>Create Date</th>
                                    <th>Status</th>
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($get_loans)) {
                                    foreach ($get_loans as $row) { ?>
                                        <tr id="<?php if (!empty($row['idloan'])) {
                                                    echo $row['idloan'];
                                                } ?>">
                                            <td><?php if (!empty($row['idloan'])) {
                                                    echo $row['idloan'];
                                                } ?></td>
                                            <td><?php if (!empty($row['idcustomer'])) {
                                                    echo $row['idcustomer'];
                                                } ?></td>
                                            <td><?php if (!empty($row['loan_name'])) {
                                                    echo $row['loan_name'];
                                                } ?></td>
                                            <td><?php if (!empty($row['amount'])) {
                                                    echo $row['amount'];
                                                } ?></td>
                                            <td><?php if (!empty($row['interest'])) {
                                                    echo $row['interest'];
                                                } ?></td>
                                            <td><?php if (!empty($row['duration'])) {
                                                    echo $row['duration'];
                                                } ?></td>
                                            <td><?php if (!empty($row['date'])) {
                                                    echo $row['date'];
                                                } ?></td>
                                            <td><?php if (!empty($row['status'])) {
                                                    echo $row['status'];
                                                } ?></td>
                                            <td>
                                                <button type="button" class="btn btn-icons btn-rounded btn-secondary" onclick="editModal('<?php echo $row['idloan'] ?>')">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<!-- The Modal -->
<div class="modal" id="loanModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Loan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!--                <h4 class="card-title">Basic form</h4>-->
                <!--                <p class="card-description">Basic form elements </p>-->
                <form id="loanForm" action="#" method="post">
                    <div class="form-group">
                        <label>Customer ID</label>
                        <input type="text" class="form-control" name="loan_cid" placeholder="Customer ID">
                        <p id="error_loan_cid" class="text-warning">Customer ID field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Loan Type</label>
                        <select class="form-control" name="loan_type">
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
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="loan_amount" placeholder="Amount">
                        <p id="error_loan_amount" class="text-warning">Loan amount field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Interest</label>
                        <input type="text" class="form-control" name="loan_interest" placeholder="Interest">
                        <p id="error_loan_interest" class="text-warning">Loan interest field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Duration (Months)</label>
                        <input type="text" class="form-control" name="loan_duration" placeholder="Duration">
                        <p id="error_loan_duration" class="text-warning">Loan duration field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Loan Status</label>
                        <select class="form-control" name="loan_status">
                            <option value="Preparing">Preparing</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Canceled">Canceled</option>
                            <option value="Finished">Finished</option>
                        </select>
                    </div>
                    <div class="text-right mt-5">
                        <button type="button" class="btn left btn-success mr-2" onclick="save()" id="loanFormSubmitBtn">Submit</button>
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
    $('#my-table').dynatable({
        sorting: true
    });


    var inputArray = ['loan_cid', 'loan_amount', 'loan_interest', 'loan_duration'];
    var selected_loan = null;

    $(document).ready(function() {
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('queries[search]')) {
            $('#searchLoan').val(searchParams.get('queries[search]'));
        }
        if (searchParams.has('perPage')) {
            $('#rowCountDDBTN').html(searchParams.get('perPage'));
        }
    });

    function setRowCount(value) {
        $('#rowCountDDBTN').html(value);

        let searchParams = new URLSearchParams(window.location.search);
        if (value === 10 || value === '10') {
            if (searchParams.has('queries[search]')) {
                window.location.href = 'loans?queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = 'loans'
            }
        } else {
            if (searchParams.has('queries[search]')) {
                window.location.href = 'loans?perPage=' + value + '&queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = 'loans?perPage=' + value;
            }
        }
    }

    function createModal() {
        selected_loan = null;
        $('#loanForm')[0].reset();
        $('.modal-title').text('Create Loan');
        $('#loanModal').modal('show');
        hideErrorMsgs();
    }

    function hideErrorMsgs() {
        $.each(inputArray, function(key, value) {
            $("#error_" + value).hide();
        })
    }

    function checkInputs() {
        let formStatus = true;
        $.each(inputArray, function(key, value) {
            if ($("input[name=" + value + "]").val() === "") {
                $("#error_" + value).show();
                formStatus = false;
            } else {
                $("#error_" + value).hide();
            }
        });
        return formStatus;
    }

    function editModal(id) {
        selected_loan = id;
        hideErrorMsgs();
        $('.modal-title').text('Update Loan');
        $('#loanModal').modal('show');

        $.ajax({
            url: "<?php echo site_url('loan/get_loan') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="loan_number"]').val(data.idcustomer);
                $('[name="loan_cid"]').val(data.idcustomer);
                $('[name="loan_type"]').val(data.idloan_type);
                $('[name="loan_amount"]').val(data.amount);
                $('[name="loan_interest"]').val(data.interest);
                $('[name="loan_duration"]').val(data.duration);
                $('[name="loan_status"]').val(data.status);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        var url;
        // swal("Oops", "Failed to Save Loan, Something went wrong!", "error");

        let formStatus = checkInputs();

        if (formStatus) {

            if (selected_loan === null) {
                url = "<?php echo site_url('loan/loan_create') ?>";
            } else {
                url = "<?php echo site_url('loan/loan_update') ?>/" + selected_loan;
            }

            $.ajax({
                url: url,
                type: "POST",
                data: $('#loanForm').serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        $('#loanModal').modal('hide');
                        if (selected_loan === null) {
                            swal("Success!", "Loan saved successfully!", "success").then((value) => {
                                // location.reload();
                            });
                        } else {
                            swal("Success!", "Loan updated successfully!", "success").then((value) => {
                                // location.reload();
                            });
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                    alert(errorThrown);
                    alert(jqXHR);
                    if (selected_loan === null) {
                        swal("Oops", "Failed to Save Loan, Something went wrong!", "error")
                    } else {
                        swal("Oops", "Failed to Update Loan, Something went wrong!", "error")
                    }
                }
            });
        } else {}
    }

    function searchLoans() {
        let v = $('#searchLoan').val();
        if (v === "") {
            window.location.href = 'loans'
        } else {
            window.location.href = 'loans?queries[search]=' + v;
        }

    }


    function deleteLoan(id) {
        alert("Delete Button clicked with id " + id);
    }
</script>