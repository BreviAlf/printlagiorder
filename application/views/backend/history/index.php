<script>
  function UploadCsv() {
    var form = $("#upload_csv");
    var formData = new FormData(form[0]);
    $.ajax({
      type: "POST",
      url: $(form).prop("action"),
      //dataType: 'json', //not sure but works for me without this
      data: formData,
      //cache: false, //not sure but works for me without this
      success: function(result) {
        $("#load_data").html(result);
      },
      cache: false,
      contentType: false,
      processData: false
    });
  }

  function UploadLinkShopee() {
    var form = $("#upload_link_shopee");
    var formData = new FormData(form[0]);
    $.ajax({
      type: "POST",
      url: $(form).prop("action"),
      data: formData,
      success: function(result) {
        $("#load_data_link_shopee").html(result);
      },
      cache: false,
      contentType: false,
      processData: false
    });
  }

  function ChangeCategory(i) {
    var cat_id = i;

    $.ajax({
      url: '<?php echo site_url() . 'backend/product/AjaxChangeImageSize' ?>',
      cache: false,
      type: 'POST',
      data: {
        cat_id: cat_id
      },
      success: function(result) {
        //alert('popup updated');
        $("#size_guide_url").val(result);

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });

  }
</script>

<script>
  function GoProcess(i) {
    $("#ModalProcess").modal('show');
    $("#spk_id").val(i);
  }

  function DoCetak(id) {
    var spk_id = $("#spk_id").val();
    window.open("<?php echo site_url() . 'backend/batchspk/cetak_batch/'; ?>" +id, "_blank");
  }

  function DoDone() {
    var spk_batch_id = $("#spk_batch_id").val();
    window.open("<?php echo site_url() . 'backend/history/done/'; ?>" + spk_batch_id, "_self");
  }

  function DoDelete(id) {
    window.open("<?php echo site_url() . 'backend/history/delete/'; ?>" + id, "_self");
  }

  function DoScan(id) {
    window.open("<?php echo site_url() . 'backend/batchspk/detail/'; ?>" + id, "_self");
  }


  function GoDetail(id) {
    window.open("<?php echo site_url() . 'backend/history/detail/'; ?>" + id, "_self");
  }

  function GoDone(i,batch_no) {
    $("#ModalDone").modal('show');
    $("#spk_batch_id").val(i);
    $("#spk_batch_no").text(batch_no);
  }

  function DoBatal() {
    $("#ModalDone").modal('hide');
  }
</script>



<!-- modal alert -->
<div class="modal fade" id="ModalDone" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah BATCH Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Apakah anda yakin akan mengubah SEMUA status SPK dalam BATCH NO</p>
          <h4 id="spk_batch_no"></h4>
          <p class='p-large'>menjadi Done / Selesai?</p>

          <input type="hidden" id="spk_batch_id" value=''>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="DoBatal()" class="btn btn-secondary">Batal</button>
        <button type="button" onclick="DoDone()" class="btn btn-primary">Ubah Done</button>
      </div>
    </div>
  </div>
</div>



<div class="row">
  <div class="col-lg-12">

    <div class="card">

      <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>

        <!-- Pagination -->
        <?php echo $this->session->flashdata('message_type'); 
          $max_page = intval($row_count / 10);
          if($row_count % 10 > 0) {$max_page += 1;}
          if($current_offset < 10 ){ $pervious_page = 0;} else { $pervious_page = $current_offset - 10;}
          if($current_offset + 10 > $row_count ){ $next_page = $current_offset;} else { $next_page = $current_offset + 10;}              
        ?>
        <div hidden >
        kontrol pagination
        <p id="current_offset">current_offset<?= $current_offset ?></p> 
        <p id="current_page">current_page<?= $current_offset/10+1 ?></p> 
        <p id="row_count">row_count<?= $row_count ?></p>
        <p id="max_page">max_page<?= $max_page ?></p>
        </div>
        
        <?php
          // kontrol pagination overflow
          $prev1 = "";
          $prev2 = "";
          $next1 = "";
          $next2 = "";

          if($current_offset/10-1 <=0){$prev1 = "hidden";}
          if($current_offset <=0){$prev2 = "hidden";}
          if($current_offset/10+2 > $max_page){$next1 = "hidden";}
          if($current_offset/10+3 > $max_page){$next2 = "hidden";}
        ?>

        
        <form method="post" action="<?php echo base_url()?>backend/history/index/0">
          <div class="row ">
            <div class="col-lg-9">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <a id="p_page" class="page-link" href="<?= base_url('backend/history/index/') ?><?=$pervious_page."/".$search_q?>"><li class="page-item" ><</li></a>
                  <a <?=$prev1?>  id="p_page2" class="page-link" href="<?= base_url('backend/history/index/') ?><?=($pervious_page-10)."/".$search_q?>"  ><li class="page-item" ><?= $current_offset/10-1 ?></li></a>
                  <a <?=$prev2?>  id="p_page1" class="page-link" href="<?= base_url('backend/history/index/') ?><?=$pervious_page."/".$search_q?>"  ><li class="page-item" ><?= $current_offset/10 ?></li></a>
                  <li class="page-item active"><a id="c_page" class="page-link"  ><?= $current_offset/10+1 ?></li></a>
                  <a <?=$next1?> id="n_page1" class="page-link" href="<?= base_url('backend/history/index/') ?><?=$next_page."/".$search_q?>"   ><li class="page-item" ><?= $current_offset/10+2 ?></li></a>
                  <a <?=$next2?> id="n_page2" class="page-link" href="<?= base_url('backend/history/index/') ?><?=($next_page+10)."/".$search_q?>"   ><li class="page-item" ><?= $current_offset/10+3 ?></li></a>
                  <a id="n_page" class="page-link" href="<?= base_url('backend/history/index/') ?><?=$next_page."/".$search_q?>" ><li class="page-item" >></li></a>
                </ul>       
              </nav>
            </div>
            <div class="col-lg-3">
              <div class="input-group mb-3">
                <input type="text" id="search_q" name="search_q" class="form-control" placeholder="<?=$search_q?>"   aria-label="Recipient's username" aria-describedby="basic-addon2" >
                <div class="input-group-append">
                  <button class="input-group-text btn-primary" id="basic-addon2" type="submit"  ><i class="ri-search-fill" ></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>


        <div class="d-flex mt-2 flex-row-reverse">
          <div class="p-2">
            
          </div>
        </div>
        <?php echo $this->session->flashdata('message_type'); ?>
        <!-- Table with stripped rows -->
        <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No Batch</th>
              <th scope="col">User</th>
              <th scope="col">Name</th>
              <th scope="col">Total</th>
              <th scope="col">Print</th>
              <th scope="col">Done</th>
              <th scope="col">Created</th> 
              <th scope="col">Deadline</th> 
              <th scope="col">Process</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_batch as $row_batch) : ?>
              <tr>
                <td><small><?php echo $row_batch['batch_spk_no']; ?></small><br>
                <button type="button" onclick="GoDetail('<?php echo $row_batch['batch_spk_id'];?>')" class="btn btn-primary mt-2">Detail</button></td>
                <td><small><?php echo getDataTableById('tb_user','user_name','user_id',$row_batch['batch_spk_user_id']);?></small></td>
                
                <td><small><?php echo $row_batch['batch_spk_name']; ?></small></td>
                <td><small><?php echo CountBatch($row_batch['batch_spk_id']);?></small></td>
                <td><small><?php echo CountSPKDone_Print($row_batch['batch_spk_id']);?></small></td>
                <td><small><?php echo CountSPKDone($row_batch['batch_spk_id']);?></small></td>
                <td><small><?php echo $row_batch['batch_spk_date_created']; ?></small></td>
                <td><small><?php echo $row_batch['batch_spk_date_deadline'];?></small></td>
                <td><small><?php echo $row_batch['batch_spk_date_process']; ?></small></td>
                <!--<td><small><?php //echo $row_batch['batch_spk_date_done']; ?></small></td>-->
                <td>
                
                <?php if ($row_batch['batch_spk_date_done']!=""):?>

                  <button type="button" onclick="" class="btn btn-sm btn-primary" disabled>Done</button>
                  
                  <button type="button" onclick="DoCetak(<?php echo $row_batch['batch_spk_id']; ?>)" class="btn btn-sm btn-primary">Cetak</button>
                <?php else:?>
                  <?php if ($row_batch['batch_spk_date_process']!=""):?>
                    <button type="button" onclick="GoDone(<?php echo $row_batch['batch_spk_id'];?>,'<?php echo $row_batch['batch_spk_no']; ?>')" class="btn btn-sm btn-primary">Done</button>

                    <?php else:?>
                      <?php if ($this->session->userdata('user_name') == 'sys'):?>
                  <button type="button" onclick="DoDelete(<?php echo $row_batch['batch_spk_id']; ?>)" class="btn btn-sm btn-danger">Del</button>
                <?php endif;?>
                      <button type="button" onclick="" class="btn btn-sm btn-primary" disabled>Done</button>
                    <?php endif;?>
                    <button type="button" onclick="DoScan(<?php echo $row_batch['batch_spk_id']; ?>)" class="btn btn-sm btn-primary">Scan</button>
                    <button type="button" onclick="DoCetak(<?php echo $row_batch['batch_spk_id']; ?>)" class="btn btn-sm btn-primary">Cetak</button>
                <?php endif;?>
             
               
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
</div>

<div class="modal fade" id="ModalUploadProduct" role="dialog">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload CSV File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="upload_csv" action="<?php echo site_url() ?>backend/product/upload_csv" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
          <div class="col-lg-6">
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-3 col-form-label">File</label>
              <div class="col-sm-9">
                <div class="input-group has-validation">
                  <input class="form-control" type="file" name="file_product" id="file_product" required>
                  <a href="#" onclick="UploadCsv()" class="btn btn-primary float-right">Upload</a>
                  <div class="invalid-feedback">Please enter file.</div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div id="load_data">

        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalExportProduct" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Export</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="shopee-tab" data-bs-toggle="tab" data-bs-target="#bordered-shopee" type="button" role="tab" aria-controls="shopee" aria-selected="true">Shopee</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tokopedia-tab" data-bs-toggle="tab" data-bs-target="#bordered-tokopedia" type="button" role="tab" aria-controls="tokopedia" aria-selected="false">Tokopedia</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="lazada-tab" data-bs-toggle="tab" data-bs-target="#bordered-lazada" type="button" role="tab" aria-controls="lazada" aria-selected="false">Lazada</button>
          </li>
        </ul>
        <div class="tab-content pt-2" id="borderedTabContent">
          <div class="tab-pane fade active show" id="bordered-shopee" role="tabpanel" aria-labelledby="shopee-tab">
            <form action="<?php echo site_url() ?>backend/product/export_shopee" method="post">
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Product Category</label>
                <div class="col-sm-9">
                  <?php echo DropdownCategory(FALSE, 'prod_cat_id'); ?>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Niche</label>
                <div class="col-sm-9">
                  <?php echo DropdownNiche(FALSE, 'prod_niche_id', FALSE); ?>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Kode Kategori</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="code_cat" id="code_cat">
                </div>
                <label for="inputEmail3" class="col-sm-3 col-form-label">Kode Integrasi Varian</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="code_intg" id="code_intg">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Additional</label>
                <div class="col-sm-9">
                  <div class="form-check">
                    <input checked class="form-check-input" type="checkbox" name="color_size" id="color_size" value="1">
                    <label class="form-check-label" for="gridCheck1">
                      Color and size <small>(Get color for each product Ex : White = S,M,L; Black = S,M)</small>
                    </label>
                  </div>
                  <div class="form-check">
                    <input checked class="form-check-input" type="checkbox" name="weight" id="weight" value="1">
                    <label class="form-check-label" for="gridCheck1">
                      Berat <small>(Get weight for each product in Kg, By Default is 0,5 Kg)</small>
                    </label>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Dimensi</label>
                <div class="col-sm-9">
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-1 col-form-label">P</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" name="size_p" id="size_p">
                    </div>
                    <label for="inputEmail3" class="col-sm-1 col-form-label">L</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" name="size_l" id="size_l">
                    </div>
                    <label for="inputEmail3" class="col-sm-1 col-form-label">T</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" name="size_t" id="size_t">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Kurir Aktif</label>
                <div class="col-sm-9">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kurir_1" id="kurir_1" value="1">
                    <label class="form-check-label" for="gridCheck1">
                      Jasa Kirim 1
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kurir_2" id="kurir_2" value="1">
                    <label class="form-check-label" for="gridCheck1">
                      Jasa Kirim 2
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kurir_3" id="kurir_3" value="1">
                    <label class="form-check-label" for="gridCheck1">
                      Jasa Kirim 3
                    </label>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Size Guide Image URL</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="size_guide_url" id="size_guide_url">
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form><!-- End Horizontal Form -->


          </div>
          <div class="tab-pane fade" id="bordered-tokopedia" role="tabpanel" aria-labelledby="tokopedia-tab">
            Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
          </div>
          <div class="tab-pane fade" id="bordered-lazada" role="tabpanel" aria-labelledby="lazada-tab">
            Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
          </div>
        </div><!-- End Bordered Tabs -->
        <div id="data_export">
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ModalUpdateLink" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Link MP </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="shopee2-tab" data-bs-toggle="tab" data-bs-target="#bordered-shopee2" type="button" role="tab" aria-controls="shopee2" aria-selected="true">Shopee</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tokopedia2-tab" data-bs-toggle="tab" data-bs-target="#bordered-tokopedia2" type="button" role="tab" aria-controls="tokopedia2" aria-selected="false">Tokopedia</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="lazada2-tab" data-bs-toggle="tab" data-bs-target="#bordered-lazada2" type="button" role="tab" aria-controls="lazada2" aria-selected="false">Lazada</button>
          </li>
        </ul>
        <div class="tab-content pt-2" id="borderedTabContent">
          <div class="tab-pane fade active show" id="bordered-shopee2" role="tabpanel" aria-labelledby="shopee2-tab">
          <form id="upload_link_shopee" action="<?php echo site_url() ?>backend/product/upload_link_shopee" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
            <div class="col-lg-6">
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label">File</label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    <input class="form-control" type="file" name="file_link_shopee" id="file_link_shopee" required>
                    <a href="#" onclick="UploadLinkShopee()" class="btn btn-primary float-right">Upload</a>
                    <div class="invalid-feedback">Please enter file.</div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <div id="load_data_link_shopee">

          </div>

          </div>
          <div class="tab-pane fade" id="bordered-tokopedia2" role="tabpanel" aria-labelledby="tokopedia2-tab">
            Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
          </div>
          <div class="tab-pane fade" id="bordered-lazada2" role="tabpanel" aria-labelledby="lazada2-tab">
            Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
          </div>
        </div><!-- End Bordered Tabs -->
        <div id="data_export">
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>