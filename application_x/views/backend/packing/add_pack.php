<script>
function GoInvInput() {
    var inv_mp       = $("#inputinv").val();
    var pack_id      = $("#pack_id").val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/packing/AjaxInsertInv' ?>',
      cache: false,
      type: 'POST',
      data: {
        inv_mp: inv_mp,
        pack_id : pack_id
      },
      success: function(result) {
          $("#load_data_pack").html(result);
          document.getElementById("inputinv").focus();
          $("#inputinv").val("");
          var x = document.getElementById("myAudio"); 
          x.play(); 
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }


  function DelPackInv(pack_det_id) {
    var pack_id = $("#pack_id").val();
    var pack_det_id = pack_det_id;
    $.ajax({
      url: '<?php echo site_url() . 'backend/packing/AjaxDelDetId' ?>',
      cache: false,
      type: 'POST',
      data: {
        pack_id: pack_id,
        pack_det_id : pack_det_id
      },
      success: function(result) {
          $("#load_data_pack").html(result);
          document.getElementById("inputinv").focus();
          $("#inputinv").val("");
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function DoCetakPack(pack_id) {
    window.open("<?php echo site_url() . 'backend/packing/update/'; ?>" + pack_id, "_blank");
    window.location.replace("<?php echo site_url().'backend/packing/add'?>");
    window.history.pushState(null, document.title, location.href);
  }

  function DoSimpan(pack_id) {
    window.open("<?php echo site_url() . 'backend/packing/update/'; ?>" + pack_id +'/s', "_self");
  }

</script>

<div class="modal fade" id="ModalSku" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>SKU Belum Terdaftar. Siahkan tambahkan SKU Produk melalui halaman produk</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="Skip()" class="btn btn-warning">Skip Proses</button>
        <button type="button" onclick="GoToProduct()" class="btn btn-primary">Ke Halaman Produk</button>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $data_pack->pack_no;?> - Kurir : <?php echo $data_pack->pack_kurir_name;?></h5>
        <div class="row">
            
            <div class="col-lg-3">
            <div class="row mb-3">
              <img src="<?php echo site_url().'assets/img/'.getDataTableById('tb_kurir','kurir_img_logo','kurir_id',$data_pack->pack_kurir_id);?>" class="img-fluid" alt="Responsive image">
            </div>
              
          </div>
          <div class="row">
            
            <div class="col-lg-8">
            <?php if($input!='disabled'):?>
            <div class="row mb-3">
                <label for="pack_det_inv_mp" class="col-sm-3 col-form-label"><h4>INVOICE NO</h4></label>
                <div class="col-sm-9">
                  <input id="inputinv" inputmode="none" type="text" name="pack_det_inv_mp" class="form-control" autofocus>
                </div>
              </div>
            <?php endif;?>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-12">
              <div id="load_data_pack">
                <?php echo $notif;?>
                <h4>TOTAL SCAN INVOICE : <strong><?php echo $total_pack;?></strong></h4>
                <div class="table-responsive">
                    <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">PACK ID</th>
                      <th scope="col">Invoice MP</th>
                      <th scope="col">Scaned</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($arr_pack_det as $row_pack_det) : ?>
                        <td><small><?php echo $row_pack_det['pack_det_id']; ?></small></td>
                        <td><small><?php echo $row_pack_det['pack_det_inv_mp']; ?></small></td>
                        <td><small><?php echo $row_pack_det['pack_det_created_date']; ?></small></td>
                        <td>
                        <?php if($input!='disabled'):?>
                          <button type="button" onclick="DelPackInv(<?php echo $row_pack_det['pack_det_id']; ?>)" class="btn btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
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
              <input id="pack_id" type="hidden" name="pack_id" id="pack_id" class="form-control" value="<?php echo $pack_id;?>">
                <div class="col-lg-6">
                  <div class="d-flex mt-2 flex-row-reverse">
                    <div class="p-2">
                      
                      <?php if($input!='disabled'):?>
                      <a href="<?php echo site_url(); ?>backend/packing/delete" class="btn btn-warning float-right">Batal dan Hapus</a>
                      <a href="javascript:void(0)" class="btn btn-primary float-right" onclick="DoSimpan(<?php echo $pack_id;?>)">Simpan</a>
                      <a href="javascript:void(0)" class="btn btn-primary float-right" onclick="DoCetakPack(<?php echo $pack_id;?>)">Simpan dan Cetak</a>
                      <?php endif;?>
                    </div>
                  </div>
                </div>

          </div> 
      </div>
    </div>
  </div>
</div>