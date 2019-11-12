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
                                                Rs.<?php echo number_format($row['amount'], 2, '.', ',') ?> </p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Installment</span> <br>
                                                Rs.<?php echo number_format($row['installment'], 2, '.', ',') ?> </p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Loan Status</span>
                                                <br> <?php echo $row['status'];
                                                                    $loan_status = $row['status']; ?> </p>
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
                                <button type="button" class="btn btn-icons btn-rounded btn-success" onclick="createModal()">
                                    <i class="mdi mdi-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="search" id="searchLoan" class="form-control form-control-lg" placeholder="Type here what you want to search" aria-label="Search" />
                            </div>

                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-rounded btn-fw" onclick="searchLoans('<?php echo $loan_id ?>')">Search
                                </button>
                            </div>
                            <div class="col-md-1">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="rowCountDDBTN" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo $rowCount[0] ?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php foreach ($rowCount as $value) { ?>
                                            <a class="dropdown-item" onclick="setRowCount('<?php echo $value ?>', '<?php echo $loan_id ?>')"><?php echo $value; ?></a>
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

                            <?php
                            $show_payment_schedule = false;
                            if ($show_payment_schedule) {
                                ?>


                                <table id="my-table" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Loan ID</th>
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
                                                    <td><?php if (!empty($row['date'])) {
                                                                        echo $row['date'];
                                                                    } ?></td>
                                                    <td><?php if (isset($row['status'])) {
                                                                        echo $row['status'] ? 'Paid' : 'Unpaid';
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

                            <?php
                            } else {
                                ?>
                                <table id="my-table" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Log ID</th>
                                            <th>Date</th>
                                            <th>Premium</th>
                                            <th>Interest</th>
                                            <th>Penalty</th>
                                            <th>Edit/Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (!empty($get_loan_payment_log)) {
                                                foreach ($get_loan_payment_log as $row) {
                                                    ?>
                                                <tr id="<?php if (!empty($row['idpayment_log'])) {
                                                                        echo $row['idpayment_log'];
                                                                    } ?>">
                                                    <td><?php if (!empty($row['idpayment_log'])) {
                                                                        echo $row['idpayment_log'];
                                                                    } ?></td>
                                                    <td><?php if (!empty($row['date'])) {
                                                                        echo $row['date'];
                                                                    } ?></td>
                                                    <td><?php if (!empty($row['premium'])) {
                                                                        echo 'Rs.' . number_format($row['premium'], 2, '.', ',');
                                                                    } ?></td>
                                                    <td><?php if (!empty($row['interest'])) {
                                                                        echo 'Rs.' . number_format($row['interest'], 2, '.', ',');
                                                                    } ?></td>
                                                    <td><?php if (!empty($row['penalty'])) {
                                                                        echo 'Rs.' . number_format($row['penalty'], 2, '.', ',');
                                                                    } else {
                                                                        echo 'Rs.0.00';
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
                            <?php
                            } ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- The Modal -->
<div class="modal" id="paymentModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Payment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <!-- Modal body -->
            <div class="modal-body">

                <div class="row blockquote">

                    <div class="col-md-6 d-flex">
                        <p><span class="font-weight-bold">BALANCE OF LOAN AMOUNT</span>
                            <br><span id="balance_of_loan_amount">0.00</span> </p>
                    </div>
                    <div class="col-md-6 d-flex">
                        <p><span class="font-weight-bold">Days</span>
                            <br> <span id="days">0</span> </p>
                    </div>
                    <div class="col-md-6 d-flex">
                        <p><span class="font-weight-bold">AMOUNT OF PAYABLE INSTALLMENTS</span>
                            <br><span id="amount_of_payable_installments">0.00</span> </p>
                    </div>
                    <div class="col-md-6 d-flex">
                        <p><span class="font-weight-bold">AMOUNT OF LATE INSTALLMENT</span>
                            <br><span id="amount_of_late_installments">0.00</span> </p>
                    </div>
                    <div class="col-md-6 d-flex">
                        <p><span class="font-weight-bold">INTEREST</span>
                            <br><span id="interest">0.00</span> </p>
                    </div>
                    <div class="col-md-6 d-flex">
                        <p><span class="font-weight-bold">FINE</span>
                            <br><span id="fine">0.00</span> </p>
                    </div>
                    <div class="col-md-6 d-flex">
                        <p><span class="font-weight-bold">MINIMUN PAYMENT</span>
                            <br><span id="minimum_payment">0.00</span> </p>
                    </div>
                    <div class="col-md-6 d-flex">
                        <p><span class="font-weight-bold">PAYABLE AMOUNT</span>
                            <br><span id="payable_amount">0.00</span> </p>
                    </div>
                </div>


                <?php
                if ($loan_status === "Bad_Debt") {
                    ?>
                    <!-- <blockquote class="blockquote blockquote-primary"> -->
                    <div class="display-4 text-danger text-center font-weight-bold text-uppercase">
                        Bad debt
                    </div>
                    <!-- </blockquote> -->
                    <?php
                    } else {

                        if ($loan_status === "Belated") {
                            ?>

                        <div class="display-4 text-warning text-center font-weight-bold text-uppercase">
                            Belated
                        </div>

                    <?php
                        }
                        ?>


                    <form id="paymentForm" action="#" method="post">
                        <div class="form-group">
                            <label>Payment</label>
                            <input type="text" class="form-control" name="payment" placeholder="Payment">
                            <p id="error_payment" class="text-warning"></p>
                        </div>


                        <div class="text-right mt-5">
                            <button type="button" class="btn left btn-success mr-2" onclick="save()" id="paymentFormSubmitBtn">
                                Submit
                            </button>
                            <button type="button" class="btn left btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                <?php
                }
                ?>


            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    $('#my-table').dynatable({
        sorting: true
    });

    $(document).ready(function() {
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('queries[search]')) {
            $('#searchLoan').val(searchParams.get('queries[search]'));
        }
        if (searchParams.has('perPage')) {
            $('#rowCountDDBTN').html(searchParams.get('perPage'));
        }
    });

    function searchLoans(id) {
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

    let loan_id = null;
    let loan_installment = null;
    let balance_of_loan_amount = 0;
    let days = 0;
    let amount_of_payable_installments = 0;
    let amount_of_late_installments = 0;
    let interest = 0;
    let fine = 0;
    let payable_amount = 0;
    let late_installments = [];

    function createModal() {

        let currentDate = new Date();
        // console.log('--------------------------------- currentDate - ', currentDate);

        let number_of_days_given_for_relief_period = 7;
        let rates_of_fine = 5;
        let rates_of_loan = 12 / 100;

        days = 0;
        balance_of_loan_amount = 0;
        amount_of_payable_installments = 0;
        amount_of_late_installments = 0;
        interest = 0;
        fine = 0;
        payable_amount = 0;


        let loan_detail = <?php echo json_encode($get_loan_detail); ?>;
        loan_id = loan_detail[0].idloan;
        loan_installment = loan_detail[0].installment;
        let payment_schedule = <?php echo json_encode($get_loan_schedule_detail); ?>;
        let payment_schedule2 = [];

        let get_loan_payment_log = <?php echo json_encode($get_loan_payment_log); ?>;
        let last_date;

        if (get_loan_payment_log.length === 1) {
            last_date = get_loan_payment_log[0].date;
        } else {
            last_date = loan_detail[0].date;
        }

        days = (formatDate(currentDate) - formatDate(last_date)) / (1000 * 60 * 60 * 24);

        function formatDate(date) {

            let d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) {
                month = '0' + month;
            }

            if (day.length < 2) {
                day = '0' + day;
            }

            return new Date([year, month, day].join('-'));
        }

        if (days >= 0) {
            if (payment_schedule.length > 0) {

                payment_schedule.forEach((item) => {

                    if (item.installment_balance > 0) {
                        balance_of_loan_amount += +item.installment_balance;
                    }

                    let date = new Date(item.date);

                    if (date < currentDate) {

                        // console.log('--------------------------------- date - ', date);

                        if (item.status === "0") {
                            payment_schedule2.push(item);
                        }

                        amount_of_payable_installments += +item.installment_balance;
                        if (item.fine_status === '0') {
                            late_installments.push(item.idpayment_schedule)
                            amount_of_late_installments += +item.installment_balance;
                        }

                    }
                });


                console.log('LATE INSTALLMENTS 001 - ', late_installments);

                balance_of_loan_amount = round(balance_of_loan_amount);
                amount_of_payable_installments = round(amount_of_payable_installments);
                amount_of_late_installments = round(amount_of_late_installments);

                if (payment_schedule2.length > 0) {

                    let last_date = new Date(payment_schedule2[0].date);
                    console.log("last date", last_date);
                    console.log("payment_schedule2", payment_schedule2);


                    if (payment_schedule2.length == 1) {

                        if (((currentDate - last_date) / (1000 * 60 * 60 * 24)) < number_of_days_given_for_relief_period) {
                            late_installments = [];
                            amount_of_late_installments = 0;
                        }

                        // if (((currentDate - last_date) / (1000 * 60 * 60 * 24)) < number_of_days_given_for_relief_period) {
                        //     late_installments = [];
                        //     amount_of_late_installments = 0;
                        // }

                    } else {

                        if (currentDate.getDate() == last_date.getDate()) {
                            late_installments.pop()
                            amount_of_late_installments -= payment_schedule2[0].installment_balance;
                        }

                    }
                }

            }

            interest = round(balance_of_loan_amount * rates_of_loan * (days / 365));

            if (amount_of_late_installments > 0) {
                fine = round(amount_of_late_installments * (rates_of_fine / 100)); // is this the right way?
            }

            payable_amount = amount_of_payable_installments + interest + fine;


            $('#balance_of_loan_amount').text(formatCurrency(balance_of_loan_amount));
            $('#days').text(days);
            $('#amount_of_payable_installments').text(formatCurrency(amount_of_payable_installments));
            $('#amount_of_late_installments').text(formatCurrency(amount_of_late_installments));
            $('#interest').text(formatCurrency(interest));
            $('#fine').text(formatCurrency(fine));
            $('#minimum_payment').text(formatCurrency(fine + interest));
            $('#payable_amount').text(formatCurrency(payable_amount));


            console.log('---------------------------------------------------');
            console.log('BALANCE OF LOAN AMOUNT = RS.', balance_of_loan_amount);
            console.log('---------------------------------------------------');
            console.log('DAYS -', days);
            console.log('---------------------------------------------------');
            console.log('AMOUNT OF LATE INSTALLMENTS = RS.', amount_of_late_installments);
            console.log('---------------------------------------------------');
            console.log('LATE INSTALLMENTS 002 - ', late_installments);
            console.log('---------------------------------------------------');
            console.log('AMOUNT OF PAYABLE INSTALLMENTS = RS.', amount_of_payable_installments);
            console.log('---------------------------------------------------');
            console.log('INTEREST = RS.', interest);
            console.log('---------------------------------------------------');
            console.log('FINE = RS.', fine);
            console.log('---------------------------------------------------');
            console.log('PAYABLE AMOUNT = RS.', payable_amount);
            console.log('---------------------------------------------------');


            if ($('#paymentForm')[0]) {
                $('#paymentForm')[0].reset();
                // $('.modal-title').text('Create Loan');
            }
            $('#paymentModal').modal('show');
            hideErrorMsgs();



        } else {
            alert("Date Error 01");
        }




    }

    function formatCurrency(num) {
        var p = num.toFixed(2).split(".");
        return "Rs." + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
            return num == "-" ? acc : num + (i && !(i % 3) ? "," : "") + acc;
        }, "") + "." + p[1];
    }

    var inputArray = ['payment'];

    function hideErrorMsgs() {
        // $.each(inputArray, function(key, value) {
        //     $("#error_" + value).hide();
        // })

        $("#error_payment").hide();
    }

    function checkInputs() {
        let formStatus = true;
        hideErrorMsgs();
        // $.each(inputArray, function(key, value) {
        //     if ($("input[name=" + value + "]").val() === "") {
        //         $("#error_" + value).show();
        //         formStatus = false;
        //     } else {
        //         $("#error_" + value).hide();
        //     }
        // });

        let val = $("input[name='payment']").val();
        formStatus = false;

        $("#error_payment").show();
        if (val === "") {
            $("#error_payment").text("Payment field is required!");
        } else if (!$.isNumeric(val)) {
            $("#error_payment").text("Please input numbers only!");
        } else if (val < (interest + fine)) {
            $("#error_payment").text("Payment shouldn't be less than minimum payment!");
        } else {
            formStatus = true;
            $("#error_payment").hide();
        }

        return formStatus;
    }


    function save() {
        let formStatus = checkInputs();

        if (formStatus) {

            let val = $("input[name='payment']").val();

            $.ajax({
                url: "<?php echo site_url('loan/payment_log_create') ?>",
                type: "POST",
                data: {
                    idloan: loan_id,
                    installment: loan_installment,
                    balance_of_loan_amount: balance_of_loan_amount,
                    days: days,
                    amount_of_payable_installments: amount_of_payable_installments,
                    amount_of_late_installments: amount_of_late_installments,
                    interest: interest,
                    fine: fine,
                    payable_amount: payable_amount,
                    late_installments: late_installments,
                    payment: val
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        $('#paymentModal').modal('hide');
                        swal("Success!", "Payment saved successfully!", "success").then((value) => {
                            location.reload();
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus);
                    alert(errorThrown);
                    alert(jqXHR);
                    swal("Oops", "Failed to Save Payment, Something went wrong!", "error")
                }
            });

        }
    }


    function round(value) {
        return Math.round(value * 100) / 100;
    }
</script>