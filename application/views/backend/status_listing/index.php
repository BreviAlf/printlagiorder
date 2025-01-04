<script type="text/javascript">
function show_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'visible'});
}
function hide_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'visible'});
}
function bulk()
{
	var ids = $("input[name='bank_id[]']").serialize();
	if(confirm("Anda ingin menghapus?"))
	{
		if (ids)
		{
			$.ajax({
				type: "GET",
				url: "<?php echo site_url().'backend/bank/ajax_bulk_action/' ?>",
				cache: false,
				success: window.location.reload(),
			});
		}
	}
}
function add()
{
	url = "<?php echo site_url().'backend/m_listing/add'?>";
	window.open(url, '_self');
}

function back()
{
	url = "<?php echo site_url().'backend/status_listing/'.$status;?>";
	window.open(url, '_self');
}

function SubmitCari()
{
	var cari_nama = $('#cari_nama').val();
	if(cari_nama != "")
	{
		$("#cari_submit" ).submit();
	}
	else
	{
		alert ('Isi nama');
	}	
	
}

	// CALL MODAL DETAIL LISTING
	function DetailListing(id_listing)
	{
		var id_listing 	= id_listing;
		var url = '<?php echo site_url().'backend/search_listing/load_detail_listing/'?>'+ id_listing ;

		$('#ModalDetailListing').modal('show').find('.modal-body').load(url);
	}


	// CALL MODAL DETAIL LISTING
	function DetailListingUmum(id_listing)
	{
		var id_listing 	= id_listing;
		var url = '<?php echo site_url().'backend/search_listing/load_detail_listing_umum/'?>'+ id_listing ;

		$('#ModalDetailListingUmum').modal('show').find('.modal-body').load(url);
	}

	function EditListing(id_listing)
	{
		url = "<?php echo site_url().'backend/m_listing/edit/';?>"+id_listing;
		window.open(url, '_blank');
	}
</script>
<script type="text/javascript">
      $(document).ready(function() {
        setTimeout(function(){
          $("#kotak").fadeOut("slow", function () {
            $("#kotak").remove();
          });    
        }, 3000);
      });
</script>
<div class="row">
	<div class="col-lg-12">
	<?php echo $this->session->flashdata('message_type');?>
	<?php echo $this->session->flashdata('message_type_popup');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $title;?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<?php if($this->uri->segment(4) == 'cari'):?>
				<div class="row">
					<div class="col-lg-4">
						<form id="cari_submit" action="<?php echo site_url()?>backend/status_listing/<?php echo $status;?>/cari" role="form" method="post" enctype="multipart/form-data">
						<div class="form-group input-group">
							<input type="text" class="form-control" name="keywords" id="keywords" value="<?php echo $key;?>"placeholder="Keywords...">
							<span class="input-group-btn">
								<button class="btn btn-default" onClick="SubmitCari()" type="button"><i class="fa fa-search"></i> </button>
							</span>
						</div>
						</form>
					</div>
					<div class="col-lg-4">
							<button type="button" onClick="back()" class="btn btn-primary">Kembali</button>
					</div>
				</div>
				<?php else:?>
				<div class="row">
					<div class="col-lg-4">
					<form id="cari_submit" action="<?php echo site_url()?>backend/status_listing/<?php echo $status;?>/cari" role="form" method="post" enctype="multipart/form-data">
						<div class="form-group input-group">
						<input type="text" class="form-control" name="keywords" id="keywords" value="" placeholder="Keywords...">
							<span class="input-group-btn">
								<button class="btn btn-default" onClick="SubmitCari()" type="button"><i class="fa fa-search"></i> </button>
							</span>
						</div>
						</form>
					</div>
				</div>
				<?php endif;?>
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive table-bordered">
							<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Type</th>
									<th>Area</th>
									<th>Alamat</th>
									<th>LT</th>
									<th>LB</th>
									<th>KT</th>
									<th>KM</th>
									<th>Sertfikat</th>
									<th class="col-md-2">Marketing</th>
									<th class="col-md-2">Harga</th>
									<th>Keterangan</th>
									<th class="col-md-1">Expired Date</th>
									<th class="col-md-1">Action</th>
								</tr>
							</thead>
								<tbody>
							<?php
							$no = 1+$urut;
							foreach($res as $row):
							?>
								<tr>
									<td><?php echo $no;?></td>
									<td><?php echo $row['type'] ?></td>
									<td><?php echo $row['area']?></td>
									<td><?php echo $row['addres_show'] ?></td>
									<td><?php echo $row['luas_tanah'] ?></td>
									<td><?php echo $row['luas_bangunan'] ?></td>
									<td><?php echo $row['jml_kt'] ?></td>
									<td><?php echo $row['jml_km'] ?></td>
									<td><?php echo $row['sertifikat'] ?></td>
									<td>
									
										<?php if ($row['me_1']!=''):echo 'ME 1 : '.$row['me_1'];endif;?><br>
										<?php if ($row['me_2']!=''):echo 'ME 2 : '.$row['me_2'];endif;?><br>
										<?php if ($row['me_3']!=''):echo 'ME 3 : '.$row['me_3'];endif;?>
									
									</td>
									<td>
									
									<?php if ($row['price_sell']!=0):echo 'Jual : '.FormatRupiah($row['price_sell']);endif;?><br>
									<?php if ($row['price_rent']!=0):echo 'Sewa : '.FormatRupiah($row['price_rent']);endif;?><br>
									
									</td>
									<td><?php echo $row['ket_prop'] ?></td>
									<td><?php echo GetExpired($row['date_listing'],getOption('expired'))?></td>
									<td>
									<div class="dropdown">
										<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
										<span class="caret"></span></button>
										<ul class="dropdown-menu pull-right">
										<li><a href="#" onClick="DetailListingUmum(<?php echo $row["id_listing"];?>)">Lihat Umum</a></li>
										<li><a href="#" onClick="DetailListing(<?php echo $row["id_listing"];?>)">Lihat Detail</a></li>
										<li class="divider"></li>
										<li><a href="#" onClick="EditListing(<?php echo $row["id_listing"];?>)">Edit</a></li>
										</ul>
									</div>
									</td>
								</tr>
										
							<?php 
									$no++;
									endforeach;
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<?php if($this->pagination->create_links()==TRUE):?>
						<div class="col-sm-6">	
							<div id="dataTables-example_paginate" class="dataTables_paginate paging_simple_numbers">
							<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->


<!-- Modal -->
<div class="modal fade" id="ModalDetailListing" tabindex="-1" role="dialog" aria-labelledby="ModalDetailListingTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalDetailListingTitle">Data Listing</h5>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /.row -->

<!-- Modal -->
<div class="modal fade" id="ModalDetailListingUmum" tabindex="-1" role="dialog" aria-labelledby="ModalDetailListingmumTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalDetailListingUmumTitle">Data Listing</h5>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /.row -->
