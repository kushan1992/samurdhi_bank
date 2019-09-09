<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if (!empty($get_loan_detail)) {
                            foreach ($get_loan_detail as $row) {
                                ?>
                                <h3>Details</h3>
                                <div class="row blockquote">
                                    <?php
                                    if (!empty($row['idloan'])) {
                                        ?>

                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Loan ID</span>
                                                <br> <?php echo $row['idloan'] ?> </p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Loan Type</span>
                                                <br> <?php echo $row['loan_name'] ?> </p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Interest</span>
                                                <br> <?php echo $row['interest'] ?> %</p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Duration</span>
                                                <br> <?php echo $row['duration'] ?> Months</p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Amount</span> <br>
                                                Rs.<?php echo number_format($row['amount'], 2, ',', '.') ?> </p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Installment</span> <br>
                                                Rs.<?php echo number_format($row['installment'], 2, ',', '.') ?> </p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Loan Status</span>
                                                <br> <?php echo $row['status'] ?> </p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Loan Create Date</span>
                                                <br> <?php echo $row['date'] ?> </p>
                                        </div>

                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
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
                                <input type="text" name="search" id="searchLoan" class="form-control form-control-lg"
                                       placeholder="Type here what you want to search" aria-label="Search"/>
                            </div>

                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-rounded btn-fw"
                                        onclick="searchLoans('<?php echo $loan_id ?>')">Search
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
                                               onclick="setRowCount('<?php echo $value ?>', '<?php echo $loan_id ?>')"><?php echo $value; ?></a>
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
                                    <!--                                    <th>Installment Balance</th>-->
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Edit/Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($get_loan_schedule_detail)) {
                                    foreach ($get_loan_schedule_detail as $row) {
                                        ?>
                                        <tr id="<?php if (!empty($row['idpayment_schedule'])) {
                                            echo $row['idpayment_schedule'];
                                        } ?>">
                                            <td><?php if (!empty($row['idpayment_schedule'])) {
                                                    echo $row['idpayment_schedule'];
                                                } ?></td>
                                            <!--                                            <td>-->
                                            <!--                                                --><?php //if (!empty($row['installment_balance'])) {
                                            //                                                    ?>
                                            <!--                                                    Rs.--><?php //echo number_format($row['installment_balance'], 2, ',', '.') ?>
                                            <!--                                                    --><?php
                                            //                                                } ?>
                                            <!--                                            </td>-->
                                            <td><?php if (!empty($row['date'])) {
                                                    echo $row['date'];
                                                } ?></td>
                                            <td><?php if (isset($row['status'])) {
                                                    echo $row['status'] ? 'Paid' : 'Unpaid';
                                                } ?></td>
                                            <td>
                                                <button type="button" class="btn btn-icons btn-rounded btn-secondary"
                                                        onclick="editModal('<?php echo $row['idloan'] ?>')">
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
</div>

<script>
    $('#my-table').dynatable({
        sorting: true
    });

    $(document).ready(function () {
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('queries[search]')) {
            $('#searchLoan').val(searchParams.get('queries[search]'));
        }
        if (searchParams.has('perPage')) {
            $('#rowCountDDBTN').html(searchParams.get('perPage'));
        }
    });

    function searchLoans() {
        let v = $('#searchLoan').val();
        if (v === "") {
            window.location.href = id
        } else {
            window.location.href = id + '?queries[search]=' + v;
        }

    }


    function setRowCount(value, id) {
        $('#rowCountDDBTN').html(value);

        let searchParams = new URLSearchParams(window.location.search);
        if (value === 10 || value === '10') {
            if (searchParams.has('queries[search]')) {
                window.location.href = id + '?queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = id
            }
        } else {
            if (searchParams.has('queries[search]')) {
                window.location.href = id + '?perPage=' + value + '&queries[search]=' + searchParams.get('queries[search]');
            } else {
                window.location.href = id + '?perPage=' + value;
            }
        }
    }

</script>