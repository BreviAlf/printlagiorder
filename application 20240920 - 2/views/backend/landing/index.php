<script type="text/javascript">
  function OpenProductList(i) {
    var landing_id = i;
    $.ajax({
      url: '<?php echo site_url() . 'backend/landing/AjaxProductList' ?>',
      cache: false,
      type: 'POST',
      data: {
        landing_id: landing_id
      },
      success: function(result) {
        //var json_string = eval(json);
        //alert(result);
        //$('#sess_uid').text(json_string.sess_uid);
        //var ss = '<p>tes</p>';
        $("#load_data_product").html(result);
        $("#ModalProdList").modal('show');

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }
</script>

<script type="text/javascript">
  function OpenCustList(i) {
    var landing_id = i;
    $.ajax({
      url: '<?php echo site_url() . 'backend/landing/AjaxCustList' ?>',
      cache: false,
      type: 'POST',
      data: {
        landing_id: landing_id
      },
      success: function(result) {
        //var json_string = eval(json);
        //alert(result);
        //$('#sess_uid').text(json_string.sess_uid);
        //var ss = '<p>tes</p>';
        $("#load_data_cust_list").html(result);
        $("#ModalCustList").modal('show');

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function OpenImageBanner(i) {
    var landing_id = i;
    $.ajax({
      url: '<?php echo site_url() . 'backend/landing/AjaxImageBanner' ?>',
      cache: false,
      type: 'POST',
      data: {
        landing_id: landing_id
      },
      success: function(result) {
        //var json_string = eval(json);
        //alert(result);
        //$('#sess_uid').text(json_string.sess_uid);
        //var ss = '<p>tes</p>';
        $("#load_data_image").html(result);
        $("#ModalImageBanner").modal('show');

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function AlertDelete(i) 
  {
    $("#ModalDelete").modal('show');
    $("#prod_id").val(i);
  }

  function DoDelete()
  {
    var prod_id = $("#prod_id").val();
    window.open("<?php echo site_url() . 'backend/landing/delete/';?>"+prod_id, "_self");
  }

  function DoBatal()
  {
    //alert('dismis');
    $("#ModalDelete").modal('hide');
  }
</script>

<!-- modal manage product -->
<div class="modal fade" id="ModalImageBanner" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Image Banner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          ...
        </div>
      </div>
      <div class="modal-footer">
     
      </div>
    </div>
  </div>
</div>

<!-- modal manage product -->
<div class="modal fade" id="ModalProdList" role="dialog">
<div class="modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_product">
          ...
        </div>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<!-- modal alert -->
<div class="modal fade" id="ModalDelete" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Landing?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Yakin mau di hapus bre??</p>

          <input type="hidden" id="prod_id" value=''>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="DoBatal()" class="btn btn-secondary" >Batal</button>
        <button type="button" onclick="DoDelete()" class="btn btn-danger">Hapus Data</button>
      </div>
    </div>
  </div>
</div>

<!-- modal manage broadcast -->
<div class="modal fade" id="ModalCustList" role="dialog">
  <div class="modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Broadcast</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_cust_list">
          ...
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
        <div class="d-flex mt-2 flex-row-reverse">
          <div class="p-2">
            <a href="<?php echo site_url(); ?>backend/landing/add" class="btn btn-primary float-right">Add Landing Page</a>
            <a href="#" class="btn btn-danger float-right">Delete Multiple</a>
          </div>
        </div>
        <?php echo $this->session->flashdata('message_type'); ?>
        <!-- Table with stripped rows -->
        <table class="table datatable table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Header Image</th>
              <th scope="col">Name Title</th>
              <th scope="col">URL Broadcast</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_data as $row_data) : ?>
              <tr>
                <th scope="row"><?php echo $row_data['landing_id']; ?></th>
                <td>
                  <img style="width:100px;" class="img-thumbnail" src="<?php echo site_url() . '' . $row_data['landing_header_img_url']; ?>" alt="">
                </td>
                <td><?php echo $row_data['landing_name']; ?><br><span class="badge bg-primary"><i class="bi bi-star me-1"></i><?php echo $row_data['landing_page_title']; ?></span></td>
                <td><small><?php echo site_url() . 'landing/id/' . $row_data['landing_id'] .'?uid=[uid]'; ?></small></td>
                <td><?php echo $row_data['landing_status']; ?></td>
                <td>
                  <a alt="Edit Landing Page" href="<?php echo site_url() . 'backend/landing/edit/' . $row_data['landing_id']; ?>" class="btn btn-primary btn-sm"><i class="bx bx-edit"></i></a>
                  <a href="javascript:void(0);" onclick="OpenProductList(<?php echo $row_data['landing_id']; ?>)" class="btn btn-primary btn-sm"><i class="ri ri-file-list-line"></i></a>
                  <a href="javascript:void(0);" onclick="OpenCustList(<?php echo $row_data['landing_id']; ?>)" class="btn btn-primary btn-sm"><i class="ri ri-message-2-line"></i></a>
                  <a href="<?php echo site_url() . 'backend/landing/duplicate/' . $row_data['landing_id']; ?>" class="btn btn-primary btn-sm"><i class="ri ri-file-copy-2-fill"></i></a>
                  <a href="javascript:void(0);" onclick="OpenImageBanner(<?php echo $row_data['landing_id']; ?>)" class="btn btn-primary btn-sm"><i class="bi bi-card-image"></i></a>
                 
                  <?php if($row_data['landing_id']!=1):?>
                    <a href="<?php echo site_url() . 'backend/landing/duplicate_all/' . $row_data['landing_id']; ?>" class="btn btn-warning btn-sm"><i class="ri ri-file-copy-2-fill"></i></a>
                    <a href="#" onclick="AlertDelete(<?php echo $row_data['landing_id']; ?>);" class="btn btn-danger btn-sm"><i class="ri ri-delete-bin-2-line"></i></a>
                  <?php endif;?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>


      </div>
    </div>

  </div>
</div>


