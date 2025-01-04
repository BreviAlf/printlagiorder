<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 1000);
    });    



</script>

<?php foreach ($arr_track as $row_track) : ?>
  <div class="modal fade" id="<?php echo 'modalview'.$row_track['spk_id']?>" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"> <?php echo $row_track['spk_inv_mp'];?> - <?php echo $row_track['spk_no'];?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <table class="table">
                      <tbody>
                        <tr>
                          <td scope="row">Nama Produk</td>
                          <th><?php echo $row_track['spk_prod_name']?></th>
                        </tr>
                        <tr>
                          <td scope="row">Tanggal SPK</td>
                          <th><?php echo $row_track['spk_datetime_in']?></th>
                        </tr>
                        <tr>
                          <td scope="row">SPK Batch</td>
                          <th><?php echo GetDataBatch($row_track['spk_no'])->batch_spk_date_created;?> - <?php echo GetDataBatch($row_track['spk_no'])->batch_spk_no;?><br>
                          <?php echo GetDataBatch($row_track['spk_no'])->batch_spk_name;?> 
                         
                          </th>
                        </tr>
                        <tr>
                          <td scope="row">Packing List</td>
                          <th><?php echo GetDataPacking($row_track['spk_inv_mp'])->pack_date_created;?> - <?php echo GetDataPacking($row_track['spk_inv_mp'])->pack_no;?><br>
                         <strong><?php echo GetDataPacking($row_track['spk_inv_mp'])->pack_kurir_name;?></strong>
                          
                          </th>
                        </tr>
                        
                      
                      </tbody>
                    </table>
                    <h5>TRACKING SPK</h5>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Status</th>
                          <th scope="col">Date</th>
                          <th scope="col">User</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>Created</th>
                          <td><?php echo $row_track['spk_datetime_in']?></td>
                          <td><?php echo getDataTableById('tb_user','user_name','user_id',$row_track['spk_user']);?></td>
                        </tr>
                        <tr>
                          <th>Layout</th>
                          <td><?php echo $row_track['spk_time_layout']?></td>
                          <td> - </td>
                        </tr>
                        <tr>
                          <th scope="row">Process</th>
                          <td><?php echo $row_track['batch_spk_det_date_created']?></td>
                          <td><?php echo getDataTableById('tb_user','user_name','user_id',$row_track['batch_spk_user_id']);?></td>
                        </tr>
                        <tr>
                          <th scope="row">Done</th>
                          <td><?php echo $row_track['spk_time_done']?></td>
                          <td><?php echo getDataTableById('tb_user','user_name','user_id',$row_track['batch_spk_det_done_user_id']);?></td>
                        </tr>
                        <tr>
                          <th scope="row">Packing</th>
                          <td><?php echo $row_track['pack_det_created_date']?></td>
                          <td><?php echo getDataTableById('tb_user','user_name','user_id',$row_track['pack_user_id']);?></td>
                        </tr>
                        <tr>
                          <th scope="row">To Kurir</th>
                          <td><?php echo $row_track['spk_time_delivered']?></td>
                          <td><?php echo GetDataPacking($row_track['spk_inv_mp'])->pack_kurir_name;?></td>
                        </tr>
                      
                      </tbody>
                    </table>
</div>
                    </div>
                    <div class="modal-footer">
                    <input type="hidden" id="spk_id" value='<?php echo $row_track['spk_id'];?>'>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" onclick="DoCetak(<?php echo $row_track['spk_id'];?>)" class="btn btn-primary">Cetak SPK</button>
                    </div>
                  </div>
                </div>
              </div>


<?php endforeach; ?>
<h4><?php echo $data['input'] = $input;?></h4>
<?php echo $notif;?>
<div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th style="width: 10%;" scope="col">No SPK</th>
              <th style="width: 20%;" scope="col">Invoice MP / Resi</th>
              <th style="width: 30%;" scope="col">Produk</th>
              <th style="width: 30%;" scope="col">Last Status</th>
              <th style="width: 10%;" scope="col">Detail</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_track as $row_track) : ?>
                <td><small><?php echo $row_track['spk_no']; ?></small></td>
                <td><small><?php echo $row_track['spk_inv_mp']; ?><br><div style="font-size: 14px;font-style: italic;"><?php if($row_track['spk_no_resi']){ echo $row_track['spk_no_resi'];}; ?></small></td>
                <td><small><?php echo $row_track['spk_prod_name']; ?></small></td>
                <td>

                <?php 
                  if($row_track['spk_status'] == 'Layout'){
                    echo  '<span class="badge bg-success">'.$row_track['spk_status'].'</span><br> <small>ON : '.$row_track['spk_time_layout'].'</small>';
                  } elseif($row_track['spk_status'] == 'Process'){
                    echo  '<span class="badge bg-success">'.$row_track['spk_status'].'</span><br> <small>ON : '.$row_track['spk_time_process'].'</small><br>';
                    echo '<strong>'.GetDataBatch($row_track['spk_no'])->batch_spk_name.' - '.GetDataBatch($row_track['spk_no'])->batch_spk_no.'</strong><br>';
                    echo '<small>ON : '.GetDataBatch($row_track['spk_no'])->batch_spk_date_created.'</small>';
                   
                  } elseif($row_track['spk_status'] == 'Done'){
                    echo  '<span class="badge bg-success">'.$row_track['spk_status'].'</span><br> <small>ON : '.$row_track['spk_time_done'].'</small>';
                  } elseif($row_track['spk_status'] == 'Packing'){
                    echo  '<span class="badge bg-success">'.$row_track['spk_status'].'</span><br> <small>ON : '.$row_track['spk_time_packing'].'</small>';
                  }elseif($row_track['spk_status'] == 'Delivered'){
                    echo  '<span class="badge bg-success">'.$row_track['spk_status'].'</span><br> <small>ON : '.$row_track['spk_time_delivered'].'</small><br>';
                    echo '<strong>'.GetDataPacking($row_track['spk_inv_mp'])->pack_kurir_name.' - '.GetDataPacking($row_track['spk_inv_mp'])->pack_no.'</strong><br>';
                    echo '<small>'.GetDataPacking($row_track['spk_inv_mp'])->pack_date_created.'</small>';
                  }
                  
                ?>
              </td>
                <td>
                  <button type="button" data-bs-toggle="modal" data-bs-target="#modalview<?php echo $row_track['spk_id'];?>" class="btn btn btn-primary btn-sm">View</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
</div>
  