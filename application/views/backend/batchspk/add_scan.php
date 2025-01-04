<script>
    function DoCetak(spk_id) {
    var spk_id = spk_id;
    window.open("<?php echo site_url() . 'backend/spk/cetak_spk/'; ?>" + spk_id+'/cetak', "_blank");
  }


  function GoInputScan() {
    var inputscan = $("#inputscan").val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/batchspk/AjaxInputscan' ?>',
      cache: false,
      type: 'POST',
      data: {
        inputscan: inputscan
      },
      success: function(result) {
         
          $("#load_datascan").html(result);
          var x = document.getElementById("myAudio"); 
          x.play(); 
          $("#inputscan").val("");
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }


  function UpdateQty() {
    var qty_new = $("#qty_new").val();
    var spk_no = $("#spk_no").val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/batchspk/AjaxUpdateQty' ?>',
      cache: false,
      type: 'POST',
      data: {
        qty_new: qty_new,
        spk_no: spk_no
      },
      success: function(result) {
          
          //$("#btn_update").attr('disabled', true);
          $('#ModalSuccess').modal('show');

          setTimeout(function() {
              $('#ModalSuccess').modal('hide');
          }, 1000);
          document.getElementById("inputscan").focus();
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function DeleteScan(nospk) 
  {
    
    $('#ModalDelete').modal('show');
    document.getElementById("inputscan").focus();

  }

  function DeleteAll() 
  {
    var spk_no = $("#spk_no").val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/batchspk/AjaxDeleteAll' ?>',
      cache: false,
      type: 'POST',
      data: {
        spk_no: spk_no
      },
      success: function(result) {
          
          $("#load_datascan").html('<div class="alert alert-warning bg-warning text-dark border-0 alert-dismissible fade show" role="alert"> <p><strong>SETIAP SCAN, DATA LANGSUNG MASUK!!!! <br>PASTIKAN PRODUK YANG AKAN DI SCAN SUDAH BENAR <br></strong><button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>');
          $('#ModalDelete').modal('hide');
          document.getElementById("inputscan").focus();
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });

  }

  function DeleteOne() 
  {
    var spk_no = $("#spk_no").val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/batchspk/AjaxDeleteOne' ?>',
      cache: false,
      type: 'POST',
      data: {
        spk_no: spk_no
      },
      success: function(result) {
          
          $("#load_datascan").html(result);
          $('#ModalDelete').modal('hide');
          document.getElementById("inputscan").focus();
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });

  }

  function SearchProduct() {
    var sku_mp = $("#spk_prod_mp_sku").val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/spk/AjaxSearchBySKU' ?>',
      cache: false,
      dataType: "json",
      type: 'POST',
      data: {
        sku_mp: sku_mp
      },
      success: function(json) {
        //data = JSON.parse(json);
        var json_string = eval(json);
        stat = json_string.stat;

          if(stat == 1){
            $("#spk_prod_name").val(json_string.prod_name);
            $("#spk_prod_name_mp").val(json_string.prod_name_mp);
            $("#spk_prod_id").val(json_string.prod_id);
            $("#spk_prod_name").removeAttr('disabled');
            $("#spk_prod_name_mp").removeAttr('disabled');
            $("#spk_finish_size").removeAttr('disabled');
            $("#spk_qty_finish").removeAttr('disabled');
            $("#spk_qty_material").removeAttr('disabled');
            $("#btn_save").removeAttr('disabled');
            
          }else{
            $("#spk_prod_name").val('');
            $("#spk_prod_name_mp").val('');
            $("#spk_prod_id").val('');

            $("#spk_prod_name").attr('disabled', true);
            $("#spk_prod_name_mp").attr('disabled', true);
            $("#spk_finish_size").attr('disabled', true);
            $("#spk_qty_finish").attr('disabled', true);
            $("#spk_qty_material").attr('disabled', true);
            $("#btn_save").attr('disabled', true);

            $("#ModalSku").modal('show');
          }
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function GoToProduct() {
    window.open("<?php echo site_url() . 'backend/product/'; ?>", "_self");
  }

  function Skip() {
    $("#ModalSku").modal('hide');
  }
</script>



<div class="modal fade" id="ModalDelete" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Berapa item yang akan anda hapus?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="DeleteAll()" class="btn btn-sm btn-danger">All</button>
        <button type="button" onclick="DeleteOne()" class="btn btn-sm btn-warning">Hapus [1]</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalSuccess" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Update Berhasil!!</p>
        </div>
      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        
       
          <div class="row">
            <div class="col-lg-6">
            <div class="input-group mb-3 mt-4">
                      <input id="inputscan" autofocus type="text" inputmode="none" class="form-control" placeholder="SCAN NO SPK" aria-label="spk / invoice" aria-describedby="basic-addon2" required>
                      <span class="input-group-text" id="basic-addon2">ENT</span>
                    </div>
            </div>
        
        <div class="row">
        <div class="col-lg-12">
         
          <div id="load_datascan">
          <div class="alert alert-warning bg-warning text-dark border-0 alert-dismissible fade show" role="alert">
				<p><strong>SETIAP SCAN, DATA LANGSUNG MASUK!!!! <br>PASTIKAN PRODUK YANG AKAN DI SCAN SUDAH BENAR <br></strong>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>