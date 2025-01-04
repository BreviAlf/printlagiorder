<table class="table">
          <thead>
            <tr>
                <th scope="col">SKU Vaddr</th>
                <th scope="col">Name</th>
                <th scope="col">Bahan</th> 
                <th scope="col">Uk. Bahan</th>
                <th scope="col">Uk. Jadi</th>
                <th scope="col">Kel</th>
                <th scope="col">Multiply</th>
                <th scope="col">Cetak</th>
                <th scope="col">Laminasi</th>
                <th scope="col">Cutting</th>
                <th scope="col">Finishing</th>
                <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($arr_var as $row_var) : ?>
              <tr>
                <td><small><?php echo $row_var['prod_var_sku_var']; ?><br>
              <a href="javascript:void(0)" onclick="EditVar(<?php echo $row_var['prod_var_id'];?>)">[EDIT]</a> 
                            <a href="javascript:void(0)" onclick="CopyVar(<?php echo $row_var['prod_var_id'];?>)">[COPY]</a></small</td>
                <td><small><?php echo $row_var['prod_var_name']; ?></small></td>
                <td><small><?php echo $row_var['prod_var_material_name']; ?></small></td>
                <td><small><?php echo getDataTableById('tb_paper_size','paper_size_name','paper_size_id',$row_var['prod_var_paper_size_id']);?></td>
                <td><small><?php echo $row_var['prod_var_kel']; ?></small></td>
                <td><small><?php echo $row_var['prod_var_multiply']; ?></small></td>
                <td><small><?php echo $row_var['prod_var_finish_size']; ?></small></td>
                <td><small><?php echo $row_var['prod_var_print_side']; ?></small></td>
                <td><small><?php echo $row_var['prod_var_lamination']; ?></small></td>
                <td><small><?php echo $row_var['prod_var_cutting']; ?></small></td>
                <td>
                <?php
                              if($row_var['prod_var_finishing']):
                                $ex_fin = explode('|',$row_var['prod_var_finishing']);
                                $lastElement = end($ex_fin);
                                if($ex_fin)
                                {
                                    foreach($ex_fin as $fin)
                                    {
                                      echo getDataTableById('tb_finishing','fin_name','fin_id',$fin); 
                                      if($fin != $lastElement) {
                                        echo ' | ';
                                      }
                                  }
                                }
                              endif;
                              
                          ?>

                           
                        </td>
                <td>
                <button type="button" onclick="DelVar(<?php echo $row_var['prod_var_id'];?>)" class="btn btn-danger btn-sm">Delete</button>
                            <button type="button" onclick="EditVar(<?php echo $row_var['prod_var_id'];?>)" class="btn btn-primary btn-sm">Edit</button>
                            <button type="button" onclick="CopyVar(<?php echo $row_var['prod_var_id'];?>)" class="btn btn-primary btn-sm">Copy</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
</table>