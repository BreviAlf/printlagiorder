<script type="text/javascript">
  function ContinueUpload() 
  {
    var file_csv = '<?php echo $file_csv?>';
    $("#load_data").html('');
    $.ajax({
					url: '<?php echo site_url().'backend/product/AjaxContinueUpload'?>',
					cache: false,
					type: 'POST',
					data: {
						file_csv		:file_csv
					},
					success: function(result) {
            $(this).find('form').trigger('reset');
            $("#load_data").html(result);
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
      <th><small>Product Name</small></th>
      <th><small>Code</small></th>
      <th><small>SKU</small></th>
      <th><small>Price</small></th>
      <th><small>Price Disc</small></th>
      <th><small>Desc</small></th>
      <th><small>Mockup</small></th>
      <th><small>Banner</small></th>
      <th><small>Design</small></th>
      <th><small>Cat ID</small></th>
      <th><small>Niche ID</small></th>
      <th><small>MP Link 1</small></th>
      <th><small>MP Link 2</small></th>
      <th><small>Dummy Sold (PCS)</small></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($arr_product as $row_product) : ?>
      <tr>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_name']; ?></small></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_code']; ?></small></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_sku']; ?></small></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_price']; ?></small></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_price_disc']; ?></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_desc']; ?></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_img_mockup_url']; ?></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_img_banner_url']; ?></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_img_design_url']; ?></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_cat_id']; ?></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_niche_id']; ?></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_mp_link_1']; ?></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_mp_link_2']; ?></small></td>
        <td><small style="font-size: 10px;"><?php echo $row_product['prod_dummy_sold']; ?></small></td>

      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<div class="d-flex mt-2 flex-row-reverse">
                <div class="p-2">
                  <a href="#" onclick="ContinueUpload()" class="btn btn-primary float-right">Continue Upload</a>
               </div>
              </div>