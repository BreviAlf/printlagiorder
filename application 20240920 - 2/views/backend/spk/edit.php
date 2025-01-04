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

  function DeleteSize(prod_id, uid) {
    var size_name = $("#size_name_"+uid).val();
    var prod_id = <?php echo $row_data->prod_id; ?>;
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxDeleteSize' ?>',
      cache: false,
      type: 'POST',
      data: {
        uid: uid,
        size_name: size_name,
        prod_id: prod_id
      },
      success: function(result) {
        $("#load_size").html(result);
        LoadVarian(prod_id);
      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function LoadVarian(prod_id)
  {
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxLoadVarian' ?>',
      cache: false,
      type: 'POST',
      data: {
        prod_id: prod_id
      },
      success: function(result) {
        $("#load_varian").html(result);
      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function LoadSize(prod_id)
  {
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxLoadSize' ?>',
      cache: false,
      type: 'POST',
      data: {
        prod_id: prod_id
      },
      success: function(result) {
        $("#load_size").html(result);
      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function UpdateSizeStock() {
    var form = $("#update_size_stock");
    var formData = new FormData(form[0]);
    $.ajax({
      type: "POST",
      url: $(form).prop("action"),
      data: formData,
      success: function(result) {
        $("#load_varian").html(result);
      },
      cache: false,
      contentType: false,
      processData: false
    });
  }

  function UpdateVar(prod_id,type)
  {
    var var_1 = $("#var_1").val();
    var var_2 = $("#var_2").val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxUpdateVar'?>',
      cache: false,
      type: 'POST',
      data: {
        prod_id: prod_id,
        type: type,
        var_1: var_1,
        var_2: var_2

      },
      success: function(result) {
        alert('update success')
        //$("#load_size").html(result);
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
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="varian-tab" data-bs-toggle="tab" data-bs-target="#bordered-varian" type="button" role="tab" aria-controls="varian" aria-selected="false">Varian</button>
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
                    <label for="inputNumber" class="col-sm-3 col-form-label">Mockup</label>
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
                  <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-3 col-form-label">Banner</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-3">
                          <img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->prod_img_banner_url; ?>" alt="">
                        </div>
                        <div class="col-sm-9 align-self-center">
                          <input class="form-control" type="file" name="file_banner" id="file_banner">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-3 col-form-label">Design</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-3">
                          <img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->prod_img_design_url; ?>" alt="">
                        </div>
                        <div class="col-sm-9 align-self-center">
                          <input class="form-control" type="file" name="file_design" id="file_design">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">Code</label>
                    <div class="col-sm-9">
                      <div class="input-group has-validation">
                        <?php echo form_error('prod_code', '<div class="alert alert-danger">', '</div>'); ?>
                        <input type="text" name="prod_code" id="prod_code" class="form-control" value="<?php echo $row_data->prod_code; ?>" required>
                        <div class="invalid-feedback">Product / Catalog Code</div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">SKU</label>
                    <div class="col-sm-9">
                      <input type="text" name="prod_sku" id="prod_sku" class="form-control" value="<?php echo $row_data->prod_sku; ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-9">
                      <input type="number" name="prod_price" id="prod_price" class="form-control" value="<?php echo $row_data->prod_price; ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">Price Disc</label>
                    <div class="col-sm-9">
                      <input type="number" name="prod_price_disc" id="prod_price_disc" class="form-control" value="<?php echo $row_data->prod_price_disc; ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">Sold Web (Dummy)</label>
                    <div class="col-sm-9">
                      <input type="number" name="prod_dummy_sold" id="prod_dummy_sold" class="form-control" value="<?php echo $row_data->prod_dummy_sold; ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                      <?php echo DropdownCategory($row_data->prod_cat_id, 'prod_cat_id'); ?>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-3 col-form-label">Niche</label>
                    <div class="col-sm-9">
                      <?php echo DropdownNiche($row_data->prod_niche_id, 'prod_niche_id', FALSE); ?>
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
          <div class="tab-pane fade" id="bordered-varian" role="tabpanel" aria-labelledby="varian-tab">

            <div class="row mt-4">
              <div class="col-lg-7">
                <div class="row mb-3">
                  <label for="prod_name" class="col-sm-3 col-form-label">Variasi 1</label>
                  <div class="col-sm-9">
                    <div class="input-group has-validation">
                      <?php echo form_error('prod_name', '<div class="alert alert-danger">', '</div>'); ?>
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">Nama</span>
                        <input type="text" class="form-control" id="var_1" value="<?php echo $row_data->prod_var_1; ?>" aria-describedby="basic-addon3">
                        <a href="javascript:void(0)" onclick="UpdateVar(<?php echo $row_data->prod_id; ?>,'var_1')" class="btn btn-primary">Update </a>
                      </div>
                      <div class="invalid-feedback">Please enter product name.</div>
                    </div>
                    <div id="load_color">
                      <?php foreach (GetColor($row_data->prod_id) as $color) : ?>
                        <div class="input-group mt-2 has-validation">
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Pilihan <?php echo $color['color_parent']; ?></span>
                            <input type="text" value="<?php echo $color['color_name']; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            <a href="javascript:void(0)" onclick="DeleteColor(<?php echo $row_data->prod_id; ?>,<?php echo $color['color_id']; ?>)" class="btn btn-danger">Hapus </a>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="input-group mt-3 has-validation">
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">Pilihan</span>
                        <input type="text" value="" class="form-control" id="add_color" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="input-group mt-2 has-validation">
                      <div class="input-group">
                        <a href="javascript:void(0)" onclick="AddColor()" class="btn btn-primary">Simpan Pilihan </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="prod_name" class="col-sm-3 col-form-label">Variasi 2</label>
                  <div class="col-sm-9">
                    <div class="input-group has-validation">
                      <?php echo form_error('prod_name', '<div class="alert alert-danger">', '</div>'); ?>
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">Nama</span>
                        <input type="text" class="form-control" id="var_2" value="<?php echo $row_data->prod_var_2; ?>" aria-describedby="basic-addon3">
                        <a href="javascript:void(0)" onclick="UpdateVar(<?php echo $row_data->prod_id; ?>,'var_2')" class="btn btn-primary">Update </a>
                      </div>
                      <div class="invalid-feedback">Please enter product name.</div>
                    </div>
                    <div id="load_size">
                      <?php foreach (GetSize($row_data->prod_id, 'Y') as $size) : ?>
                        <div class="input-group mt-2 has-validation">
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Pilihan</span>
                            <input type="text" class="form-control" id="size_name_<?php echo $size['uid'];?>" value="<?php echo $size['size_name']; ?>" aria-describedby="basic-addon3">
                            <a href="javascript:void(0)" onclick="DeleteSize(<?php echo $row_data->prod_id; ?>,'<?php echo $size['uid']; ?>')" class="btn btn-danger">Hapus </a>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="input-group mt-3 has-validation">
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">Pilihan</span>
                        <input type="text" value="" class="form-control" id="add_size" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="input-group mt-2 has-validation">
                      <div class="input-group">
                        <a href="javascript:void(0)" onclick="AddSize(<?php echo GetColorParent($row_data->prod_id);?>)" class="btn btn-primary">Simpan Pilihan </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="row mb-3">
                  
                </div>
              </div>
              <div class="col-lg-12">
                  <div id="load_varian">
                    <form action="<?php echo site_url() ?>backend/product/AjaxUpdateSizeStock" id="update_size_stock" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">color id</th>
                              <th scope="col">color name</th>
                              <th scope="col">size name</th>
                              <th scope="col">Stock</th>
                              <th scope="col">Add Price</th>
                              <th scope="col">SKU Varian</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach (GetAllSize($row_data->prod_id) as $size):?>
                              <tr>
                                <td><?php echo $size['color_id'];?></td>
                                <td><?php echo $size['color_name'];?></td>
                                <td><?php echo $size['size_name'];?></td> 
                                <td><input type="text" value="<?php echo $size['size_stock'];?>" class="form-control" name="size_stock_<?php echo $size['uid'];?>" id="size_stock_<?php echo $size['uid'];?>" aria-describedby="basic-addon3"></td> 
                                <td><input type="text" value="<?php echo $size['size_add_price'];?>" class="form-control" name="size_add_price_<?php echo $size['uid'];?>" id="size_add_price_<?php echo $size['uid'];?>" aria-describedby="basic-addon3"></td> 
                                <td><input type="text" value="<?php echo $size['size_sku'];?>" class="form-control" name="size_sku_<?php echo $size['uid'];?>" id="size_sku_<?php echo $size['uid'];?>" aria-describedby="basic-addon3"></td> 
                              </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                        <div class="d-flex mt-2 flex-row-reverse">
                        <input type="hidden" name="prod_id" value="<?php echo $row_data->prod_id;?>">
                        <a href="javascript:void(0)" onclick="UpdateSizeStock()" class="btn btn-primary float-right">Save</a>
                        </div>
                    </form>
                   
                  </div>
              </div>
            </div>
          </div>
        </div><!-- End Bordered Tabs -->
      </div>
    </div>
  </div>
</div>