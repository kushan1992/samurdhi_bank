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
                                            <p><span class="font-weight-bold">Today Date</span>
                                                <br> <?php echo $row['idloan'] ?> </p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Late Days</span>
                                                <br> <?php echo $row['loan_name'] ?> </p>
                                        </div>
                                        <div class="col-md-2 d-flex">
                                            <p><span class="font-weight-bold">Number of Arrears Installments</span>
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


                        <!--                        --><?php
                        //                        $sd = '2010-01-29';
                        //                        $date = '29';
                        //                        $month = '01';
                        //                        $year = '2010';
                        //                        $d = new DateTime($sd);
                        //                        $td = new DateTime($sd);
                        //
                        //                        foreach (range(0, 10) as $i) {
                        //                            $d->modify('next month');
                        //                            $td->modify('last day of next month');
                        //
                        //                            if ($d->format('m') !== $d->format('m')) {
                        //                                echo $td->format('Y-m-d'), "\n<br>";
                        //                                $d = new DateTime($td->format('Y-m') . '-' . $date);
                        //                                $td = new DateTime($sd);
                        //                            } else {
                        //                                echo $d->format('Y-m-d'), "\n<br>";
                        //                            }
                        //                        }
                        //                        ?>

                        <!--                        --><?php
                        //                        $sd = '2010-01-29';
                        //                        $date = '29';
                        //                        $month = '01';
                        //                        $year = '2010';
                        //                        $d = new DateTime($sd);
                        //                        $td = new DateTime($sd);
                        //                        foreach (range(0, 10) as $i) {
                        //                            $d->modify('next month');
                        //                            $td->modify('last day of next month');
                        //                            echo $d->format('Y-m-d'),'<br>';
                        //                            echo $td->format('Y-m-d'),'<br>';
                        //                            if ($td->format('m') !== $d->format('m')) {
                        //                                echo '----------------------------------------------- 01 - '.$td->format('Y-m-d'), "\n<br>";
                        //                                $d->setDate($td->format('Y'), $td->format('m'), $date);
                        //                                $td->setDate($td->format('Y'), $td->format('m'), $date);
                        //                                echo '--------------- 03 - '.($td->format('Y').'-'.$td->format('m').'-'.$date),'<br>';
                        //                                echo '--------------- 03 - '.$td->format('Y-m-d'),'<br>';
                        //                            } else {
                        //                                echo '----------------------------------------------- 02 - '.$d->format('Y-m-d'), "\n<br>";
                        //                            }
                        ////                            $d->modify('next month');
                        ////                            echo $d->format('Y-m-d'), "\n<br>";
                        //                        }
                        //                        ?>

                        <!--                        --><?php
                        //                        $sd = '2010-01-29';
                        //                        $date = '31';
                        //                        $month = '01';
                        //                        $year = '2010';
                        //                        foreach (range(0, 10) as $i) {
                        //                            echo '--------------- 00 - ' . $month, '<br>';
                        //                            $d = new DateTime($year . '-' . $month . '-' . $date);
                        ////                            echo '----------------------------------------------- 01 - ' . $d->format('Y-m-d'), "\n<br>";
                        ////                            $d->modify('next month');
                        ////                            echo '--------------- 01 - ' . ($d->format('d') . '-' . $date), '<br>';
                        //                            if ($d->format('d') !== $date) {
                        //                                $td = new DateTime($year . '-' . $d->format('m'). '-'.$date);
                        //                                echo '----------------------------------------------- 04 - ' . $td->format('Y-m-d'), "\n<br>";
                        ////                                echo '--------------- 02 - ' . ($td->format('Y-m-d')), '<br>';
                        ////                                $td->modify('last day of next month');
                        //                                $month = $td->format('m');
                        //                                echo '--------------- 05 - ' . $month, '<br>';
                        //                            } else {
                        //                                $d->modify('next month');
                        //                                if ($d->format('d') !== $date) {
                        //                                    $td = new DateTime($year . '-' . $month . '-01');
                        //                                    echo '--------------- 06 - ' . ($td->format('Y-m-d')), '<br>';
                        //                                    $td->modify('last day of next month');
                        //                                    echo '----------------------------------------------- 07 - ' . $td->format('Y-m-d'), "\n<br>";
                        //                                    $month = $td->format('m');
                        //                                    echo '--------------- 08 - ' . $month, '<br>';
                        //                                } else {
                        //                                    echo '----------------------------------------------- 09 - ' . $d->format('Y-m-d'), "\n<br>";
                        //                                    $month = $d->format('m');
                        //                                    echo '--------------- 10 - ' . $month, '<br>';
                        //                                }
                        //                            }
                        //                        }
                        //                        ?>


                        <?php
                        $date = '31';
                        $month = '01';
                        $year = '2010';

                        foreach (range(1, 24) as $i) {
                            $d = new DateTime($year . '-' . $month . '-' . $date);

                            if ($d->format('d') !== $date) {

                                $td = new DateTime($year . '-' . $d->format('m') . '-' . $date);
                                echo '------------------------------------------------ ' . $i . ' - ' . $td->format('Y - m - d'), "\n<br>";
                                $month = $td->format('m');
                                $year = $td->format('Y');

                            } else {

                                $d->modify('next month');

                                if ($d->format('d') !== $date) {

                                    $td = new DateTime($year . '-' . $month . '-01');
                                    $td->modify('last day of next month');
                                    echo '------------------------------------------------ ' . $i . ' - ' . $td->format('Y - m - d'), "\n<br>";
                                    $month = $td->format('m');
                                    $year = $td->format('Y');

                                } else {

                                    echo '------------------------------------------------ ' . $i . ' - ' . $d->format('Y - m - d'), "\n<br>";
                                    $month = $d->format('m');
                                    $year = $d->format('Y');

                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
