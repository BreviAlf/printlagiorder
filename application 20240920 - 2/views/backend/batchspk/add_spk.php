<script>
function GoSpkInput() {
    var spk_no       = $("#inputspk").val();
    var batch_spk_id = $("#batch_spk_id").val();
    $('#ModalWait').modal({backdrop: 'static', keyboard: false}); 
    $('#overtime').text('');
    $('#ModalWait').modal('show');
   // OverTime();
    $.ajax({
      url: '<?php echo site_url() . 'backend/BatchSpk/AjaxInsertSPK' ?>',
      cache: false,
      type: 'POST',
      data: {
        spk_no: spk_no,
        batch_spk_id : batch_spk_id
      },
      success: function(result) {
          console.log('on here');
          setTimeout(function() {$('#ModalWait').modal('hide');}, 700);
          //$('#ModalWait').modal('hide');
          $("#load_data_spk").html(result);
          document.getElementById("inputspk").focus();
          $("#inputspk").val("");
          
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }


  function DelSpk(det_spk_id) {
    var batch_spk_id = $("#batch_spk_id").val();
    var det_spk_id = det_spk_id;
    $.ajax({
      url: '<?php echo site_url() . 'backend/BatchSpk/AjaxDelDetSPKId' ?>',
      cache: false,
      type: 'POST',
      data: {
        det_spk_id: det_spk_id,
        batch_spk_id : batch_spk_id
      },
      success: function(result) {
          document.getElementById("inputspk").focus();
          $("#inputspk").val("");
          $("#load_data_spk").html(result);
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function InputDeadline(id)
  {
    var batch_spk_date_deadline =  $("#batch_spk_date_deadline").val();
    var batch_id =  id;
    $.ajax({
      url: '<?php echo site_url() . 'backend/spk/AjaxInputDeadline' ?>',
      cache: false,
      dataType: "json",
      type: 'POST',
      data: {
        batch_spk_date_deadline: batch_spk_date_deadline,
        batch_id: batch_id
      },
      success: function(json) {
           DoCetakBatch(batch_id);
       
          }
        ,
      failure: function(errMsg) {
        alert(errMsg);
      }
    });

  }

  function OpenDeadline(id)
  {
    $('#ModalConfirmBatch').modal({backdrop: 'static', keyboard: false}); 
    $('#ModalConfirmBatch').modal('show');
  }

  function OverTime()
  {
    setTimeout(function() {
      $('#overtime').text('File Desain lebih dari 1 GB mohon bersabar');
    }, 5000);
  }

  function DoCetakBatch(batch_spk_id) {
    window.open("<?php echo site_url() . 'backend/batchspk/update/'; ?>" + batch_spk_id, "_blank");
    window.location.replace("<?php echo site_url().'backend/BatchSpk/add'?>");
    window.history.pushState(null, document.title, location.href);
  }

</script>


<div class="modal" id="ModalWait" data-bs-backdrop="true" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Please Wait</h5>
       
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <h5 class="modal-title">File sedang di copy ke folder BATCH : <?php echo $data_batch->batch_spk_name;?>. Browser jangan di close</h5>   
          <h5 id="overtime" class="modal-title"></div>
        </div>
      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>

<div class="modal" id="ModalConfirmBatch" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Deadline</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row mb-3">
                <label for="spk_qty_finish" class="col-sm-3 col-form-label">Deadline</label>
                <div class="col-sm-9">
                  <input type="datetime-local" value="<?php echo date('Y-m-d\TH:00:00'); ?>" name="batch_spk_date_deadline" id="batch_spk_date_deadline" class="form-control" required>
                </div>
              </div>
      </div>
      <div class="modal-footer">
      <?php if($input!='disabled'):?>
                     
                      <a href="javascript:void(0)" class="btn btn-primary float-right" onclick="InputDeadline(<?php echo $batch_spk_id;?>)">Kirim dan Cetak Batch</a>
                      <?php endif;?>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Batch : <?php echo $data_batch->batch_spk_name;?></h2>
          <div class="row">
            
            <div class="col-lg-8">

            <div class="row mb-3">
                <label for="batch_spk_det_spk_no" class="col-sm-2 col-form-label"><h4>SPK NO</h4></label>
                <div class="col-sm-9">
                  <input id="inputspk" type="text" name="batch_spk_det_spk_no" class="form-control" autofocus <?php echo $input;?>>
                </div>
              </div>
              
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-8">
              <div id="load_data_spk">
                <?php echo $notif;?>
                <h4>TOTAL SCAN SPK : <strong><?php echo $total_spk;?></strong></h4>
                <div class="table-responsive">
                    <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">Batch SPK ID</th>
                      <th scope="col">No SPK</th>
                      <th scope="col">Invoice MP</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($arr_spk_det as $row_spk_det) : ?>
                        <td><small><?php echo $row_spk_det['batch_spk_det_spk_id']; ?></small></td>
                        <td><small><?php echo $row_spk_det['batch_spk_det_spk_no']; ?></small></td>
                        <td><small><?php echo $row_spk_det['batch_spk_det_spk_inv_mp']; ?></small></td>
                        <td>
                        <?php if($input!='disabled'):?>
                          <button type="button" onclick="DelSpk(<?php echo $row_spk_det['batch_spk_det_batch_spk_id']; ?>)" class="btn btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        <?php endif;?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                        </div>         
              </div>

              
            </div>
            
              <div class="row">
              <input id="batch_spk_id" type="hidden" name="batch_spk_id" id="batch_spk_id" class="form-control" value="<?php echo $batch_spk_id;?>">
                <div class="col-lg-6">
                  <div class="d-flex mt-2 flex-row-reverse">
                    <div class="p-2">


                      <?php if($input!='disabled'):?>
                      <a href="javascript:void(0)" class="btn btn-primary float-right" onclick="OpenDeadline(<?php echo $batch_spk_id;?>)">Proses</a>
                      <?php endif;?>
                    </div>
                  </div>
                </div>

          </div> 
      </div>
    </div>
  </div>
</div>