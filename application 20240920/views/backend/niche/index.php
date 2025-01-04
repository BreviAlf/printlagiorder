<script>
  function AlertDelete(i) 
  {
    $("#ModalDelete").modal('show');
    $("#niche_id").val(i);
  }

  function DoDelete()
  {
    var niche_id = $("#niche_id").val();
    window.open("<?php echo site_url().'backend/niche/delete/';?>"+niche_id, "_self");
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
        <h5 class="modal-title">Delete Niche</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Are you sure?</p>

          <input type="hidden" id="niche_id" value=''>


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
            <h5 class="card-title"><?php echo $title;?></h5>
              <div class="d-flex mt-2 flex-row-reverse">
                <div class="p-2">
                  <a href="<?php echo site_url();?>backend/niche/add" class="btn btn-primary float-right">Add Niche</a>
                  <a href="#" class="btn btn-danger float-right">Delete Multiple</a>
               </div>
              </div>
              <?php echo $this->session->flashdata('message_type');?>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($arr_niche as $row_niche):?>
                    <tr>
                      <th scope="row"><?php echo $row_niche['niche_id'];?></th>
                      <td>
                          <img style="width:100px;" class="img-thumbnail" src="<?php echo site_url().''.$row_niche['niche_img_url'];?>" alt="">
                      </td>
                      <td>
                         <?php echo $row_niche['niche_name'];?>
                      </td>
                      <td><?php echo $row_niche['niche_status'];?></td>
                      <td><a href="<?php echo site_url().'backend/niche/edit/'.$row_niche['niche_id'];?>" class="btn btn-primary btn-sm">Edit</a> 
                      <a href="#" onclick="AlertDelete(<?php echo $row_niche['niche_id'];?>)" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>