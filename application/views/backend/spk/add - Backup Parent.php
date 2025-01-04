<script>
  var stat = 0;
  var arr_kel_mult = [];

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
           
            if (json_string.prod_var_parent_flag==1){
              document.getElementById("Child_tab_div").hidden = false;
              document.getElementById("Child_tab").hidden = false;
              document.getElementById("Child_tab").innerHTML =  `<button type="button" data-bs-toggle="modal" data-bs-target="#ChildTable" class="btn btn-primary btn-sm"  >Bahan Tambahan</button> `;
              document.getElementById('parent_input').value=1;
              document.getElementById("child_kontrol_qty_bahan").innerHTML = `<input id="qty_bahan_child_0" name="qty_bahan_child_0"></input>`;
              // document.getElementById("child_kontrol_gate").innerHTML = `<input id="child_gate" required></input>`;
              get_child_table(json_string.prod_var_parent_id)

              
            } else {
              document.getElementById("Child_tab_div").hidden = true;
              document.getElementById("Child_tab").hidden = true;
              document.getElementById('parent_input').value=null;
              document.getElementById("child_kontrol_qty_bahan").innerHTML = ``;
              // document.getElementById("child_kontrol_gate").innerHTML = `<input id="child_gate" value="1" required></input>`;
            }

            $("#prod_var_parent_flag").html(json_string.prod_var_parent_flag);
            $("#prod_var_parent_id").html(json_string.prod_var_parent_id);

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


  function get_child_table(prod_var_parent_id){
    $.ajax({ 
      type: "POST",
      url: "<?= base_url(); ?>backend/spk/child_spk2", 
      data: {prod_var_parent_id:prod_var_parent_id},
      cache: false,
      dataType: 'json',
      
      success: function (response) 
      {
        // console.log(response);

        // translate Uk. bahan / paper_size
        var arr_paper_size = [];
        jml_paper_size = response[1].length;
        for (j = 0 ; j < jml_paper_size ; j++){
          arr_paper_size[response[1][j].paper_size_id] = response[1][j].paper_size_name;
        }
        console.log(arr_paper_size);

        // translate Finishing
        var arr_fin = [];
        jml_paper_size = response[2].length;
        for (j = 0 ; j < jml_paper_size ; j++){
          arr_fin[response[2][j].fin_id] = response[2][j].fin_name;
        }
        // console.log(arr_fin);

        
        jml_child = response[0].length;
        teks = ``;
        teks_input_child = ``;
        for (i = 0 ; i < jml_child ; i++){

          //mengisi arr_kel_mult
          arr_kel_mult["kel"+i] = response[0][i].prod_var_kel;
          arr_kel_mult["mult"+i] = response[0][i].prod_var_multiply;
          
          if(!response[0][i].prod_var_finishing){
            x = "-";
          } else {
            x =  response[0][i].prod_var_finishing.split("|")
          }
          // console.log(x);

          teks = teks + `
            <tr>
              <td><small>${response[0][i].prod_var_sku_var}<br>
              <td><small>${response[0][i].prod_var_name}</small></td>
              <td><small>${response[0][i].prod_var_material_name}</small></td>
              <td><small>${arr_paper_size[response[0][i].prod_var_paper_size_id]}</small></td>
              <td><small>${response[0][i].prod_var_multiply}</small></td>
              <td><small>${response[0][i].prod_var_print_side}</small></td>
              <td><small>${response[0][i].prod_var_lamination}</small></td>
              <td><small>${response[0][i].prod_var_cutting}</small></td>
              <td><small>`;
              if( x != "-"){
              finish = "";
              x.forEach(element => {
                finish = finish + arr_fin[element] + " | ";
              });
              finish = finish.slice(0, -2); 
              teks = teks + finish;
            } else {
              teks = teks + x;
            }

          teks = teks +`</small>
          <td><small><input id="i_child_qty_jadi${i}" onkeyup="math_child_qty_bahan(${i}, ${response[0][i].prod_var_multiply}, ${response[0][i].prod_var_kel}); child_bahan_filled();"></input></small></td>
          <td>
            <small><input id="i_child_qty_bahan${i}"></input></small><br>
            <small><p id="bulat_check${i}" style="color:red;"></p></small><br>
          </td>
          </td>  </tr>`;

         
          // value_remember =  document.getElementById(`qty_bahan_child_${i}`).value;
          teks_input_child = teks_input_child + `<input value='' id="qty_bahan_child_${i}" name="qty_bahan_child_${i}"></input>`


        }

        document.getElementById("table_child").innerHTML = teks;
        document.getElementById("jml_child").innerHTML = jml_child;
        
        document.getElementById("child_kontrol_qty_bahan").innerHTML = teks_input_child;
        
        
        
        
      }
    });
  }

  function math_child_qty_bahan(id, multiply, kelipatan){
    // total = multiply * kelipatan;
    qty_calc = parseInt(document.getElementById("i_child_qty_jadi"+id).value) 
    raw_calc = qty_calc / kelipatan * multiply;
    mod_calc = qty_calc % kelipatan * multiply;
    // mod_calc = qty_calc % kelipatan;
    // devide_calc = kelipatan / multiply
    
    //check_bulat
    // id("bulat_check"+id) 
    if(raw_calc % 1 != 0){
      // document.getElementById("bulat_check"+id).innerText = "Tidak Bulat = " + raw_calc;
      document.getElementById("bulat_check"+id).innerText = "Sisa = " + mod_calc;
      document.getElementById("bulat_check"+id).hidden = false;
      document.getElementById("warning_qty_child").hidden = false;
    } else {
      document.getElementById("bulat_check"+id).hidden = true;
      document.getElementById("warning_qty_child").hidden = true;
    }

    // total = Math.ceil(raw_calc);
    total = raw_calc;
    

    document.getElementById("i_child_qty_bahan"+id).value = total;
    document.getElementById("qty_bahan_child_"+id).value = total;
    
  }

  function child_bahan_filled(){
    filled = '';
    jml_child = parseInt( document.getElementById('jml_child').innerText);
    for (let index = 0; index < jml_child; index++) {
      if(document.getElementById("i_child_qty_bahan"+index).value){
        if(document.getElementById("i_child_qty_bahan"+index).value%1 == 0){
          filled = 1;
        } else {filled = ''; break;}
      } else {filled = ''; break;}      
    }
      document.getElementById('child_gate').value = filled;
  }

  function child_gate_check() {
    if (document.getElementById('child_gate').value != 1){
      alert("Bahan Tambahan, Qty Bahannya tidak bulat");
    }
  }

  function qty_parent_to_child() {
    var qty_parent = document.getElementById('spk_qty_finish').value;
    var jml_child = parseInt( document.getElementById('jml_child').innerText);
    for (let index = 0; index < jml_child; index++) {
      kel = "kel"+index;
      mult = "mult"+index;
      qty_child = qty_parent * arr_kel_mult[kel]
      document.getElementById('i_child_qty_jadi'+index).value = qty_child;
      math_child_qty_bahan(index, arr_kel_mult[kel], arr_kel_mult[mult]);
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
        <div id="kontrol child input" hidden>
          <div id="child_kontrol_gate" >
            <!-- <input id="child_gate" value="1"></input> -->
          </div>
          <div id="child_kontrol_qty_bahan" >
              . . .
          </div>
        </div>
        <!-- <input type="text" name="qty_bahan_child_0" > "qty_bahan_child_0"</input> -->
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
                    <div class="invalid-feedback">Input Invoice</div>
                  </div>
                  <small id="conv"></small>
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
                    <button onclick="SearchVarian();  " class="btn btn-primary float-right" type="button">Cari</button>
                    <div class="invalid-feedback">Input SKU Varian Full</div>
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
                    <input type="text" name="spk_qty_finish" id="spk_qty_finish" onkeyup="qty_parent_to_child()" class="form-control" disabled required>
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

              <div class="row mb-3" id="Child_tab_div" hidden>
                <label for="" class="col-sm-3 col-form-label-sm"></label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    
                    <div id="Child_tab" hidden > . . (row 150) . . </div>  
                               
                    
                    
                  </div>
                  <div id="warning_qty_child" style="color:red" hidden>Qty Bahan Tambahan bersisa</div>
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
                  <!-- <button id="btn_save" onclick="child_gate_check()" class="btn btn-primary float-right" type="submit" disabled>Save</button> -->
                  <button id="btn_save"  class="btn btn-primary float-right" type="submit" disabled>Save</button>
                  <a href="<?php echo site_url(); ?>backend/spk/" class="btn btn-warning float-right">Cancel</a>
                </div>
              </div>
            </div>

          <div id="parent kontrol" hidden>
            <input name="parent_input" id="parent_input" ></input>
          </div>
          
          
        </form>


        
        <!-- div untuk ditaruh di form <div class="row mb-3"><label for="spk_no" class="col-sm-3 col-form-label-sm"></label><div class="col-sm-9"> <div class="input-group has-validation"> -->
          <!-- </div></div></div> -->
        <div id="kontrol child" hidden>
          <!-- <div id="Child_tab" hidden > . . (row 150) . . </div> -->
          <div id="prod_var_parent_flag"></div>
          <div id="jml_child" ></div>
          <div id="prod_var_parent_id" ></div>
        </div>
              
      </div>
    </div>
  </div>
</div>

<!-- modal -->
<div class="modal fade" id="ChildTable" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title">Bahan Tambahan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"  >
        
        <table class="table datable">
          <thead>
            <tr>
              <th scope="col">SKU Var</th>
              <th scope="col">Name</th>
              <th scope="col">Bahan</th> 
              <th scope="col">Uk. Bahan</th>
              <th scope="col">Multiply</th>
              <th scope="col">Cetak</th>
              <th scope="col">Laminasi</th>
              <th scope="col">Cutting</th>
              <th scope="col">Finish</th>
              <th scope="col">Qty Jadi</th>
              <th scope="col">Qty Bahan</th>
            </tr>
          </thead>
          <tbody id="table_child">
            <tr>
              <td><small>SP2407002-V01<br>
              <td><small>Jumlah 50</small></td>
              <td><small>BW Carton</small></td>
              <td><small>A3</td>
              <td><small>15,3 x 9,5</small></td>
              <td><small>6</small></td>
              <td><small>1</small></td>
              <td><small>4/4 (2 Sisi)</small></td>
              <td><small>Tanpa Laminasi</small></td>
              <td><small>Die Cut</small></td>
              <td><small>ESKO</small></td>
            </tr>
            <tr>
              <td><small>SAMPLE<br>
              <td><small>ERROR </small></td>
              <td><small>js</small></td>
              <td><small>get_child_table</td>
              <td><small>SAMPLE</small></td>
              <td><small>SAMPLE<br>
              <td><small>ERROR </small></td>
              <td><small>js</small></td>
              <td><small>get_child_table</td>
              <td><small>SAMPLE</small></td>
              <td><small>SAMPLE</small></td>
              <td><small>SAMPLE</small></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  >Close</button>
      </div>
    </div>
  </div>
</div>
