<?php

/**
 * Created by PhpStorm.
 * User: buddhi_hasanka
 * Date: 09-Feb-19
 * Time: 4:58 PM
 */
?>

<div class="main-panel" id="loanTypeView">

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
                            <input type="text" name="search" id="searchLoanType" class="form-control form-control-lg" placeholder="Type here what you want to search" aria-label="Search" />
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-rounded btn-fw" onclick="searchLoanTypes()">Search
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
                                    <th>Loan Type</th>
                                    <th>State</th>
                                    <th class="float-right">Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody id="test">
                                <?php
                                if (!empty($get_loanTypes)) {
                                    foreach ($get_loanTypes as $row) { ?>
                                        <tr id="<?php if (!empty($row['idloan_type'])) {
                                                    echo $row['idloan_type'];
                                                } ?>">
                                            <td><?php if (!empty($row['loan_name'])) {
                                                    echo $row['loan_name'];
                                                } ?></td>
                                            <td><?php if (!empty($row['status'])) {
                                                    echo $row['status'];
                                                } ?></td>
                                            <td style="text-align: center;">
                                                <button type="button" class="btn btn-icons btn-rounded btn-secondary float-right" onclick="editModal('<?php echo $row['idloan_type'] ?>')">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <!--                                            <button type="button" class="btn btn-icons btn-rounded btn-danger">-->
                                                <!--                                                <i class="mdi mdi-delete"></i>-->
                                                <!--                                            </button>-->
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
<div class="modal" id="loanTypeModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Loan Type</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="loanTypeForm" action="#" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="loan_type_name" placeholder="LoanType Name">
                        <p id="error_loan_type_name" class="text-warning">Loan Type Name field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="loan_type_status">
                            <option>Active</option>
                            <option>Deactive</option>
                        </select>
                    </div>
                    <div class="text-right mt-5">
                        <button type="button" class="btn left btn-success mr-2" onclick="save()" id="loanTypeFormSubmitBtn">Submit
                        </button>
                        <button type="button" class="btn left btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
    $('#my-table').dynatable({
        sorting: true
    });


    var inputArray = ['loan_type_name'];
    var selected_loan_type = null;
    var searchType = 'memnumber';

    $(document).ready(function() {
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('queries[search]')) {
            $('#searchLoanType').val(searchParams.get('queries[search]'));
        }
        if (searchParams.has('perPage')) {
            $('#rowCountDDBTN').html(searchParams.get('perPage'));
        }
    });

    function setSearchType(key, value) {
        searchType = value;
        $('#searchTypeDDBTN').html(key);
    }

    function setRowCount(value) {
        $('#rowCountDDBTN').html(value);

        let searchParams = new URLSearchParams(window.location.search);
        if (value === 10 || value === '10') {
            if (searchParams.has('queries[search]')) {
                window.location.href = 'loan_types?queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = 'loan_types'
            }
        } else {
            if (searchParams.has('queries[search]')) {
                window.location.href = 'loan_types?perPage=' + value + '&queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = 'loan_types?perPage=' + value;
            }
        }
    }

    function createModal() {
        selected_loan_type = null;
        $('#loanTypeForm')[0].reset();
        $('.modal-title').text('Create Loan Type');
        $('#loanTypeModal').modal('show');
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
        selected_loan_type = id;
        hideErrorMsgs();
        $('.modal-title').text('Update LoanType');
        $('#loanTypeModal').modal('show');

        $.ajax({
            url: "<?php echo site_url('loan/get_loan_type') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="loan_type_name"]').val(data.loan_name);
                $('[name="loan_type_status"]').val(data.status);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        var url;
        // swal("Oops", "Failed to Save LoanType, Something went wrong!", "error");

        let formStatus = checkInputs();

        if (formStatus) {

            if (selected_loan_type === null) {
                url = "<?php echo site_url('loan/loan_type_create') ?>";
            } else {
                url = "<?php echo site_url('loan/loan_type_update') ?>/" + selected_loan_type;
            }

            $.ajax({
                url: url,
                type: "POST",
                data: $('#loanTypeForm').serialize(),
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#loanTypeModal').modal('hide');
                        if (selected_loan_type === null) {
                            swal("Success!", "LoanType saved successfully!", "success").then((value) => {
                                location.reload();
                            });
                        } else {
                            swal("Success!", "LoanType updated successfully!", "success").then((value) => {
                                location.reload();
                            });
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (selected_loan_type === null) {
                        swal("Oops", "Failed to Save LoanType, Something went wrong!", "error")
                    } else {
                        swal("Oops", "Failed to Update LoanType, Something went wrong!", "error")
                    }
                    alert(errorThrown);
                }
            });
        } else {}
    }

    function searchLoanTypes() {
        let v = $('#searchLoanType').val();
        if (v === "") {
            window.location.href = 'loan_types'
        } else {
            window.location.href = 'loan_types?queries[search]=' + v;
        }

    }


    function deleteLoanType(id) {
        alert("Delete Button clicked with id " + id);
    }
</script>