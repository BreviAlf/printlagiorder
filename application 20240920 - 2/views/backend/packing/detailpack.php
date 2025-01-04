<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
    });    
</script>
<?php echo $notif;?>
                <h4>TOTAL SCAN INVOICE : <strong><?php echo $total_pack;?></strong></h4>
                <div class="table-responsive">
                    <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">PACK ID</th>
                      <th scope="col">Invoice MP</th>
                      <th scope="col">Scaned</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($arr_pack_det as $row_pack_det) : ?>
                        <td><small><?php echo $row_pack_det['pack_det_id']; ?></small></td>
                        <td><small><?php echo $row_pack_det['pack_det_inv_mp']; ?></small></td>
                        <td><small><?php echo $row_pack_det['pack_det_created_date']; ?></small></td>
                        <td>
                          <button type="button" onclick="DelPackInv(<?php echo $row_pack_det['pack_det_id']; ?>)" class="btn btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                    </div>
  