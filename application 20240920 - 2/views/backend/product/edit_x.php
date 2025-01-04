<script type="text/javascript">
  function DeleteColor(prod_id, color_id) {
    var prod_id = <?php echo $row_data->prod_id; ?>;
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxDeleteColor' ?>',
      cache: false,
      type: 'POST',
      data: {
        color_id: color_id,
        prod_id: prod_id
      },
      success: function(result) {
        $("#load_color").html(result);
        LoadSize(prod_id)
        LoadVarian(prod_id);

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function AddColor() {
    var color = $("#add_color").val();
    var var_1 = $("#var_1").val();
    var prod_id = <?php echo $row_data->prod_id; ?>;
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxAddColor' ?>',
      cache: false,
      type: 'POST',
      data: {
        var_1: var_1,
        color: color,
        prod_id: prod_id
      },
      success: function(result) {
        $("#var_1").val(var_1);
        $("#add_color").val('');
        $("#load_color").html(result);
        LoadVarian(prod_id);

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function AddSize(color_id) {
    var size = $("#add_size").val();
    var color_id = color_id;
    var var_2 = $("#var_2").val();
    var prod_id = <?php echo $row_data->prod_id; ?>;
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxAddSize' ?>',
      cache: false,
      type: 'POST',
      data: {
        color_id:color_id,
        var_2: var_2,
        size: size,
        prod_id: prod_id
      },
      success: function(result) {
        $("#var_2").val(var_2);
        $("#add_size").val('');
        $("#load_size").html(result);
        LoadVarian(prod_id);

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function DelVar(prod_var_id) {
    var prod_id = <?php echo $row_data->prod_id;?>;
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxDelVar';?>',
      cache: false,
      type: 'POST',
      data: {
        prod_var_id: prod_var_id,
        prod_id: prod_id
      },
      success: function(result) {
        $("#data_varian").html(result);
      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function AddVarian() {
    var prod_var_sku_var = $("#prod_var_sku_var").val();
    var prod_var_name    = $("#prod_var_name").val();
    var prod_var_finish_size = $("#prod_var_finish_size").val();
    var form = $("#add_varian");
    var formData = new FormData(form[0]);
    if(prod_var_sku_var!= "" || prod_var_name!= "" || prod_var_finish_size!= ""){
      $.ajax({
        type: "POST",
        url: $(form).prop("action"),
        data: formData,
        success: function(result) { 
          $("#data_varian").html(result);
          $('#AddVarianModal').modal('toggle');

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




  function EditVar(prod_var_id) {
    var prod_id = <?php echo $row_data->prod_id;?>;
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxEditVar';?>',
      cache: false,
      type: 'POST',
      data: {
        prod_var_id: prod_var_id,
        prod_id: prod_id
      },
      success: function(result) {
        $('#EditVarianModal').modal('show');
        $("#edit_var").html(result);
      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function CopyVar(prod_var_id) {
    var prod_id = <?php echo $row_data->prod_id;?>;
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxCopyVar';?>',
      cache: false,
      type: 'POST',
      data: {
        prod_var_id: prod_var_id,
        prod_id: prod_id
      },
      success: function(result) {
        $("#data_varian").html(result);
      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

</script>

<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <?php echo $this->session->flashdata('message_type'); ?>
        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#bordered-info" type="button" role="tab" aria-controls="info" aria-selected="true">Product Info</button>
          </li>
        </ul>


        <div class="tab-content mt-2 pt-2" id="borderedTabContent">
          <div class="tab-pane fade active show" id="bordered-info" role="tabpanel" aria-labelledby="info-tab">
            <form action="<?php echo site_url() . 'backend/product/edit/' . $row_data->prod_id; ?>" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
              <div class="row mt-4">
                <div class="col-lg-7">
                  <div class="row mb-3">
                    <label for="prod_name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <div class="input-group has-validation">
                        <?php echo form_error('prod_name', '<div class="alert alert-danger">', '</div>'); ?>
                        <input type="text" name="prod_name" id="prod_name" class="form-control" value="<?php echo $row_data->prod_name; ?>" required>
                        <div class="invalid-feedback">Please enter product name.</div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="prod_name" class="col-sm-3 col-form-label">Name (Marketplace)</label>
                    <div class="col-sm-9">
                      <div class="input-group has-validation">
                        <?php echo form_error('prod_name_mp', '<div class="alert alert-danger">', '</div>'); ?>
                        <input type="text" name="prod_name_mp" id="prod_name_mp" class="form-control" value="<?php echo $row_data->prod_name_mp; ?>" required>
                        <div class="invalid-feedback">Please enter product name on marketplace.</div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="prod_desc" class="col-sm-3 col-form-label">Desc</label>
                    <div class="col-sm-9">
                      <textarea name="prod_desc" class="form-control" style="height: 100px"><?php echo $row_data->prod_desc; ?></textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="prod_mp_link_1" class="col-sm-3 col-form-label">MP Link 1</label>
                    <div class="col-sm-9">
                      <input type="text" name="prod_mp_link_1" id="prod_mp_link_1" class="form-control" value="<?php echo $row_data->prod_mp_link_1; ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">MP Link 2</label>
                    <div class="col-sm-9">
                      <input type="text" name="prod_mp_link_2" id="prod_mp_link_2" class="form-control" value="<?php echo $row_data->prod_mp_link_2; ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-3 col-form-label">Image MP</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-3">
                          <img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->prod_img_mockup_url; ?>" alt="">
                        </div>
                        <div class="col-sm-9 align-self-center">
                          <input class="form-control" type="file" name="file_mockup" id="file_mockup">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">SKU</label>
                    <div class="col-sm-9">
                      <input type="text" name="prod_sku" id="prod_sku" class="form-control" value="<?php echo $row_data->prod_sku; ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">SKU MP</label>
                    <div class="col-sm-9">
                      <input type="text" name="prod_sku_mp" id="prod_sku_mp" class="form-control" value="<?php echo $row_data->prod_sku_mp; ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-9">
                      <input type="number" name="prod_price" id="prod_price" class="form-control" value="<?php echo $row_data->prod_price; ?>">
                    </div>
                  </div>
              
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                      <?php echo DropdownCategory($row_data->prod_cat_id, 'prod_cat_id'); ?>
                    </div>
                  </div>
                 
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <?php echo DropdownStatus($row_data->prod_status, 'prod_status'); ?>
                    </div>
                  </div>

                  <div class="d-flex mt-2 flex-row-reverse">
                    <div class="p-2">
                      <button class="btn btn-primary float-right" type="submit">Save</button>
                      <a href="<?php echo site_url(); ?>backend/product/" class="btn btn-warning float-right">Cancel</a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div><!-- End Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab2" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#bordered-info" type="button" role="tab" aria-controls="info" aria-selected="true">Varian</button>
          </li>
        </ul>

        <div class="tab-content mt-2 pt-2" id="borderedTabContent">
          <div class="tab-pane fade active show" id="bordered-info" role="tabpanel" aria-labelledby="info-tab">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddVarianModal">
                Add Varian
              </button>
              <div id="data_varian">
              <table class="table datable">
                  <thead>
                    <tr>
                      <th scope="col">SKU Var</th>
                      <th scope="col">Name</th>
                      <th scope="col">Bahan</th> 
                      <th scope="col">Uk. Bahan</th>
                      <th scope="col">Uk. Jadi</th>
                      <th scope="col">Cetak</th>
                      <th scope="col">Laminasi</th>
                      <th scope="col">Cutting</th>
                      <th scope="col">Finish</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i=1;
                    foreach ($arr_var as $row_var) : ?>
                      <tr>
                        <td><small><?php echo $row_var['prod_var_sku_var']; ?><br><a href="javascript:void(0)" onclick="EditVar(<?php echo $row_var['prod_var_id'];?>)">[EDIT]</a> 
                            <a href="javascript:void(0)" onclick="CopyVar(<?php echo $row_var['prod_var_id'];?>)">[COPY]</a></small</td></td>
                        <td><small><?php echo $row_var['prod_var_name']; ?></small></td>
                        <td><small><?php echo $row_var['prod_var_material_name']; ?></small></td>
                        <td><small><?php echo getDataTableById('tb_paper_size','paper_size_name','paper_size_id',$row_var['prod_var_paper_size_id']);?></td>
                        <td><small><?php echo $row_var['prod_var_finish_size']; ?></small></td>
                        <td><small><?php echo $row_var['prod_var_print_side']; ?></small></td>
                        <td><small><?php echo $row_var['prod_var_lamination']; ?></small></td>
                        <td><small><?php echo $row_var['prod_var_cutting']; ?></small></td>
                        <td>
                          <?php
                              if($row_var['prod_var_finishing']):
                                $ex_fin = explode('|',$row_var['prod_var_finishing']);
                                $lastElement = end($ex_fin);
                                if($ex_fin)
                                {
                                    foreach($ex_fin as $fin)
                                    {
                                      echo getDataTableById('tb_finishing','fin_name','fin_id',$fin); 
                                      if($fin != $lastElement) {
                                        echo ' | ';
                                      }
                                  }
                                }
                              endif;
                              
                          ?>

                           
                        </td>
                        <td>
                            <button type="button" onclick="DelVar(<?php echo $row_var['prod_var_id'];?>)" class="btn btn-danger btn-sm">Delete</button>
                            <button type="button" onclick="EditVar(<?php echo $row_var['prod_var_id'];?>)" class="btn btn-primary btn-sm">Edit</button>
                            <button type="button" onclick="CopyVar(<?php echo $row_var['prod_var_id'];?>)" class="btn btn-primary btn-sm">Copy</button>
                        </td>
                      </tr>
                    <?php 
                    $i++;
                  endforeach; ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="AddVarianModal" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Varian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add_varian" action="<?php echo site_url() ?>backend/product/AjaxAddVarian" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
          <div class="col-lg-6">
            <div class="row mb-3">
            <input type="hidden" name="prod_var_prod_id" id="prod_var_prod_id" class="form-control" value="<?php echo $row_data->prod_id;?>">
           
              <label for="inputText"  class="col-sm-3 col-form-label">SKU Varian</label>
              <div class="col-sm-9">
                <input type="text" name="prod_var_sku_var" id="prod_var_sku_var" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" type="text" name="prod_var_name" id="prod_var_name" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-3 col-form-label">Ukuran Jadi</label>
              <div class="col-sm-9">
                <input type="text" type="text" name="prod_var_finish_size" id="prod_var_finish_size" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
                <label for="spk_material_name" class="col-sm-3 col-form-label">Bahan / Ukuran</label>
                <div class="col-sm-9">
                  <div class="row mb-0">
                      <div class="col-sm-8">
                        <?php echo DropdownMaterial(FALSE, 'prod_var_material_id',FALSE); ?>
                      </div>
                      <div class="col-sm-4">
                      <?php echo DropdownPaperSize(FALSE, 'prod_var_paper_size_id',FALSE); ?>
                      </div>
                    </div>    
                </div>
              </div>
          </div>
          <div class="col-lg-6">
          <div class="row mb-3">
                <label for="spk_qty_material" class="col-sm-3 col-form-label">Sisi Cetak</label>
                <div class="col-sm-9">
                  <?php echo DropdownPrintSide(FALSE, 'prod_var_print_side'); ?>
                </div>
              </div>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Laminasi / Sisi</label>
                <div class="col-sm-9">
                  <div class="row mb-0">
                    <div class="col-sm-6">
                      <?php echo DropdownLaminasi(FALSE, 'prod_var_lamination'); ?>
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
                  <?php echo DropdownCutting(FALSE, 'prod_var_cutting'); ?>
                </div>
            </div>
            <div class="row mb-3">
                  <legend class="col-form-label col-sm-3 pt-0">Finishing</legend>
                  <div class="col-sm-9">
                      <?php foreach (CheckBoxFinishing(FALSE) as $row_fin):?>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="cfin[]" value='<?php echo $row_fin['fin_id'];?>' id="gridCheck1">
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
                      <button type="button" onClick="AddVarian()" class="btn btn-primary">Save changes</button>
                    </div>
    </div>
  </div>
</div>


<div class="modal fade" id="EditVarianModal" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Varian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div id="edit_var"> 
                        ...
      </div>                 
      
    </div>
  </div>
</div>