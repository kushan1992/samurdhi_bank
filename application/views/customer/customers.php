<?php

/**
 * Created by PhpStorm.
 * User: buddhi_hasanka
 * Date: 24-Feb-19
 * Time: 10:46 AM
 */
?>


<div class="main-panel" id="customerView">

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
                            <input type="text" name="search" id="searchCustomer" class="form-control form-control-lg" placeholder="Type here what you want to search" aria-label="Search" />
                        </div>

                        <!--                        <div class="col-md-2">-->
                        <!--                            <div class="dropdown">-->
                        <!--                                <button class="btn btn-primary dropdown-toggle" type="button" id="searchTypeDDBTN"-->
                        <!--                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--                                    --><?php //echo $search_types[0]['key']
                                                                    ?>
                        <!--                                </button>-->
                        <!--                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
                        <!--                                    --><?php //foreach ($search_types as $value) {
                                                                    ?>
                        <!--                                        <a class="dropdown-item"-->
                        <!--                                           onclick="setSearchType('--><?php //echo $value['key']
                                                                                                    ?>
                        <!--                                                   ','<?php //echo $value['value']
                                                                                    ?>//')">-->
                        <!--                                            <?php //echo $value['key'];
                                                                        ?></a>-->
                        <!--                                    --><?php //}
                                                                    ?>
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-rounded btn-fw" onclick="searchCustomers()">Search
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
                                    <th>Member Number</th>
                                    <th>Name</th>
                                    <th>NIC</th>
                                    <th>Occupation</th>
                                    <th>Create date</th>
                                    <th>State</th>
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody id="test">
                                <?php
                                if (!empty($get_customers)) {
                                    foreach ($get_customers as $row) { ?>
                                        <tr id="<?php if (!empty($row['idcustomer'])) {
                                                    echo $row['idcustomer'];
                                                } ?>">
                                            <td><?php if (!empty($row['memnumber'])) {
                                                    echo $row['memnumber'];
                                                } ?></td>
                                            <td><?php if (!empty($row['name'])) {
                                                    echo $row['name'];
                                                } ?></td>
                                            <td><?php if (!empty($row['nic'])) {
                                                    echo $row['nic'];
                                                } ?></td>
                                            <td><?php if (!empty($row['occupation'])) {
                                                    echo $row['occupation'];
                                                } ?></td>
                                            <td><?php if (!empty($row['date'])) {
                                                    echo $row['date'];
                                                } ?></td>
                                            <td><?php if (!empty($row['status'])) {
                                                    echo $row['status'];
                                                } ?></td>
                                            <td style="text-align: center;">
                                                <button type="button" class="btn btn-icons btn-rounded btn-secondary" onclick="editModal('<?php echo $row['idcustomer'] ?>')">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <a class="btn btn-icons btn-rounded btn-secondary" onclick="window.location.href='<?php echo base_url(); ?>customer/show_customer/<?php echo $row['idcustomer'];?>';">
                                                  <i class="mdi mdi-account-check"></i>
                                                </a>
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
<div class="modal" id="customerModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Customer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="customerForm" action="#" method="post">
                    <div class="form-group">
                        <label>Customer Number</label>
                        <input type="text" class="form-control" name="cus_number" placeholder="Customer Number">
                        <p id="error_cus_number" class="text-warning">Customer Number field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="cus_name" placeholder="Customer Name">
                        <p id="error_cus_name" class="text-warning">Customer Name field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>NIC</label>
                        <input type="text" class="form-control" name="cus_nic" placeholder="Customer NIC">
                        <p id="error_cus_nic" class="text-warning">Customer NIC field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="cus_address" placeholder="Customer Address">
                        <p id="error_cus_address" class="text-warning">Customer Address field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" class="form-control" name="cus_occupation" placeholder="Customer Occupation">
                        <p id="error_cus_occupation" class="text-warning">Customer Occupation field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="cus_status">
                            <option>Active</option>
                            <option>Deactive</option>
                        </select>
                    </div>
                    <div class="text-right mt-5">
                        <button type="button" class="btn left btn-success mr-2" onclick="save()" id="customerFormSubmitBtn">Submit
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


    var inputArray = ['cus_number', 'cus_name', 'cus_nic', 'cus_address', 'cus_occupation'];
    var selected_cus = null;
    var searchType = 'memnumber';

    $(document).ready(function() {
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('queries[search]')) {
            $('#searchCustomer').val(searchParams.get('queries[search]'));
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
                window.location.href = 'customers?queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = 'customers'
            }
        } else {
            if (searchParams.has('queries[search]')) {
                window.location.href = 'customers?perPage=' + value + '&queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = 'customers?perPage=' + value;
            }
        }
    }

    function createModal() {
        selected_cus = null;
        $('#customerForm')[0].reset();
        $('.modal-title').text('Create Customer');
        $('#customerModal').modal('show');
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
        selected_cus = id;
        hideErrorMsgs();
        $('.modal-title').text('Update Customer');
        $('#customerModal').modal('show');

        $.ajax({
            url: "<?php echo site_url('customer/get_customer_by_id') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="cus_number"]').val(data.memnumber);
                $('[name="cus_name"]').val(data.name);
                $('[name="cus_nic"]').val(data.nic);
                $('[name="cus_address"]').val(data.address);
                $('[name="cus_occupation"]').val(data.occupation);
                $('[name="cus_status"]').val(data.status);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        var url;

        let formStatus = checkInputs();

        if (formStatus) {

            if (selected_cus === null) {
                url = "<?php echo site_url('customer/cus_create') ?>";
            } else {
                url = "<?php echo site_url('customer/cus_update') ?>/" + selected_cus;
            }

            $.ajax({
                url: url,
                type: "POST",
                data: $('#customerForm').serialize(),
                dataType: "JSON",
                success: function(data) {
                    // if (data.status && data[0].code) {

                    //     var msg_part1 = "Failed to Save Customer";
                    //     if (selected_cus !== null) {
                    //         msg_part1 = "Failed to Update Customer";
                    //     }

                    //     if (data[0].code === 1062) {
                    //         swal("Oops", msg_part1 + ", Duplicate entry!", "error")
                    //     } else {
                    //         swal("Oops", msg_part1 + ", Something went wrong!", "error")
                    //     }
                    //     alert(data[0].message);

                    // } else {
                    //     $('#customerModal').modal('hide');
                    //     if (selected_cus === null) {
                    //         swal("Success!", "Customer saved successfully!", "success").then((value) => {
                    //             location.reload();
                    //         });
                    //     } else {
                    //         swal("Success!", "Customer updated successfully!", "success").then((value) => {
                    //             location.reload();
                    //         });
                    //     }
                    // }

                    $('#customerModal').modal('hide');
                    if (selected_cus === null) {
                        swal("Success!", "Customer saved successfully!", "success").then((value) => {
                            location.reload();
                        });
                    } else {
                        swal("Success!", "Customer updated successfully!", "success").then((value) => {
                            location.reload();
                        });
                    }
                },
                error: function(request, xhr, status) {
                    console.log(arguments);
                    console.log(request);

                    if (selected_cus === null) {
                        swal("Oops", "ERROR ----- Failed to Save Customer, Something went wrong!", "error")
                    } else {
                        swal("Oops", "ERROR ----- Failed to Update Customer, Something went wrong!", "error")
                    }
                }
            });
        } else {}
    }

    function searchCustomers() {
        let v = $('#searchCustomer').val();
        if (v === "") {
            window.location.href = 'customers'
        } else {
            window.location.href = 'customers?queries[search]=' + v;
        }

    }


    function deleteCustomer(id) {
        alert("Delete Button clicked with id " + id);
    }


</script>
