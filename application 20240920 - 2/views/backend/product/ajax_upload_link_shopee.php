<script type="text/javascript">
  function ContinueUpload() 
  {
    var file_csv = '<?php echo $file_csv;?>';
    $("#load_data_link_shopee").html('');
    $.ajax({
					url: '<?php echo site_url().'backend/product/AjaxContinueLinkShopee'?>',
					cache: false,
					type: 'POST',
					data: {
						file_csv		:file_csv
					},
					success: function(result) {
            $(this).find('form').trigger('reset');
            $("#load_data_link_shopee").html(result);
            setTimeout(function(){
              window.location.reload(1);
            }, 3000);
            
          },
					failure: function(errMsg) {
						alert(errMsg);
					}
				});
  }



    var timeleft = 3;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);

</script>



<table class="table">
  <thead>
    <tr>
      <th><small>Shopee Link</small></th>
      <th><small>SKU</small></th>
      <th><small>Product ID</small></th>
      <th><small>Product Name</small></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($arr_product as $row_product) : ?>
      <?php if($row_product['prod_id'] == 'NOT FOUND'):?>
        <tr style="background-color:pink">
      <?php else:?>
        <tr>
      <?php endif;?>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_link']; ?></small></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_sku']; ?></small></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_id']; ?></small></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_name']; ?></small></small></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<div class="d-flex mt-2 flex-row-reverse">
                <div class="p-2">
                  
                  <a href="#" onclick="ContinueUpload()" class="btn btn-primary float-right">Continue Upload</a>
               </div>
              </div>