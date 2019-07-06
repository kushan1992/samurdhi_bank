<?php
/**
 * Created by PhpStorm.
 * User: buddhi_hasanka
 * Date: 05-Mar-19
 * Time: 8:28 AM
 */
?>


<div class="main-panel" id="usersView">

    <div class="content-wrapper">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-1">
                            <button type="button" class="btn btn-icons btn-rounded btn-success"
                                    onclick="createModal()">
                                <i class="mdi mdi-plus"></i>
                            </button>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="search" id="searchUsers" class="form-control form-control-lg"
                                   placeholder="Type here what you want to search" aria-label="Search"/>
                        </div>

                        <!--                        <div class="col-md-2">-->
                        <!--                            <div class="dropdown">-->
                        <!--                                <button class="btn btn-primary dropdown-toggle" type="button" id="searchTypeDDBTN"-->
                        <!--                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--                                    --><?php //echo $search_types[0]['key'] ?>
                        <!--                                </button>-->
                        <!--                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
                        <!--                                    --><?php //foreach ($search_types as $value) { ?>
                        <!--                                        <a class="dropdown-item"-->
                        <!--                                           onclick="setSearchType('--><?php //echo $value['key'] ?>
                        <!--                                                   ','<?php //echo $value['value'] ?>//')">-->
                        <!--                                            <?php //echo $value['key']; ?></a>-->
                        <!--                                    --><?php //} ?>
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-rounded btn-fw"
                                    onclick="searchUsers()">Search
                            </button>
                        </div>
                        <div class="col-md-1">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="rowCountDDBTN"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $rowCount[0] ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php foreach ($rowCount as $value) { ?>
                                        <a class="dropdown-item"
                                           onclick="setRowCount('<?php echo $value ?>')"><?php echo $value; ?></a>
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
                                <th>Name</th>
                                <th>Role</th>
                                <th>Create date</th>
                                <th>State</th>
                                <th>Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody id="test">
                            <?php
                            if (!empty($get_users)) {
                                foreach ($get_users as $row) { ?>
                                    <tr id="<?php if (!empty($row['iduser'])) {
                                        echo $row['iduser'];
                                    } ?>">
                                        <td><?php if (!empty($row['name'])) {
                                                echo $row['name'];
                                            } ?></td>
                                        <td><?php if (!empty($row['idrole'])) {
                                                echo $row['idrole'];
                                            } ?></td>
                                        <td><?php if (!empty($row['date'])) {
                                                echo $row['date'];
                                            } ?></td>
                                        <td><?php if (!empty($row['status'])) {
                                                echo $row['status'];
                                            } ?></td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-icons btn-rounded btn-secondary"
                                                    onclick="editModal('<?php echo $row['iduser'] ?>')">
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
<div class="modal" id="usersModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Users</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form id="usersForm" action="#" method="post">
                    <div class="form-group">
                        <label>Users Number</label>
                        <input type="text" class="form-control" name="cus_number"
                               placeholder="Users Number">
                        <p id="error_cus_number" class="text-warning">Users Number field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="cus_name"
                               placeholder="Users Name">
                        <p id="error_cus_name" class="text-warning">Users Name field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>NIC</label>
                        <input type="text" class="form-control" name="cus_nic"
                               placeholder="Users NIC">
                        <p id="error_cus_nic" class="text-warning">Users NIC field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="cus_address"
                               placeholder="Users Address">
                        <p id="error_cus_address" class="text-warning">Users Address field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" class="form-control" name="cus_occupation"
                               placeholder="Users Occupation">
                        <p id="error_cus_occupation" class="text-warning">Users Occupation field is required!</p>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="cus_status">
                            <option>Active</option>
                            <option>Deactive</option>
                        </select>
                    </div>
                    <div class="text-right mt-5">
                        <button type="button" class="btn left btn-success mr-2" onclick="save()"
                                id="usersFormSubmitBtn">Submit
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

    $(document).ready(function () {
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('queries[search]')) {
            $('#searchUsers').val(searchParams.get('queries[search]'));
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
                window.location.href = 'users?queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = 'users'
            }
        } else {
            if (searchParams.has('queries[search]')) {
                window.location.href = 'users?perPage=' + value + '&queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = 'users?perPage=' + value;
            }
        }
    }

    function createModal() {
        selected_cus = null;
        $('#usersModal').modal('show');
        hideErrorMsgs();
    }

    function hideErrorMsgs() {
        $.each(inputArray, function (key, value) {
            $("#error_" + value).hide();
        })
    }

    function checkInputs() {
        let formStatus = true;
        $.each(inputArray, function (key, value) {
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
        $('#usersModal').modal('show');

        $.ajax({
            url: "<?php echo site_url('users/get_users')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {

                $('[name="cus_number"]').val(data.memnumber);
                $('[name="cus_name"]').val(data.name);
                $('[name="cus_nic"]').val(data.nic);
                $('[name="cus_address"]').val(data.address);
                $('[name="cus_occupation"]').val(data.occupation);
                $('[name="cus_status"]').val(data.status);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        var url;
        swal("Oops", "Failed to Save Users, Something went wrong!", "error");

        let formStatus = checkInputs();

        if (formStatus) {

            if (selected_cus === null) {
                url = "<?php echo site_url('users/cus_create')?>";
            } else {
                url = "<?php echo site_url('users/cus_update')?>/" + selected_cus;
            }

            $.ajax({
                url: url,
                type: "POST",
                data: $('#usersForm').serialize(),
                dataType: "JSON",
                success: function (data) {

                    if (data.status) {
                        $('#usersModal').modal('hide');
                        if (selected_cus === null) {
                            swal("Success!", "Users saved successfully!", "success").then((value) => {
                                location.reload();
                            });
                        } else {
                            swal("Success!", "Users updated successfully!", "success").then((value) => {
                                location.reload();
                            });
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (selected_cus === null) {
                        swal("Oops", "Failed to Save Users, Something went wrong!", "error")
                    } else {
                        swal("Oops", "Failed to Update Users, Something went wrong!", "error")
                    }
                }
            });
        } else {
        }
    }

    function searchUsers() {
        let v = $('#searchUsers').val();
        if (v === "") {
            window.location.href = 'users'
        } else {
            window.location.href = 'users?queries[search]=' + v;
        }

        // if(searchParams.has('perPage')){
        //     if(searchParams.has('queries[search]')){
        //         let v2 = searchParams.get('queries[search]');
        //         window.location.href = '?queries[search]='+v+'&perPage='+v2;
        //         // searchParams.set('queries[search]',v);
        //     } else {
        //         window.location.href = '&queries[search]='+v;
        //     }
        // } else {
        //     window.location.href = '?queries[search]='+v;
        // }
        // var e = jQuery.Event("keypress");
        // e.which = 13; //choose the one you want
        // e.keyCode = 13;
        // $("#dynatable-query-search-my-table").trigger(e);

        //$.ajax({
        //    url: "<?php //echo site_url('users/cus_search')?>//",
        //    type: "POST",
        //    data: {searchType : searchType, text : text},
        //    success: function (data) {
        //        $("#test").html(data);
        //
        //        $('#my-table').dynatable({
        //            pushState: false,
        //            paginate: true,
        //            sort: true,
        //            recordCount: true
        //        });
        //
        //        // dynatable.dom.update();
        //
        //
        //    },
        //    error: function (jqXHR, textStatus, errorThrown) {
        //        alert('Error get data from ajax');
        //    }
        //});

        // var input, filter, table, tr, td, i, txtValue;
        // input = document.getElementById("searchUsers");
        // filter = input.value.toUpperCase();
        // table = document.getElementById("my-table");
        // tr = table.getElementsByTagName("tr");
        //
        //
        // for (i = 0; i < tr.length; i++) {
        //     td = tr[i].getElementsByTagName("td")[searchType];
        //     if (td) {
        //         txtValue = td.textContent || td.innerText;
        //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //             tr[i].style.display = "";
        //         } else {
        //             tr[i].style.display = "none";
        //         }
        //     }
        // }

    }


    function deleteUsers(id) {
        alert("Delete Button clicked with id " + id);
    }

</script>