<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Customer</h4>
          <?php echo form_open('customer/create_cus');?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Mem Number</label>
                  <div class="col-sm-9">
                    <input type="text" name="memNumber" class="form-control" />
                    <?php echo form_error('memNumber', '<p class="text-warning" >', '</p>'); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Customer Name</label>
                  <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" />
                    <?php echo form_error('name', '<p class="text-warning" >', '</p>'); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">NIC</label>
                  <div class="col-sm-9">
                    <input type="text" name="nic" class="form-control" />
                    <?php echo form_error('nic', '<p class="text-warning" >', '</p>'); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Address</label>
                  <div class="col-sm-9">
                    <input type="text" name="address" class="form-control" />
                    <?php echo form_error('address', '<p class="text-warning" >', '</p>'); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Occupation</label>
                  <div class="col-sm-9">
                    <input type="text" name="occupation" class="form-control" />
                    <?php echo form_error('occupation', '<p class="text-warning" >', '</p>'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <button type="submit" class="btn btn-success mr-2">Submit</button>
              </div>
            </div>
            </div>
            <?php
              if (isset($result_msg)) {
              echo "<p class='text-success'>";
              echo $result_msg;
              echo "</p>";
              }
              ?>
          </form>
        </div>
      </div>
    </div>

    <div class="content-wrapper">
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
         <?php 
        //  var_dump($get_customer);
         if(!empty($get_customer)){
          foreach ($get_customer as $row) { ?>
            <tr id="<?php if(!empty($row['idcustomer'])){ echo $row['idcustomer']; }?>">
  			            	<td><?php if(!empty($row['member_no'])){ echo $row['member_no']; }?></td>
  			            	<td><?php if(!empty($row['name'])){ echo $row['name']; }?></td>
  			              <td><?php if(!empty($row['nic'])){ echo $row['nic']; }?></td>
  			              <td><?php if(!empty($row['address'])){ echo $row['address']; }?></td>
                      <td><?php if(!empty($row['occupation'])){ echo $row['occupation']; }?></td>                      
                      <td><?php if(!empty($row['date'])){ echo $row['date']; }?></td>
                      <td><?php if(!empty($row['status'])){ echo $row['status']; }?></td>
                      <td>
                      <button type="button" class="btn btn-icons btn-rounded btn-secondary">
                          <i class="mdi mdi-pencil"></i>
                      </button>
                      <button type="button" class="btn btn-icons btn-rounded btn-danger">
                          <i class="mdi mdi-delete"></i>
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

<script>
$('#my-table').dynatable({
  sorting: true
});
</script>
