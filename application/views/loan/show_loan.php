<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <?php

            if (!empty($get_loan_detail)) {
                foreach ($get_loan_detail as $row) { ?>
                  <h3>
                    <?php if (!empty($row['loan_name'])) {
                                echo $row['loan_name'];
                            } ?>

                  </h3>

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
            <h1>Payment</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
