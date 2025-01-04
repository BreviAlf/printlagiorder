<script>
  //function AddSubmit() {
  //     $("#addprod").submit();
  //}

  function CheckSave() {
    var sku_mp = $("#prod_sku_mp").val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxCheckSave' ?>',
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
            $("#ModalCheck").modal('show');
            $("#prod_name").text(json_string.prod_name);
            $("#prod_name_mp").text(json_string.prod_name_mp);
            $("#prod_sku_mp_2").text(json_string.prod_sku_mp);
          }else{
            $('#addprod').submit();
          }
        },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }
</script>

<!-- modal alert -->
<div class="modal fade" id="ModalCheck" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Duplicated SKU</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>SKU sudah ada!!!</p>
          <p id="prod_sku_mp_2" class='p-large'></p>
          <p id="prod_name" class='p-large'></p>
          <p id="prod_name_mp" class='p-large'></p>

          <input type="hidden" id="prod_id" value=''>


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
        <h5 class="card-title"><?php echo $title; ?></h5>
        <?php echo $this->session->flashdata('message_type'); ?>
        <div class="d-flex mt-4 flex-row-reverse">
          <div class="p-2">

          </div>
        </div>
        <form id="addprod" action="<?php echo site_url() ?>backend/product/add" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
          <div class="row">
            <div class="col-lg-7">
              <div class="row mb-3">
                <label for="prod_name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                   <?php echo form_error('prod_name', '<div class="alert alert-danger">', '</div>'); ?>
                  <div class="input-group has-validation">
                   
                    <input type="text" name="prod_name" id="prod_name" class="form-control" required>
                    <div class="invalid-feedback">Please enter product name.</div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
              <label for="prod_name_mp" class="col-sm-3 col-form-label">Name (Marketplace)</label>
                <div class="col-sm-9">
                <?php echo form_error('prod_name_mp', '<div class="alert alert-danger">', '</div>'); ?>
                  <div class="input-group has-validation">
                    
                    <input type="text" name="prod_name_mp" id="prod_name_mp" class="form-control" required>
                    <div class="invalid-feedback">Please enter product name.</div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="prod_desc" class="col-sm-3 col-form-label">Desc</label>
                <div class="col-sm-9">
                  <textarea name="prod_desc" class="form-control" style="height: 100px"></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label for="prod_mp_link_1" class="col-sm-3 col-form-label">MP Link 1</label>
                <div class="col-sm-9">
                  <input type="text" name="prod_mp_link_1" id="prod_mp_link_1" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">MP Link 2</label>
                <div class="col-sm-9">
                  <input type="text" name="prod_mp_link_2" id="prod_mp_link_2" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label">Image MP</label>
                <div class="col-sm-9">
                  <input class="form-control" type="file" name="file_mockup" id="file_mockup">
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">SKU</label>
                <div class="col-sm-9">
                <?php echo form_error('prod_sku', '<div class="alert alert-danger">', '</div>'); ?>
                  <input type="text" name="prod_sku" id="prod_sku" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">SKU MP</label>
                <div class="col-sm-9">
                <?php echo form_error('prod_sku_mp', '<div class="alert alert-danger">', '</div>'); ?>
                  <input type="text" name="prod_sku_mp" id="prod_sku_mp" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-9">
                  <input type="number" name="prod_price" id="prod_price" class="form-control">
                </div>
              </div>

              
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Category</label>
                <div class="col-sm-9">
                  <?php echo DropdownCategory(FALSE, 'prod_cat_id'); ?>
                </div>
              </div>

           
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <?php echo DropdownStatus(FALSE, 'prod_status'); ?>
                </div>
              </div>

              <div class="d-flex mt-2 flex-row-reverse">
                <div class="p-2">
                  <button onClick="CheckSave()" class="btn btn-primary float-right" type="button">Save</button>
                  <a href="<?php echo site_url(); ?>backend/product/" class="btn btn-warning float-right">Cancel</a>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>