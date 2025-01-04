<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <div class="d-flex mt-2 flex-row-reverse">
          <div class="p-2">
            <a href="#" class="btn btn-danger float-right">Delete Multiple</a>
          </div>
        </div>
        <?php echo $this->session->flashdata('message_type'); ?>
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">UID</th>
              <th scope="col">Product</th>
              <th scope="col">Batch</th>
              <th width="200" scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_data as $row_data) : ?>
              <tr>
                <th scope="row"><?php echo $row_data['cust_id']; ?></th>
                <td><?php echo $row_data['cust_name']; ?></td>
                <td><?php echo $row_data['cust_uid']; ?></td>
                <td><?php echo $row_data['cust_product_batch']; ?></td>
                <td><?php echo $row_data['cust_batch_name']; ?></td>
                <td><a class="btn btn-primary btn-sm" href="<?php echo site_url() . 'backend/customer/edit/' . $row_data['cust_id']; ?>">Edit</a> <a href="<?php echo site_url() . 'backend/customer/delete/' . $row_data['cust_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
</div>


<div class="modal fade" id="ModalUploadCust" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload CSV File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url() ?>backend/customer/upload" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
          <div class="col-lg-12">
            <div class="row mb-3">
              <label for="cust_batch_name" class="col-sm-3 col-form-label">Batch Name</label>
              <div class="col-sm-9">
                <div class="input-group has-validation">
                  <?php echo form_error('cust_batch_name', '<div class="alert alert-danger">', '</div>'); ?>
                  <input type="text" name="cust_batch_name" id="cust_batch_name" class="form-control" required>
                  <div class="invalid-feedback">Please enter customer batch name.</div>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-3 col-form-label">File</label>
              <div class="col-sm-9">
                <div class="input-group has-validation">
                  <input class="form-control" type="file" name="file_cust" id="file_cust" required>
                  <div class="invalid-feedback">Please enter file.</div>
                </div>
              </div>
              <div class="d-flex mt-2 flex-row-reverse">
                <div class="p-2">
                  <button class="btn btn-primary float-right" type="submit">Upload</button>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>