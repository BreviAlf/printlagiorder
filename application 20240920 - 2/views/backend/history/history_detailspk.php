<div class="row">
  <div class="col-lg-12">

    <div class="card">

      <div class="card-body">
        <h5 class="card-title mb-0 pb-0 "><?php echo $title; ?></h5>
        <small><?php echo $row_batch->batch_spk_no;?> - <?php echo $row_batch->batch_spk_name;?></small><br>
        <small>Created : <?php echo getDataTableById('tb_user','user_name','user_id',$row_batch->batch_spk_user_id);?> - <?php echo $row_batch->batch_spk_date_created;?>
        <br>
        <span class="badge rounded-pill bg-success">Done : <?php echo CountSPKDone($batch_spk_id);?></span> 
        <span class="badge rounded-pill bg-danger">Blm : <?php echo CountBatch($batch_spk_id) - CountSPKDone($batch_spk_id);?></span>
        <span class="badge rounded-pill bg-primary">All : <?php echo CountBatch($batch_spk_id);?></span>
       
        <div class="table-responsive mt-1">
        <table style="font-size:12px;line-height:12px;"class="table table-sm">
          <thead>
            <tr>
              <th scope="col">No SPK</th>
              <th scope="col">No Invoice</th>
              <th scope="col">Product</th>
              <th scope="col">Type</th>
              <th scope="col">Time Done</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_spk_det as $row_spk_det) : ?>
                <td><small><?php echo $row_spk_det['batch_spk_det_spk_no']; ?></small>
                <td><small><?php echo $row_spk_det['spk_inv_mp']; ?></small>
                <?php if ($row_spk_det['batch_spk_det_done'] && $row_spk_det['batch_spk_det_done'] != '0000-00-00 00:00:00' ){
                  echo '<span class="badge rounded-pill bg-success">Done</span>';}?></td>
                <td><small><?php echo $row_spk_det['spk_prod_name']; ?></small></td>
                <td><small><?php echo $row_spk_det['spk_type']; ?></small></td>
                <td><small><?php echo $row_spk_det['batch_spk_det_done']; ?></small></td>
                
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>
</div>
  