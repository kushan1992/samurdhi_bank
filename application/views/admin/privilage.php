<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Privilage</h4>
          <?php echo form_open('admin/create_privilage');?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Privilage</label>
                  <div class="col-sm-9">
                    <input type="text" name="privilage" class="form-control" required/>
                    <?php echo form_error('privilage', '<p class="text-warning" >', '</p>'); ?>
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
               <th>Edit</th>
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
                            <button type="button" class="btn btn-icons btn-rounded btn-secondary identifyingClass" data-toggle="modal" data-target="#myModal" data-id="<?php if(!empty($row['idprivilege'])){ echo $row['idprivilege']; }?>">
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
        <div id="hiddenValue"></div>

      </div>
    </div>
  </div>
  <script>
  $('#my-table').dynatable({
    sorting: true
  });

  $(function () {
          $(".identifyingClass").click(function () {

              var privilege_id = $(this).data('id');
              //console.log(my_id_value);
              //$(".modal-body #hiddenValue").val(my_id_value);
              $.ajax({
                  type: 'POST',
                  url: "<?php echo base_url(); ?>" + "admin/update_privilage",
                  data: {id: privilege_id},
                  success:function(result) {
                    //  console.log(result); // alert your date variable value here
                      $("#hiddenValue").html(result);
                  },
                  error:function(result) {
                    console.log(result);
                  }
              });
          })
      });
  </script>
