<style>
  table.dataTable {
    font-size: small;
  }
</style>
<script type="text/javascript">
    $('#product_list').DataTable({
      "scrollY":        "400px",
        "scrollCollapse": true,
        "paging":         false,
        "scrollX": true,
        "sScrollXInner": "100%",
        initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;
    
                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );

               
              }
    });

    $(document).ready(function() {
        var table = $('#avail_product').DataTable({
          "scrollY":        "400px",
          "scrollCollapse": true,
          "paging":         false,
          "scrollX": true,
          "sScrollXInner": "100%",

            initComplete: function () {
                // Apply the search
                /*
                this.api().columns().every( function () {
                    var that = this;
    
                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
*/
               
              }
              
          });
        myFunction();
      } );
    function myFunction() {
      timeout = setTimeout(alertFunc, 200);
    }

    function alertFunc() {
      $("#clickme").trigger('click');
      $("#clickme2").trigger('click');
    }

  function AddProduct() {
    var landing_id = $('#landing_id').val();
    var prodid = new Array();
    $('input[name="prodid[]"]:checked').each(function() {
      prodid.push($(this).val());
    });

    if (prodid.length > 0) {
      $.ajax({
        url: "<?php echo site_url() . 'backend/landing/AjaxAddProduct'; ?>",
        type: "POST",
        data: {
          landing_id: landing_id,
          arr_prodid: prodid
        },
        success: function(result) {
          //alert("PROCESS SUSCESS");
          
          OpenProductListModal(landing_id);
          $("#ModalResponseAddProduct").modal('show');
          $("#response").html(result);
        }
      });
    } else {
      alert("empty checkbox");
    }
  }

  function DeleteProdList() {
    var landing_id = $('#landing_id').val();
    var prodlistid = new Array();
    $('input[name="prodlistid[]"]:checked').each(function() {
      prodlistid.push($(this).val());
    });
    if (prodlistid.length > 0) {
      $.ajax({
        url: "<?php echo site_url() . 'backend/landing/AjaxDeleteProdList'; ?>",
        type: "POST",
        data: {
          arr_prod_list: prodlistid
        },
        success: function(data) {
          //alert("PROCESS SUSCESS");
          OpenProductListModal(landing_id);
        }
      });
    } else {
      alert("empty checkbox");
    }
  }

  function OpenProductListModal(i) {
    var landing_id = i;
    $.ajax({
      url: '<?php echo site_url() . 'backend/landing/AjaxProductListModal' ?>',
      cache: false,
      type: 'POST',
      data: {
        landing_id: landing_id
      },
      success: function(result) {
        //var json_string = eval(json);
        //alert(result);
        //$('#sess_uid').text(json_string.sess_uid);
        //var ss = '<p>tes</p>';
        $("#load_data_product_modal").html(result);

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function ChangeNicheAvail(i) {
    var niche_id = i;
    $.ajax({
      url: '<?php echo site_url() . 'backend/landing/AjaxChangeNiche' ?>',
      cache: false,
      type: 'POST',
      data: {
        niche_id: niche_id
      },
      success: function(result) {
        alert(result);
        $("#niche_avail").val(result);
        $("#niche_avail2").val(result);

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  function SetPopup(i) {
    var prod_id = i;
    var landing_id = $('#landing_id').val();
    $.ajax({
      url: '<?php echo site_url() . 'backend/landing/AjaxSetPopUp' ?>',
      cache: false,
      type: 'POST',
      data: {
        prod_id: prod_id,
        landing_id: landing_id
      },
      success: function(result) {
        //var json_string = eval(json);
        //alert(result);
        //$('#sess_uid').text(json_string.sess_uid);
        //var ss = '<p>tes</p>';
        alert('popup updated');
        //$("#load_data_product_modal").html(result);

      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }

  $("#prodlistid").click(function () {
    $('.prodlistid').prop('checked', this.checked);    
  });

  $("#prodid").click(function () {
    $('.prodid').prop('checked', this.checked);    
  });
</script>

<div id="load_data_product_modal">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Product List On <?php echo $title; ?></h5>
          <table id="product_list" class="table table-hover" style="width:100%;">
            <thead>
              <tr>
                <th><input class="form-check-input" type="checkbox" value="" name="" id="prodlistid"></th>
                <th><a href="#" id="clickme">Image</a></th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Niche</th>
                <th>Popup</th>
              </tr>
            </thead>
            <tbody style="height:500px;">
              <?php foreach ($arr_prod_list as $row_prod_list) : ?>
                <tr>
                <?php if ($row_prod_list['prod_list_poup_stat'] == 'Y') : $radio_check = 'checked'; else : $radio_check = ''; endif;?>
                  <td><input class="form-check-input prodlistid" type="checkbox" value="<?php echo $row_prod_list['prod_list_id']; ?>" name="prodlistid[]" id="prodlistid"></td>
                  <td><img style="width:100px;" class="img-thumbnail" src="<?php echo site_url().''.$row_prod_list['prod_img_design_url'];?>"></td>
                  <td><?php echo $row_prod_list['prod_name']; ?><br>ID : <?php echo $row_prod_list['prod_id']; ?></td>
                  <td><span class="badge rounded-pill bg-primary"><?php echo $row_prod_list['cat_name']; ?></span></td>
                  <td><span class="badge rounded-pill bg-secondary"><?php echo $row_prod_list['niche_name']; ?></span></td>
                  <td><input class="form-check-input" type="radio" onchange="SetPopup(<?php echo $row_prod_list['prod_list_prod_id'] ?>)" name="prod_list_poup_stat" value="<?php echo $row_prod_list['prod_list_prod_id'] ?>" id="prod_list_poup_stat" <?php echo $radio_check; ?>></td>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                  <th></th>
                  <th></th>
                  <th><input type="text" size="15" placeholder="Product Name"/></th>
                  <th><input type="text" size="12" placeholder="Category"/></th>
                  <th><input type="text" size="12" placeholder="Niche"/></th>
                  <th></th>
              </tr>
            </tfoot>
          </table>
          <div class="d-flex mt-2 flex-row-reverse">
            <div class="p-2">
              <a href="#" onclick="DeleteProdList()" class="btn btn-danger float-right btn-sm">Delete</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Available Product</h5>
          <table id="avail_product" class="table datatable table-hover" width="100%">
            <thead>
              <tr>
                <th style="width:10%"><input class="form-check-input" type="checkbox" value="" name="" id="prodid"></th>
                <th style="width:10%"><a href="#" id="clickme2">Image</a></th>
                <th style="width:30%">Product Name</th>
                <th style="width:25%">Category</th>
                <th style="width:25%">Niche</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($arr_prod_avail as $row_prod_avail) : ?>
                <tr>
                  <td><input class="form-check-input prodid" type="checkbox" value="<?php echo $row_prod_avail['prod_id']; ?>" name="prodid[]" id="prodid"></td>
                  <td><img style="width:100px;" class="img-thumbnail" src="<?php echo site_url().''.$row_prod_avail['prod_img_design_url'];?>"></td>
                  <td><?php echo $row_prod_avail['prod_name']; ?> <br> ID : <?php echo $row_prod_avail['prod_id'];?></td>
                  <td><span class="badge rounded-pill bg-primary"><?php echo $row_prod_avail['cat_name']; ?></span></td>
                  <td><span class="badge rounded-pill bg-secondary"><?php echo $row_prod_avail['niche_name']; ?></span></td>

                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                  <th></th>
                  <th></th>
                  <th><input type="text" size="15" placeholder="Product Name"/></th>
                  <th><input type="text" size="12" placeholder="Category"/></th>
                  <th><input type="text" size="12" placeholder="Niche"/>
                </th>
              </tr>
            </tfoot>
          </table>
          <input type="hidden" id="landing_id" value='<?php echo $landing_id; ?>'>
          <input type="hidden" id="prod_list_id" value='<?php echo $prod_list_id; ?>'>
          <div class="d-flex mt-2 flex-row-reverse">
            <div class="p-2">
              <a href="javascript:void(0)" onclick="AddProduct()" class="btn btn-primary float-right btn-sm">Add Product</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="background: rgba(72,72,72, 0.75)" class="modal fade" id="ModalResponseAddProduct" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Basic Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <div id="response"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>