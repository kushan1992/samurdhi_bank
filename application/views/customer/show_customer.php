<?php
if (!empty($get_customer)) {
    foreach ($get_customer as $row) { ?>


<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h3>
              <?php if (!empty($row['name'])) {
                          echo $row['name'];
                      } ?>

            </h3>
            <p class="card-description">
              <b>Member Number:</b> <?php if (!empty($row['memnumber'])) { echo $row['memnumber'];} ?><br/>
              <b>NIC Number:</b> <?php if (!empty($row['nic'])) { echo $row['nic'];} ?><br/>
              <b>Occupation:</b> <?php if (!empty($row['occupation'])) { echo $row['occupation'];} ?><br/>
            </p>
            <address>
              <p>
                <?php if (!empty($row['address'])) { echo $row['address'];} ?>
              </p>
            </address>

          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
             <h3>Loans details</h3>
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
                                <th>Interest</th>
                                <th>Duration</th>
                                <th>Amount</th>
                                <th>State</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (!empty($get_customer_loans)) {
                              foreach ($get_customer_loans as $row) { ?>
                                <tr id="<?php if (!empty($row['idloan'])) {
                                            echo $row['idloan'];
                                        } ?>">
                                        <td><?php if (!empty($row['loan_name'])) {
                                                echo $row['loan_name'];
                                            } ?></td>
                                        <td><?php if (!empty($row['interest'])) {
                                                echo $row['interest'];
                                            } ?>%</td>
                                        <td><?php if (!empty($row['duration'])) {
                                                echo $row['duration'];
                                            } ?></td>
                                        <td><?php if (!empty($row['amount'])) {
                                                echo $row['amount'];
                                            } ?></td>
                                        <td><?php if (!empty($row['status'])) {
                                                echo $row['status'];
                                            } ?></td>
                                        <td><?php if (!empty($row['date'])) {
                                                echo $row['date'];
                                            } ?></td>
                                        <td>
                                          <a class="btn btn-icons btn-rounded btn-secondary" onclick="window.location.href='<?php echo base_url(); ?>loan/show_loan/<?php echo $row['idloan'];?>';">
                                            <i class="mdi mdi-account-check"></i>
                                          </a>
                                        </td>

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

<?php
 }
}
?>
<script>
$('#my-table').dynatable({
    sorting: true
});
</script>
