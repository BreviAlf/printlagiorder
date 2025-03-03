<script>

$(document).ready(function() {
    $('input:radio[name=spk_source]').change(function() {
        if (this.value == 'Shopee' || this.value == 'Tokopedia') {
            $("#cust_name").css("display", "none");
            $("#spk_prod_name").attr('disabled', true);
            $("#spk_prod_name_mp").attr('disabled', true);
            $("#spk_finish_size").attr('disabled', true);
            $("#spk_qty_finish").attr('disabled', true);
            $("#spk_qty_material").attr('disabled', true);
            $("#btn_save").attr('disabled', true);

            $("#spk_inv_mp").val('');
            $("#spk_prod_mp_sku").val('');
            $("#prod_var_sku_var").val('');
            $("#spk_prod_name_mp").val('');
            
            $("#spk_inv_mp").removeAttr('readonly');
            $("#spk_prod_mp_sku").removeAttr('readonly');
            $("#prod_var_sku_var").removeAttr('readonly');

            $("#spk_inv_mp").removeAttr('disabled');
            $("#spk_prod_mp_sku").removeAttr('disabled');
            $("#prod_var_sku_var").removeAttr('disabled');
            if (this.value == 'Tokopedia') {
              $("#resi").css("display", "block");
            }
            else{
              $("#resi").css("display", "none");
            }

        }
       else if (this.value == 'Custom-WA') {
            $("#tipe_foto").css("display", "none");
            $("#cust_name").css("display", "block");
            $("#resi").css("display", "none");
            $("#spk_prod_name").removeAttr('disabled');
            $("#spk_prod_name_mp").removeAttr('disabled');
            $("#spk_finish_size").removeAttr('disabled');
            $("#spk_qty_finish").removeAttr('disabled');
            $("#spk_qty_material").removeAttr('disabled');
            $("#btn_save").removeAttr('disabled');

            //$("#spk_inv_mp").val('CUSTOM-WA');
            $("#spk_prod_mp_sku").val('CUSTOM-WA');
            $("#prod_var_sku_var").val('CUSTOM-WA');
            $("#spk_prod_name_mp").val('CUSTOM-WA');

            //$("#spk_inv_mp").attr('readonly', true);
            $("#spk_prod_mp_sku").attr('readonly', true);
            $("#prod_var_sku_var").attr('readonly', true);
            $("#spk_prod_name_mp").attr('readonly', true);
        }
    });

    $('input:radio[name=tipe_foto_check]').change(function() {
        //alert(this.value);SearchVarian()
        var mp_var = $("#prod_var_sku_var").val();
         if (this.value == 1){
          // add P
          //alert(mp_var+'-P');
          $("#prod_var_sku_var").val(mp_var+'-P');
          SearchVarian()
         }else{
          // remove P
          const myArray = mp_var.split("-");
          let new_mp_var = myArray[0]+'-'+myArray[1];
          //alert(new_mp_var);
          $("#prod_var_sku_var").val(new_mp_var);
          SearchVarian()
         }
    });
    
});

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
            $("#prod_var_sku_var").val(sku_mp);
            $("#spk_prod_name").removeAttr('disabled');
            $("#spk_prod_name_mp").removeAttr('disabled');
            $("#spk_finish_size").removeAttr('disabled');
            $("#spk_qty_finish").removeAttr('disabled');
            $("#spk_qty_material").removeAttr('disabled');
            $("#btn_save").removeAttr('disabled');

            $("#d_spk_type").html(json_string.d_spk_type);
            
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

  function SearchVarian() {
    var sku_var = $("#prod_var_sku_var").val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/spk/AjaxSearchBySKUVar' ?>',
      cache: false,
      dataType: "json",
      type: 'POST',
      data: {
        sku_var: sku_var
      },
      success: function(json) {
        //data = JSON.parse(json);
        var json_string = eval(json);
        stat = json_string.stat;

          if(stat == 1){
            $("#spk_prod_name").val(json_string.prod_name);
            $("#spk_prod_name_mp").val(json_string.prod_name_mp);
            $("#spk_prod_id").val(json_string.prod_id);
            $("#spk_prod_var_id").val(json_string.prod_var_id);
            $("#spk_finish_size").val(json_string.prod_var_finish_size);
            $("#spk_prod_mp_sku").val(json_string.spk_prod_mp_sku);
            $("#spk_qty_kel").val(json_string.prod_var_kel);
            $("#spk_multiply").val(json_string.prod_var_multiply);
            $("#spk_instruction").text(json_string.spk_instruction);
            $("#spk_prod_name").removeAttr('disabled');
            $("#spk_prod_name_mp").removeAttr('disabled');
            $("#spk_finish_size").removeAttr('disabled');
            $("#spk_qty_finish").removeAttr('disabled');
            $("#spk_qty_material").removeAttr('disabled');
            $("#spk_qty_design").removeAttr('disabled');
            //$("#spk_qty_kel").removeAttr('disabled');
            $("#btn_save").removeAttr('disabled');

            $("#d_material").html(json_string.d_material);
            $("#d_paper_size").html(json_string.d_paper_size);
            $("#d_print_side").html(json_string.d_print_side);
            $("#d_laminasi").html(json_string.d_laminasi);
            $("#d_cutting").html(json_string.d_cutting);
            $("#d_spk_type").html(json_string.d_spk_type);
            $("#tipe_foto").css("display", json_string.prod_check_visual);
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

  function CheckQty(){
    var qty = $("#spk_qty_finish").val();
    var kel = $("#spk_qty_kel").val();
    var multiply = $("#spk_multiply").val();

    if(!multiply){
      calc = qty / kel;
    }else{
      calc = qty / kel * multiply;
    }

    mod = qty % kel;
    divide = kel / multiply;

    if(isNaN(mod)){
      $("#sisa").text('');
    }else{
      if(calc >= 1)
      { 
        if(calc >= 10){
          $("#spk_proof").prop( "checked", true );
          $("#spk_approve").prop( "checked", true );
        }else{
          $('#spk_proof').prop('checked', false); 
          $('#spk_approve').prop('checked', false); 
        }

        if(mod != 0){
              if(mod == divide){
                $("#spk_qty_material").val(calc);
                $("#sisa").text('OK!!!');
                $("#sisa").css("color", "green");
                $("#sisa").css("font-size", "1.5em");
                $("#sisa").css("font-weight", "bold");
              }else{
                $("#spk_qty_material").val(calc);
                $("#sisa").text('***SISA = '+mod+'***');
                $("#sisa").css("color", "red");
                $("#sisa").css("font-size", "1.5em");
                $("#sisa").css("font-weight", "bold");
              }
                
            }else{
                $("#spk_qty_material").val(calc);
                $("#sisa").text('OK!!!');
                $("#sisa").css("color", "green");
                $("#sisa").css("font-size", "1.5em");
                $("#sisa").css("font-weight", "bold");
            }
        }
        else
        {
          $("#spk_qty_material").val(calc);
          $("#sisa").text('***BAHAN = 0***');
          $("#sisa").css("color", "red");
          $("#sisa").css("font-size", "1.5em");
          $("#sisa").css("font-weight", "bold");
        }          
      }
  }

  function CheckApproval()
  {
    var qty_bahan = $("#spk_qty_material").val();
    if(qty_bahan >= 20){
          $("#spk_proof").prop( "checked", true );
          $("#spk_approve").prop( "checked", true );
    }else{
          $('#spk_proof').prop('checked', false); 
          $('#spk_approve').prop('checked', false); 
    }
  }

  function ConvInv()
  {
    var spk_source = $("#spk_inv_mp").val();
    var conv = spk_source.replace(/\//g, "-");
    $("#conv").text(conv);

  }

  function RefShow()
  {
    $("#ref").css("display", "block");
  }

  function RefHide()
  {
    $("#spk_inv_mp_related").val('');
    $("#ref").css("display", "none");
  }

  function CheckInvMp(){
    var spk_source = $("#spk_source").val();
    if(spk_source!='CUSTOM-WA'){
      var inv_mp = $("#spk_inv_mp").val();
        $.ajax({
          url: '<?php echo site_url() . 'backend/spk/AjaxCheckInvMp' ?>',
          cache: false,
          dataType: "json",
          type: 'POST',
          data: {
            inv_mp: inv_mp
          },
          success: function(json) {
            var json_string = eval(json);
            if(json_string.count_data!=0){
              var x = document.getElementById("n_warning"); 
              x.play(); 

              $.ajax({
                  url: '<?php echo site_url() . 'backend/spk/AjaxShowData' ?>',
                  cache: false,
                  type: 'POST',
                  data: {
                    inv_mp: inv_mp
                  },
                  success: function(result) {
                    $("#ModalCheckInv").modal('show');
                    $("#load_data_spk").html(result);
                      
                    },
                  failure: function(errMsg) {
                    alert(errMsg);
                  }
                });
            }else{
              console.log(json_string.count_data);
              return false;
            }
              
            },
          failure: function(errMsg) {
            alert(errMsg);
          }
        });
    }

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

<audio id="n_warning">
		  <source src="<?php echo site_url();?>/assets/audio/warning.mp3" type="audio/mpeg">
		  Your browser does not support the audio element.
</audio>

<div class="modal fade" id="ModalCheckInv" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_spk">
          ...
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalSku" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>SKU Varian Belum Terdaftar. Siahkan tambahkan SKU Varian melalui halaman produk</p>
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
        <form action="<?php echo site_url() ?>backend/spk/add" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
          <div class="row">
            <div class="col-lg-6">

              <div class="row mb-3">
                <label for="spk_no" class="col-sm-3 col-form-label-sm">Source </label>
                <div class="col-sm-9">
                    
                   
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="spk_source" id="spk_source" value="Shopee" checked>
                      <label class="form-check-label" for="spk_source">
                        Shopee
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="spk_source" id="spk_source" value="Tokopedia">
                      <label class="form-check-label" for="spk_source">
                        Tokopedia
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="spk_source" id="spk_source" value="Custom-WA">
                      <label class="form-check-label" for="spk_source">
                        Whatsapp / Custom
                      </label>
                    </div>
                
                </div>
              </div>
              <div class="row mb-3">
                <label for="spk_no" class="col-sm-3 col-form-label-sm">No Invoice</label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    <?php echo form_error('spk_inv_mp', '<div class="alert alert-danger">', '</div>'); ?>
                    <input type="text" name="spk_inv_mp" id="spk_inv_mp" class="form-control" required>
                    <button onclick="RefShow()" title="Untuk menembahakan referensi No Invoice yang berhubungan." data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Untuk menambahkan referensi No Invoice yang berhubungan." class="btn btn-primary float-right" type="button">Ref#</button>
              </button>
                    <div class="invalid-feedback">Input Invoice</div>
                  </div>
                  <small style="font-size:7pt;" id="conv"></small>
                </div>
              </div>

              <div id="ref" style="display:none;">
                <div class="row mb-3">
                  <label for="spk_no" class="col-sm-3 col-form-label-sm">Input #Ref</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <?php echo form_error('spk_inv_mp', '<div class="alert alert-danger">', '</div>'); ?>
                      <input type="text" name="spk_inv_mp_related" id="spk_inv_mp_related" class="form-control">
                      <button onclick="RefHide()" title="Untuk menembahakan referensi No Invoice yang berhubungan." data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Untuk membatalkan referensi No Invoice yang berhubungan." class="btn btn-primary float-right" type="button">Cancel</button>
                    </div>
                    <small style="font-size:7pt;" id="conv"></small>
                  </div>
                </div>
              </div>

              <div style="display:none" id="resi">
                <div class="row mb-3">
                  <label for="spk_resi" class="col-sm-3 col-form-label-sm">No Resi</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                    
                      <input type="text" name="spk_resi" id="spk_resi" class="form-control">
                    
                    </div>
                  </div>
                </div>
              </div>

              <div style="display:none" id="cust_name">
                <div class="row mb-3">
                  <label for="spk_customer_name" class="col-sm-3 col-form-label-sm">Nama Cust</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                    
                      <input type="text" name="spk_customer_name" id="spk_customer_name" class="form-control">
                    
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label for="spk_no" class="col-sm-3 col-form-label-sm">SKU MP Induk</label>
                <div class="col-sm-9">
                <input id="spk_prod_id" type="hidden" name="spk_prod_id" id="spk_prod_id" class="">
                <input id="spk_prod_var_id" type="hidden" name="spk_prod_var_id" id="spk_prod_var_id" class="">
                  <div class="input-group has-validation">
                    <?php echo form_error('spk_prod_mp_sku', '<div class="alert alert-danger">', '</div>'); ?>
                    <input type="text" name="spk_prod_mp_sku" id="spk_prod_mp_sku" class="form-control" required>
                    <button onclick="SearchProduct()" class="btn btn-primary float-right" type="button">Cari</button>
                    <div class="invalid-feedback">Input SKU Marketplace</div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="spk_no" class="col-sm-3 col-form-label-sm">SKU MP Varian</label>
                <div class="col-sm-9">
      
                  <div class="input-group has-validation">
                    <input type="text" name="prod_var_sku_var" id="prod_var_sku_var" class="form-control" required>
                    <button onclick="SearchVarian()" class="btn btn-primary float-right" type="button">Cari</button>
                    <div class="invalid-feedback">Input SKU Varian Full</div>
                  </div>
                </div>
              </div>

              <div id="tipe_foto" style="display:none;">
                <div class="row mb-3">
                  <label for="spk_prod_name_mp" class="col-sm-3 col-form-label-sm">Tipe Foto</label>
                  <div class="col-sm-9">
                      <div class="form-check-foto">
                        <input class="form-check-input" type="radio" name="tipe_foto_check" id="tipe_foto_check" value="0" checked>
                        <label class="form-check-label" for="tipe_foto_check">
                           K-POP / Idol / Estetik / Brand / Freebies
                        </label>
                      </div>
                      <div class="form-check-foto">
                        <input class="form-check-input" type="radio" name="tipe_foto_check" id="tipe_foto_check" value="1">
                        <label class="form-check-label" for="tipe_foto_check">
                         Foto Pribadi 
                        </label>
                      </div>
                  </div>
                </div>
              </div>


              <div class="row mb-3">
                <label for="spk_prod_name" class="col-sm-3 col-form-label-sm">Product Name</label>
                <div class="col-sm-9">
                  <input id="spk_prod_name" type="text" name="spk_prod_name" id="spk_prod_name" class="form-control" disabled>
                </div>
              </div>

              <div class="row mb-3">
                <label for="spk_prod_name_mp" class="col-sm-3 col-form-label-sm">Product Name MP</label>
                <div class="col-sm-9">
                  <input id="spk_prod_name_mp" type="text" name="spk_prod_name_mp" id="spk_prod_name_mp" class="form-control" disabled>
                </div>
              </div>

              
              <div class="row mb-3">
                <label for="spk_material_name" class="col-sm-3 col-form-label-sm">Nama Bahan / Ukuran</label>
                <div class="col-sm-9">
                  <div class="row mb-0">
                      <div class="col-sm-8">
                        <div id="d_material">
                          <?php echo DropdownMaterial(FALSE, 'spk_material_id',FALSE); ?>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="d_paper_size">
                          <?php echo DropdownPaperSize(FALSE, 'spk_paper_size_id',FALSE); ?>
                        </div>
                      </div>
                    </div>    
                </div>
              </div>

              <div class="row mb-3">
                <label for="spk_finish_size" class="col-sm-3 col-form-label-sm">Ukuran Jadi</label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    <input type="text" name="spk_finish_size" id="spk_finish_size" class="form-control" disabled required>
                    <div class="invalid-feedback">Input Ukuran Jadi</div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label for="spk_qty_finish" class="col-sm-3 col-form-label-sm">QTY Jadi</label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    <input type="text" name="spk_qty_finish" id="spk_qty_finish" class="form-control" disabled required>
                    <div class="invalid-feedback">Input QTY Jadi</div>
                  </div>
                  <div id="sisa"></div>
                </div>
              </div>


              <div class="row mb-3">
                <label for="spk_qty_material" class="col-sm-3 col-form-label-sm">QTY Bahan </label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    <input type="text" name="spk_qty_material" id="spk_qty_material" class="form-control" disabled required>
                    <div class="invalid-feedback">Input Qty Bahan</div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label for="spk_qty_design" class="col-sm-3 col-form-label-sm">QTY Desain / A3 </label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    <input type="text" name="spk_qty_design" id="spk_qty_design" class="form-control" disabled required>
                    <div class="invalid-feedback">Input Qty Desain / A3</div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-lg-6">
              <div class="row mb-3">
                <label for="spk_qty_material" class="col-sm-3 col-form-label-sm">Sisi Cetak</label>
                <div class="col-sm-9">
                  <div id="d_print_side">
                    <?php echo DropdownPrintSide(FALSE, 'spk_print_side'); ?>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label-sm">Laminasi / Sisi</label>
                <div class="col-sm-9">
                  <div class="row mb-0">
                    <div class="col-sm-6">
                      <div id="d_laminasi">
                        <?php echo DropdownLaminasi(FALSE, 'spk_lamination'); ?>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <?php echo DropdownSisiLaminasi(FALSE, 'spk_lamination_side'); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label-sm">Cutting</label>
                <div class="col-sm-9">
                  <div id="d_cutting">
                    <?php echo DropdownCutting(FALSE, 'spk_cutting'); ?>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="prod_desc" class="col-sm-3 col-form-label-sm">Finishing</small></label>
                <div class="col-sm-9">
                  <textarea name="spk_instruction" id='spk_instruction' class="form-control" style="height: 100px">
      

                </textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label for="prod_desc" class="col-sm-3 col-form-label-sm">Instruksi Khusus <small>(Tambahan Finish / Template / Kode)</small></label>
                <div class="col-sm-9">
                  <textarea name="spk_catatan" id='spk_catatan' class="form-control" style="height: 100px">
      

                </textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label-sm">Gambar</label>
                <div class="col-sm-9">
                  <input class="form-control" type="file" name="file_image" id="file_image">
                </div>
              </div>

              <div class="row mb-3">
                <label for="spk_qty_material" class="col-sm-3 col-form-label-sm">Tipe SPK</label>
                <div class="col-sm-9">
                  <div id="d_spk_type">
                    <?php echo DropdownSPKType(FALSE, 'spk_type'); ?>
                  </div>
                </div>
              </div>
              
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label-sm">Store Name</label>
                <div class="col-sm-9">
                  <?php echo DropdownStore(FALSE, 'spk_store_name'); ?>
                </div>
              </div>

              <div class="row mb-3">
                <label for="spk_qty_finish" class="col-sm-3 col-form-label-sm">Tanggal Deadline</label>
                <div class="col-sm-9">
                <?php //echo date('Y-m-d\TH:00:00'); ?>
                  <input type="datetime-local"
                  value="<?php echo date('Y-m-d\TH:00:00'); ?>"
                  min="2018-06-07T00:00"
                  max="2018-06-14T00:00
                  "name="spk_datetime_out" id="spk_datetime_out" class="form-control">
                </div>
              </div>
           
              <div class="row mb-3">
                <label for="spk_qty_kel" class="col-sm-3 col-form-label-sm">Approval</label>
                <div class="col-sm-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="spk_proof" id="spk_proof" value="1">
                          <label class="form-check-label" for="spk_proof">
                            Proof Print
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="spk_approve" id="spk_approve" value="1">
                          <label class="form-check-label" for="spk_approve">
                            Approval Customer
                          </label>
                        </div>
                    </div>
                  </div>
                  <input type="hidden" name="spk_qty_kel" id="spk_qty_kel" size="10" class="" >
                  <input type="hidden" name="spk_multiply" id="spk_multiply" size="10" class="" >
                </div>
              </div>

              <div class="d-flex mt-2 flex-row-reverse">
                <div class="p-2">
                  <button id="btn_save" class="btn btn-primary float-right" type="submit" disabled>Save</button>
                  <a href="<?php echo site_url(); ?>backend/spk/" class="btn btn-warning float-right">Cancel</a>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>