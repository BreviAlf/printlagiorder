<form action="<?php echo site_url() ?>backend/product/AjaxUpdateSizeStock" id="update_size_stock" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">color id</th>
                              <th scope="col">color name</th>
                              <th scope="col">size name</th>
                              <th scope="col">Stock</th>
                              <th scope="col">Add Price</th>
                              <th scope="col">SKU Varian</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach (GetAllSize($prod_id) as $size):?>
                              <tr>
                                <td><?php echo $size['color_id'];?></td>
                                <td><?php echo $size['color_name'];?></td>
                                <td><?php echo $size['size_name'];?></td> 
                                <td><input type="text" value="<?php echo $size['size_stock'];?>" class="form-control" name="size_stock_<?php echo $size['uid'];?>" id="size_stock_<?php echo $size['uid'];?>" aria-describedby="basic-addon3"></td> 
                                <td><input type="text" value="<?php echo $size['size_add_price'];?>" class="form-control" name="size_add_price_<?php echo $size['uid'];?>" id="size_add_price_<?php echo $size['uid'];?>" aria-describedby="basic-addon3"></td> 
                                <td><input type="text" value="<?php echo $size['size_sku'];?>" class="form-control" name="size_sku_<?php echo $size['uid'];?>" id="size_sku_<?php echo $size['uid'];?>" aria-describedby="basic-addon3"></td> 
                              </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                        <div class="d-flex mt-2 flex-row-reverse">
                        <input type="hidden" name="prod_id" value="<?php echo $prod_id;?>">
                        <a href="javascript:void(0)" onclick="UpdateSizeStock()" class="btn btn-primary float-right">Save</a>
                        </div>
                    </form>


