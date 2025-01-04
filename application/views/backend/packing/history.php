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
    var pack_id = $("#pack_id").val();
    window.open("<?php echo site_url() . 'backend/packing/cetak_pack/'; ?>" +id, "_blank");
  }

  function DoDone() {
    var pack_id = $("#pack_id").val();
    window.open("<?php echo site_url() . 'backend/packing/update/'; ?>" + pack_id+'/h', "_self");
  }

  function Lanjut(id) {
    var pack_id = $("#pack_id").val();
    window.open("<?php echo site_url() . 'backend/packing/detail/'; ?>" + id, "_self");
  }

  function DoDelete() {
    var spk_id = $("#spk_id").val();
    window.open("<?php echo site_url() . 'backend/spk/delete/'; ?>" + spk_id, "_self");
  }

  function GoDone(i,pack_no) {
    $("#ModalDone").modal('show');
    $("#pack_id").val(i);
    $("#pack_no").text(pack_no);
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
        <h5 class="modal-title">Ubah Pack Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="load_data_image">
          <p class='p-large'>Apakah anda yakin akan mengubah SEMUA status SPK dalam PACK NO</p>
          <h4 id="pack_no"></h4>
          <p class='p-large'>menjadi Delivered?</p>

          <input type="hidden" id="pack_id" value=''>


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
        <form method="post" action="<?php echo base_url()?>backend/packing/history/0">
          <div class="row ">
            <div class="col-lg-9">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <a id="p_page" class="page-link" href="<?= base_url('backend/packing/history/') ?><?=$pervious_page."/".$search_q?>"><li class="page-item" ><</li></a>
                  <a <?=$prev1?>  id="p_page2" class="page-link" href="<?= base_url('backend/packing/history/') ?><?=($pervious_page-10)."/".$search_q?>"  ><li class="page-item" ><?= $current_offset/10-1 ?></li></a>
                  <a <?=$prev2?>  id="p_page1" class="page-link" href="<?= base_url('backend/packing/history/') ?><?=$pervious_page."/".$search_q?>"  ><li class="page-item" ><?= $current_offset/10 ?></li></a>
                  <li class="page-item active"><a id="c_page" class="page-link"  ><?= $current_offset/10+1 ?></li></a>
                  <a <?=$next1?> id="n_page1" class="page-link" href="<?= base_url('backend/packing/history/') ?><?=$next_page."/".$search_q?>"   ><li class="page-item" ><?= $current_offset/10+2 ?></li></a>
                  <a <?=$next2?> id="n_page2" class="page-link" href="<?= base_url('backend/packing/history/') ?><?=($next_page+10)."/".$search_q?>"   ><li class="page-item" ><?= $current_offset/10+3 ?></li></a>
                  <a id="n_page" class="page-link" href="<?= base_url('backend/packing/history/') ?><?=$next_page."/".$search_q?>" ><li class="page-item" >></li></a>
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
              <th scope="col">No PACK</th>
              <th scope="col">Kurir</th>
              <th scope="col">Total</th> 
              <th scope="col">Created</th>
              <th scope="col">Done</th>
              <th scope="col">Status</th> 
              
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_pack as $row_pack) : ?>
              <tr>
                <td><small><?php echo $row_pack['pack_no']; ?></small></td>
                <td><small><?php echo $row_pack['pack_kurir_name']; ?></small></td>
                <td><small><?php echo CountPacking($row_pack['pack_id']);?></small></td>
                <td><small><?php echo $row_pack['pack_date_created']; ?></small></td>
                <td><small><?php echo $row_pack['pack_date_done']; ?></small></td>
                <td><small><?php echo $row_pack['pack_status']; ?></small></td>
                <td>
                    <button type="button" onclick="GoDone(<?php echo $row_pack['pack_id']; ?>,'<?php echo $row_pack['pack_no']; ?>')" class="btn btn-primary btn-sm"
                    <?php if($row_pack['pack_status'] == 'Done'){
                      echo 'disabled';
                      }?>
                    >Done</button>
                    <button type="button" onclick="Lanjut(<?php echo $row_pack['pack_id']; ?>)" class="btn btn-primary btn-sm
                    <?php if($row_pack['pack_status'] == 'Done'){
                      echo 'disabled';
                      }?>">Lanjut Scan</button>
                    <button type="button" onclick="DoCetak(<?php echo $row_pack['pack_id']; ?>)" class="btn btn-primary btn-sm">Cetak Packing List</button>
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