<script>
  function AlertDelete(i) {
    $("#ModalDelete").modal('show');
    $("#material_id").val(i);
  }

  function DoDelete() {
    var material_id = $("#material_id").val();
    window.open("<?php echo site_url() . 'backend/material/delete/'; ?>" + material_id, "_self");
  }

  function DoBatal() {
    $("#ModalDelete").modal('hide');
  }


  function OpenProdDesc(i) {
    $("#ModalProdDesc" + i).modal('show');
  }

  function DoCancel(i) {
    $("#ModalProdDesc" + i).modal('hide');
  }


  function MyCheck(i) {
  // Get the checkbox
    var checkBox = document.getElementById("myCheck"+i);
    // Get the output text

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
      $("#alert_check"+i).css("display", "block");
    } else {
      $("#alert_check"+i).css("display", "none");
    }
}
</script>



<!-- modal alert -->
<div class="modal fade" id="ModalDelete" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Are you sure?</p>

          <input type="hidden" id="material_id" value=''>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="DoBatal()" class="btn btn-secondary">Batal</button>
        <button type="button" onclick="DoDelete()" class="btn btn-danger">Hapus Data</button>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-lg-12">

    <div class="card">

      <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <div class="d-flex mt-2 flex-row-reverse">
          <div class="p-2">
            <a href="<?php echo site_url(); ?>backend/material/add" class="btn btn-primary float-right">Add material</a>
            <a href="#" class="btn btn-danger float-right">Delete Multiple</a>
          </div>
        </div>
        <?php echo $this->session->flashdata('message_type'); ?>
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Material Code</th>
              <th scope="col">Material Name</th>
              <th scope="col">Material gsm</th>
              <th scope="col">Material price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_cat as $row_cat) : ?>
              <tr>
                <th scope="row"><?php echo $row_cat['material_id']; ?></th>
                <td>
                <?php echo $row_cat['material_code']; ?>
                </td>
                <td>
                <?php echo $row_cat['material_name']; ?>
                </td>
                <td>
                  <?php echo $row_cat['material_gsm']; ?>
                </td>
                <td>
                  <?php echo $row_cat['material_price']; ?>
                </td>
                <td>
                    <a href="<?php echo site_url() . 'backend/material/edit/' . $row_cat['material_id']; ?>" class="btn btn-primary btn-sm">Edit</a>

                    <!--a href="javascript:void(0)" onclick="OpenProdDesc(<?php echo $row_cat['material_id']; ?>)" class="btn btn-primary btn-sm">Prod Desc</a-->
                    <a href="#" onclick="AlertDelete(<?php echo $row_cat['material_id']; ?>) " class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>

              <!-- modal alert -->
              <div class="modal fade" id="ModalProdDesc<?php echo $row_cat['material_id']; ?>" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Prod Desc</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?php echo site_url() . 'backend/category/edit_prod_desc/'?>" method="post">
                    <div class="modal-body">
                      <input type="hidden" name="material_id" value="<?php echo $row_cat['material_id'];?>">
                      <textarea name="cat_prod_desc" class="form-control" style="height: 300px"><?php echo $row_cat['cat_prod_desc']; ?></textarea>
                    </div>
                    <div class="modal-footer">
                    <div id="alert_check<?php echo $row_cat['material_id'];?>" style="display:none;" class="alert alert-warning  alert-dismissible fade show" role="alert">
                      <p>All product description in this category will be REPLACED and can not be undone!!</p>
                    </div>
                    <small>Save and apply to all product in <?php echo $row_cat['cat_name'];?></small>
                      <input class="form-check-input" id="myCheck<?php echo $row_cat['material_id'];?>" onclick="MyCheck(<?php echo $row_cat['material_id']; ?>)" type="checkbox" value="1" name="save_to_all" id="prodid">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" onclick="DoCancel(<?php echo $row_cat['material_id']; ?>)" class="btn btn-secondary">Batal</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>


            <?php endforeach; ?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
</div>

<?php foreach ($arr_cat as $row_cat) : ?>

<?php endforeach; ?>
</section>