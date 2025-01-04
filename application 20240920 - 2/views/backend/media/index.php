<script>
  function AlertDelete(i) 
  {
    $("#ModalDelete").modal('show');
    $("#media_id").val(i);
  }

  function DoDelete()
  {
    var media_id = $("#media_id").val();
    window.open("<?php echo site_url() . 'backend/media/delete/';?>"+media_id, "_self");
  }

  function DoPdf()
  {
    window.open("<?php echo site_url() . 'backend/media/gen_pdf/';?>", "_blank");
  }

  function DoBatal()
  {
    $("#ModalDelete").modal('hide');
  }
</script>



<!-- modal alert -->
<div class="modal fade" id="ModalDelete" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Media</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Are you sure?</p>

          <input type="hidden" id="media_id" value=''>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="DoBatal()" class="btn btn-secondary" >Batal</button>
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
        <button type="button" onclick="DoPdf()" class="btn btn-primary">Gen PDF</button>
          <form action="<?php echo site_url();?>backend/media/add" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
            <div class="row">
              <div class="row mb-3">

                <div class="col-md-6">
                  <div class="input-group has-validation">
                    <input class="form-control" name="file_media" type="file" id="file_media" required>
                    <div class="invalid-feedback">Please enter niche name.</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-primary float-right" type="submit">Upload File</button>
                  <a href="#" class="btn btn-danger float-right">Delete Multiple</a>
                </div>
              </div>
            </div>
          </form>
        </div>
        <?php echo $this->session->flashdata('message_type'); ?>
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">File Name</th>
              <th scope="col">Type</th>
              <th scope="col">Url / Path</th>
              <th width="200" scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_data as $row_data) : ?>
              <tr>
                <th scope="row"><?php echo $row_data['media_id']; ?></th>
                <td><?php echo $row_data['media_name']; ?></td>
                <td><?php echo $row_data['media_type']; ?></td>
                <td><?php echo site_url().''.$row_data['media_url']; ?></td>
                <td><a class="btn btn-primary btn-sm" href="#">Copy Full Path</a> 
                <a href="#" onclick="AlertDelete(<?php echo $row_data['media_id']; ?>)" class="btn btn-danger btn-sm">Delete</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
</div>
</section>