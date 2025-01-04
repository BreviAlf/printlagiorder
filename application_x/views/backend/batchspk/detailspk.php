<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 1000);
    });    
</script>

<?php echo $notif;?>
<h4>TOTAL SCAN SPK : <?php echo $total_spk;?></h4>
<div class="table-responsive">
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">Batch SPK ID</th>
              <th scope="col">No SPK</th>
              <th scope="col">Invoice MP</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_spk_det as $row_spk_det) : ?>
                <td><small><?php echo $row_spk_det['batch_spk_det_spk_id']; ?></small></td>
                <td><small><?php echo $row_spk_det['batch_spk_det_spk_no']; ?></small></td>
                <td><small><?php echo $row_spk_det['batch_spk_det_spk_inv_mp']; ?></small></td>
                <td>
                  <button type="button" onclick="DelSpk(<?php echo $row_spk_det['batch_spk_det_batch_spk_id']; ?>)" class="btn btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
            </div>
  