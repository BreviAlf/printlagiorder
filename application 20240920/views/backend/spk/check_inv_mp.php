
                <h4>DATA SPK INVOICE SAMA <strong><?php echo count($arr_spk);?></strong></h4>
                    <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">NO SPK</th>
                      <th scope="col">Invoice MP</th>
                      <th scope="col">Product</th>
                      <th scope="col">Date Add</th>
                      <th scope="col">Status</th>
                      <th scope="col">User</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($arr_spk as $row_spk) : ?>
                      <tr>
                        <td><small><?php echo $row_spk['spk_no']; ?></small></td>
                        <td><small><?php echo $row_spk['spk_inv_mp']; ?></small></td>
                        <td><small><?php echo $row_spk['spk_prod_name']; ?></small></td>
                        <td><small><?php echo $row_spk['spk_status']; ?></small></td> 
                        <td><small><?php echo $row_spk['spk_datetime_in']; ?></small></td> 
                        <td><small><?php echo getDataTableById('tb_user','user_name','user_id',$row_spk['spk_user']);?></small></td> 
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
  