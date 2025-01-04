<script>

function Generate(bc_batch_id,cust_batch_id) 
  {
    $.ajax({
      url: '<?php echo site_url() . 'backend/broadcast/AjaxGenerateFile' ?>',
      cache: false,
      type: 'POST',
      data: {
        bc_batch_id: bc_batch_id
      },
      success: function(json) {
        var obj = JSON.parse(json);
        if(obj.flag == 1){
          alert('sudah broadcast');
          location.reload();
        }else{
          $("#ModalGenerate").modal('show');
          $("#bc_batch_id").val(obj.bc_batch_id);
          $("#cust_batch_id").val(cust_batch_id);
        }

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function ChangeGender(gender){
    $('#selected_gender').val(gender);
  }

  function DoGenerate()
  {
      var gender = $('#selected_gender').val();
      var bc_batch_id = $('#bc_batch_id').val();
      var cust_batch_id = $('#cust_batch_id').val();

      if(bc_batch_id){
        document.getElementById('btn_gen_'+bc_batch_id).remove();
        window.open("<?php echo site_url() . 'backend/broadcast/generate_file/';?>"+bc_batch_id+'/'+cust_batch_id+'/'+gender, "_self");
        $("#ModalGenerate").modal('hide');
       
 
      }else{
        document.getElementById('btn_gen_'+bc_batch_id).remove();
        window.open("<?php echo site_url() . 'backend/broadcast/generate_file/';?>"+bc_batch_id+'/'+cust_batch_id, "_self");
        $("#ModalGenerate").modal('hide');
       
      }
        

  }

  function AlertDelete(i) 
  {
    $("#ModalDelete").modal('show');
    $("#bc_batch_id").val(i);
  }

  function DoDelete()
  {
    var bc_batch_id = $("#bc_batch_id").val();
    window.open("<?php echo site_url() . 'backend/broadcast/delete/';?>"+bc_batch_id, "_self");
  }

  function DoBatal()
  {
    $("#ModalDelete").modal('hide');
  }
  function CancelGenerate()
  {
    $("#ModalGenerate").modal('hide');
  }
</script>



<!-- modal generate -->
<div class="modal fade" id="ModalGenerate" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Generate Options</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Choose gender for random name</p>
          <input type="hidden" id="selected_gender" value=''>
          <input type="hidden" id="bc_batch_id" value=''>
          <input type="hidden" id="cust_batch_id" value=''>
              <div class="row mb-3">  
								<label for="inputText" class="col-sm-3 col-form-label">Status</label>
								<div class="col-sm-9">
									<?php echo jenkelDropdown(FALSE, 'gender'); ?>
								</div>
							</div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="CancelGenerate()" class="btn btn-secondary" >Batal</button>
        <button type="button" onclick="DoGenerate()" class="btn btn-primary">Generate Data</button>
      </div>
    </div>
  </div>
</div>



<!-- modal alert -->
<div class="modal fade" id="ModalDelete" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Broadcast Landing</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Are you sure?</p>

          <input type="hidden" id="bc_batch_id" value=''>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="DoBatal()" class="btn btn-secondary" >Batal</button>
        <button type="button" onclick="DoDelete()" class="btn btn-danger">Hapus Data</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">

    <div class="card">

      <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <div class="d-flex mt-2 flex-row-reverse">
          <div class="p-2">
            <a href="#" class="btn btn-danger float-right">Delete Multiple</a>
          </div>
        </div>
        <?php echo $this->session->flashdata('message_type'); ?>
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Landing</th>
              <th scope="col">Cust List</th>
              <th scope="col">Created</th>
              <th scope="col">Last Generate</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_data as $row_data) : ?>
              <tr>
                <th scope="row"><?php echo $row_data['bc_batch_id']; ?></th>
                <td><?php echo $row_data['bc_batch_name']; ?></td>
                <td><?php echo $row_data['landing_name']; ?></td>
                <td><?php echo $row_data['cust_batch_name']; ?></td>
                <td><?php echo $row_data['bc_batch_date_created']; ?></td>
                <td><?php echo $row_data['bc_batch_file_generate_created']; ?></td>
                <td>
                <?php if($row_data['bc_batch_file_generate_created'] == '0000-00-00 00:00:00' || $row_data['bc_batch_file_generate_created'] == NULL):?>
                <button id="btn_gen_<?php echo $row_data['bc_batch_id']; ?>" onclick="Generate(<?php echo $row_data['bc_batch_id'];?>,<?php echo $row_data['cust_batch_id']; ?>)" class="btn btn-primary btn-sm">Generate File</button> 
                <?php endif;?>
                <a href="#" onclick="AlertDelete(<?php echo $row_data['bc_batch_id'];?>)" class="btn btn-danger btn-sm">Delete</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
</div>

<div class="modal fade" id="ModalUploadCust" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload CSV File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url() ?>backend/customer/upload/batch" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
          <div class="col-lg-12">
            <div class="row mb-3">
              <label for="cust_batch_name" class="col-sm-3 col-form-label">Batch Name</label>
              <div class="col-sm-9">
                <div class="input-group has-validation">
                  <?php echo form_error('cust_batch_name', '<div class="alert alert-danger">', '</div>'); ?>
                  <input type="text" name="cust_batch_name" id="cust_batch_name" class="form-control" required>
                  <div class="invalid-feedback">Please enter customer batch name.</div>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-3 col-form-label">File</label>
              <div class="col-sm-9">
                <div class="input-group has-validation">
                  <input class="form-control" type="file" name="file_cust" id="file_cust" required>
                  <div class="invalid-feedback">Please enter file.</div>
                </div>
              </div>
              <div class="d-flex mt-2 flex-row-reverse">
                <div class="p-2">
                  <button class="btn btn-primary float-right" type="submit">Upload</button>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>