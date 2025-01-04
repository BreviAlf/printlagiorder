<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(0, 0).slideUp(0, function(){
                $(this).remove();
             
                document.getElementById("inputscan").focus();
            });
        }, 500);
    });    


    function GoToBatch(id) {
    window.open("<?php echo site_url() . 'backend/history/detail/'; ?>" + id, "_self");
  }
</script>
<strong><?php echo $input;?></strong>
<?php echo $notif;?>
<input type="hidden" id="spk_no" value="<?php echo $input;?>">
<?php if ($row_spk):?>

    <table style="font-size:12px;" class="table table-sm">
        <tbody>
          <tr style="line-height: 14px;">
            <td scope="row"><small>Prod</small></td>
            <td><small><?php echo $row_spk->spk_prod_name;?></small></td>
          </tr>
          <tr style="line-height: 14px;">
            <td scope="row"><small>PCS</small></td>
            <td><span class="badge rounded-pill bg-primary"><?php echo $row_spk->spk_qty_finish;?></span></td>
          </tr>
          <tr style="line-height: 14px;">
            <td scope="row"><small>Bahan</small></td>
            <td><small><?php echo $row_spk->spk_material_name;?></small></td>
          </tr> 
          <tr style="line-height: 14px;">
            <td scope="row"><small>Qty A3</small></td>
            <td><span class="badge rounded-pill bg-primary"><?php echo $row_spk->spk_qty_material;?></span></td>
          </tr>  
          <tr>
            <td scope="row"></td>
            <td>
            <input style="width:50px;float:left;" size="2" id="qty_new" inputmode="none" value="<?php echo $row_spk->batch_spk_det_material_qty;?>" class="form-control" aria-describedby="basic-addon2">
            <button style="float:right;" id="btn_update" type="button" onclick="UpdateQty()" class="btn btn-sm btn-primary">Update</button>
            </td>
          </tr>
          <tr style="line-height: 14px;">
            <td scope="row"><small>Detail</small></td>
            <td><small><?php echo $row_spk->spk_print_side;?><br>
                <?php echo $row_spk->spk_lamination;?><br>
                <?php echo $row_spk->spk_cutting;?><br>
                <?php echo $row_spk->spk_instruction;?></small>
          </td>
          <tr style="line-height: 14px;">
          
        </tbody>
    </table>
    
    <button style="float:left;" type="button" onclick="DeleteScan('<?php echo $input;?>')" class="btn btn-sm btn-danger">Hapus Item</button>
    <button style="float:right;" type="button" onclick="GoToBatch(<?php echo $row_spk->batch_spk_det_spk_id;?>)" class="btn btn-sm btn-primary">List SPK Batch</button>
<?php endif;?>
  