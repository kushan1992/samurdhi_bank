<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Role</h4>
          <?php echo form_open('admin/create_role');?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Role</label>
                  <div class="col-sm-9">
                    <input type="text" name="role" class="form-control" />
                    <?php echo form_error('role', '<p class="text-warning" >', '</p>'); ?>
                  </div>
                </div>
              </div>
              <input type="hidden" name="status" value="Active" class="form-control" />
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
             if(!empty($get_roles)){
              foreach ($get_roles as $row) { ?>
                <tr id="<?php if(!empty($row['idrole'])){ echo $row['idrole']; }?>">
      			            	<td><?php if(!empty($row['role'])){ echo $row['role']; }?></td>
      			            	<td><?php if(!empty($row['status'])){ echo $row['status']; }?></td>
                          <td>
                          <button type="button" class="btn btn-icons btn-rounded btn-secondary" data-toggle="modal" data-target="#myModal">
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

  <!-- The Modal -->
 <div class="modal" id="myModal">
   <div class="modal-dialog">
     <div class="modal-content">

       <!-- Modal Header -->
       <div class="modal-header">
         <h4 class="modal-title">Update Role</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>

       <!-- Modal body -->
       <div class="modal-body">

       </div>

       <!-- Modal footer -->
       <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       </div>

     </div>
   </div>
 </div>

  <script>
  $('#my-table').dynatable({
    sorting: true
  });
  </script>
