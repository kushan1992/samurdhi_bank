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
                            <button type="button" class="btn btn-icons btn-rounded btn-success">
                                <i class="mdi mdi-plus"></i>
                            </button>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="search" class="form-control form-control-lg"
                                   placeholder="Type here what you want to search" aria-label="Search"/>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-rounded btn-fw">Search</button>

                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-icons btn-rounded btn-info">
                                <i class="mdi mdi-magnify"></i>
                            </button>
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
                                <th>Address</th>
                                <th>Occupation</th>
                                <th>Active</th>
                                <th>Create date</th>
                                <th>Edit/Delete</th>

                            </tr>
                            </thead>

                            <tbody>
                            <!--                            --><?php
                            //                            //  var_dump($get_customer);
                            //                            if (!empty($get_customer)) {
                            //                                foreach ($get_customer as $row) { ?>
                            <!--                                    <tr id="--><?php //if (!empty($row['idcustomer'])) {
                            //                                        echo $row['idcustomer'];
                            //                                    } ?><!--">-->
                            <!--                                        <td>--><?php //if (!empty($row['member_no'])) {
                            //                                                echo $row['member_no'];
                            //                                            } ?><!--</td>-->
                            <!--                                        <td>--><?php //if (!empty($row['name'])) {
                            //                                                echo $row['name'];
                            //                                            } ?><!--</td>-->
                            <!--                                        <td>--><?php //if (!empty($row['nic'])) {
                            //                                                echo $row['nic'];
                            //                                            } ?><!--</td>-->
                            <!--                                        <td>--><?php //if (!empty($row['address'])) {
                            //                                                echo $row['address'];
                            //                                            } ?><!--</td>-->
                            <!--                                        <td>--><?php //if (!empty($row['occupation'])) {
                            //                                                echo $row['occupation'];
                            //                                            } ?><!--</td>-->
                            <!--                                        <td>--><?php //if (!empty($row['date'])) {
                            //                                                echo $row['date'];
                            //                                            } ?><!--</td>-->
                            <!--                                        <td>--><?php //if (!empty($row['status'])) {
                            //                                                echo $row['status'];
                            //                                            } ?><!--</td>-->
                            <!--                                        <td>-->
                            <!--                                            <button type="button" class="btn btn-icons btn-rounded btn-secondary">-->
                            <!--                                                <i class="mdi mdi-pencil"></i>-->
                            <!--                                            </button>-->
                            <!--                                            <button type="button" class="btn btn-icons btn-rounded btn-danger">-->
                            <!--                                                <i class="mdi mdi-delete"></i>-->
                            <!--                                            </button>-->
                            <!---->
                            <!--                                        </td>-->
                            <!---->
                            <!---->
                            <!--                                    </tr>-->
                            <!--                                    --><?php
                            //
                            //
                            //                                }
                            //                            }
                            //
                            //                            ?>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
