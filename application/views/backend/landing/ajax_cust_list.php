<style>
  table.dataTable {
    font-size: small;
  }
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $('#cust_list').DataTable({
      "paging": false,
      "ordering": false,
      "info": false
    });
  });

  function ChangeCustListId(i) 
  {
    var cust_list_id = i;
    var landing_id = $('#landing_id').val();

    $('#bc_batch_cust_batch_id').val(cust_list_id);
  }

  function SubmitForm()
  {
    document.getElementById("batch_form").submit();
  }
</script>

<style>
input[data-readonly] {
  pointer-events: none;
}
  </style>

<div id="load_data_cust_modal">
<form id="batch_form" action="<?php echo site_url() ?>backend/landing/savecustlist" method="post" class="row g-3 needs-validation" enctype="multipart/form-data">
  <div class="row">
    <div class="col-lg-6">
   
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Broadcast Data - <?php echo $title; ?></h5>
          <label for="bc_batch_name" class="col-form-label mb-3"><?php echo site_url().'landing/id/'.$landing_id.'?uid=[uid]';?></label>
          
         

            <div class="row mt-3 mb-3">
              <label for="bc_batch_name" class="col-sm-3 col-form-label">Broadcast Name</label>
              <div class="col-sm-9">
                <div class="input-group has-validation">
                  <?php echo form_error('bc_batch_name', '<div class="alert alert-danger">', '</div>'); ?>
                  <input type="text" name="bc_batch_name" id="bc_batch_name" class="form-control" value="<?php echo $bc_batch_name;?>" required>
                  <div class="invalid-feedback">Please enter Broadcast name.</div>
                </div>
              </div>
            </div>

            <div class="row mb-3">

                <label for="prod_desc" class="col-sm-3 col-form-label">Message</label>
                <div class="col-sm-9">
                  <textarea name="bc_batch_msg" class="form-control" style="height: 150px"><?php echo $bc_batch_msg;?></textarea>
                </div>
            
            </div>
            <input type="hidden" name="bc_batch_landing_id" value="<?php echo $landing_id;?>">

         

        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Cust. List - <?php echo $title; ?></h5>
          <table id="cust_list" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>List Name</th>
              </tr>
            </thead>
            <tbody>
              
              <?php 

              foreach ($arr_cust_list as $row_cust_list) : 
                if (in_array($row_cust_list['cust_batch_id'], $arr_cust_batch_id, true)) {
                  $check = 'disabled checked';
                }else{
                  $check = '';
                }
              ?>
                <tr>
                  <td><input <?php echo $check;?> class="form-check-input" type="checkbox" onchange="ChangeCustListId(<?php echo $row_cust_list['cust_batch_id'];?>)" name="custlist[]" value="<?php echo $row_cust_list['cust_batch_id']?>" id="custlist[]"></td>
                  <td><?php echo $row_cust_list['cust_batch_name']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <div class="d-flex mt-2 flex-row-reverse">
            <div class="p-2">
                <button class="btn btn-primary float-right" type="submit">Save Broadcast</button>
            </div>
          </div>
         
        </div>
      </div>
    </div> 
  </div>
  </form>
</div>