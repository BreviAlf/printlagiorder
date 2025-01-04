<script>

function SaveEditVarian() {
    
    var prod_var_sku_var = $("#prod_var_sku_var2").val();
    var prod_var_name    = $("#prod_var_name2").val();
    var prod_var_finish_size = $("#prod_var_finish_size2").val();

    var form = $("#saveedit_var");
    var formData = new FormData(form[0]);
    if(prod_var_sku_var!= "" || prod_var_name!= "" || prod_var_finish_size!= ""){
      $.ajax({
        type: "POST",
        url: $(form).prop("action"),
        data: formData,
        success: function(result) { 
          $("#data_varian").html(result);
          $('#EditVarianModal').modal('toggle');

        },
        cache: false,
        contentType: false,
        processData: false
      });
    }else{
      alert("Lengkapi Data");
      return false;
    }

  }
</script>


<div class="modal-body">
        <form id="saveedit_var" action="<?php echo site_url() ?>backend/product/AjaxSaveEdit" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
          <div class="col-lg-6">
            <div class="row mb-3">
            <input type="hidden" name="prod_var_prod_id" id="prod_var_prod_id" class="form-control" value="<?php echo $row_var->prod_var_prod_id;?>">
            <input type="hidden" name="prod_var_id" id="prod_var_id" class="form-control" value="<?php echo $row_var->prod_var_id;?>">
           
              <label for="inputText"  class="col-sm-3 col-form-label">SKU Varian</label>
              <div class="col-sm-9">
                <input type="text" name="prod_var_sku_var" id="prod_var_sku_var2" class="form-control" value="<?php echo $row_var->prod_var_sku_var;?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" type="text" name="prod_var_name" id="prod_var_name2" class="form-control" value="<?php echo $row_var->prod_var_name;?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-3 col-form-label">Ukuran Jadi</label>
              <div class="col-sm-9">
                <input type="text" type="text" name="prod_var_finish_size" id="prod_var_finish_size2" class="form-control" value="<?php echo $row_var->prod_var_finish_size;?>">
              </div>
            </div>
            <div class="row mb-3">
                <label for="spk_material_name" class="col-sm-3 col-form-label">Bahan / Ukuran</label>
                <div class="col-sm-9">
                  <div class="row mb-0">
                      <div class="col-sm-8">
                        <?php echo DropdownMaterial($row_var->prod_var_material_id, 'prod_var_material_id',FALSE); ?>
                      </div>
                      <div class="col-sm-4">
                      <?php echo DropdownPaperSize($row_var->prod_var_paper_size_id, 'prod_var_paper_size_id',FALSE); ?>
                      </div>
                    </div>    
                </div>
              </div>
          </div>
          <div class="col-lg-6">
          <div class="row mb-3">
                <label for="spk_qty_material" class="col-sm-3 col-form-label">Sisi Cetak</label>
                <div class="col-sm-9">
                  <?php echo DropdownPrintSide($row_var->prod_var_print_side, 'prod_var_print_side'); ?>
                </div>
              </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Laminasi / Sisi</label>
                <div class="col-sm-9">
                  <div class="row mb-0">
                    <div class="col-sm-6">
                      <?php echo DropdownLaminasi($row_var->prod_var_lamination, 'prod_var_lamination'); ?>
                    </div>
                    <div class="col-sm-3">
                      <?php echo DropdownSisiLaminasi(FALSE, 'prod_var_lamination_side'); ?>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Cutting</label>
                <div class="col-sm-9">
                  <?php echo DropdownCutting($row_var->prod_var_cutting, 'prod_var_cutting'); ?>
                </div>
            </div>
            <div class="row mb-3">
                  <legend class="col-form-label col-sm-3 pt-0">Finishing</legend>
                  <div class="col-sm-9">

                      <?php 
                      $arr = explode('|',$row_var->prod_var_finishing);
                      
                      
                      foreach (CheckBoxFinishing(FALSE) as $row_fin):?>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="cfin[]" value='<?php echo $row_fin['fin_id'];?>' id="gridCheck1"
                      <?php 
                        if(in_array($row_fin['fin_id'],$arr)){
                            echo 'checked ';
                        }

                      ?>
                      
                      >
                      <label class="form-check-label" for="gridCheck1">
                        <?php echo $row_fin['fin_name'];?>
                      </label>
                    </div>
                    <?php endforeach;?>

                  </div>
            </div>
          </div>
        </form>


      </div>
      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" onClick="SaveEditVarian()" class="btn btn-primary">Save changes</button>
                    </div>