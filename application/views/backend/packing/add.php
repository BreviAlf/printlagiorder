<script>
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
        <h5 class="card-title"><?php echo $title; ?></h5>
        <?php echo $this->session->flashdata('message_type'); ?>
        <div class="d-flex mt-4 flex-row-reverse">
          <div class="p-2">

          </div>
        </div>
        <form action="<?php echo site_url() ?>backend/packing/add" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
          <div class="row">
            <div class="col-lg-6">

            <div class="row mb-3">
                <label for="batch_spk_name" class="col-sm-3 col-form-label">Pilih Kurir</label>
                <div class="col-sm-9">
                  <?php echo DropdownKurir(FALSE,'pack_kurir_id')?>
                </div>
              </div>
              <div class="d-flex mt-2 flex-row-reverse">
                <div class="p-2">
                  
                  <a href="<?php echo site_url(); ?>backend/spk/" class="btn btn-warning float-right">Batal dan Hapus</a>
                  <button id="btn_save" class="btn btn-primary float-right" type="submit">Lanjut Scan Packing</button>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>