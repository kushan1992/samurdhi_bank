<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Role</h4>
          <?php echo form_open('admin/create_privilage');?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Role</label>
                  <div class="col-sm-9">
                    <input type="text" name="Role" class="form-control" />
                    <?php echo form_error('name', '<p class="text-warning" >', '</p>'); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Status</label>
                  <div class="col-sm-9">
                    <input type="text" name="status" class="form-control" />
                    <?php echo form_error('nic', '<p class="text-warning" >', '</p>'); ?>
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

        <div class="col-12 grid-margin">
          <div class="card">
          <div class="card-body">
          <div class="table-responsive">
            <table id="my-table" class="table table-hover">
            <thead>
             <tr>
               <th>Privilage</th>
               <th>Status</th>
               <th>Edit/Delete</th>
             </tr>
           </thead>

           <tbody>
             <?php
            //  var_dump($get_customer);
             if(!empty($get_privilage)){
              foreach ($get_privilage as $row) { ?>
                <tr id="<?php if(!empty($row['idprivilege'])){ echo $row['idprivilege']; }?>">
      			            	<td><?php if(!empty($row['privilege'])){ echo $row['privilege']; }?></td>
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
