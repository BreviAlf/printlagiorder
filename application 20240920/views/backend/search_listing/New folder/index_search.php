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
	url = "<?php echo site_url().'backend/m_jemaat'?>";
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
				<?php if($this->uri->segment(3) == 'cari'):?>
				<div class="row">
					<div class="col-lg-4">
						<form id="cari_submit" action="<?php echo site_url()?>backend/m_listing/cari" role="form" method="post" enctype="multipart/form-data">
						<div class="form-group input-group">
							<input type="text" class="form-control" name="vendor_name" id="vendor_name" value="<?php echo $key;?>"placeholder="Nama...">
							<span class="input-group-btn">
								<button class="btn btn-default" onClick="SubmitCari()" type="button"><i class="fa fa-search"></i> </button>
							</span>
						</div>
						</form>
					</div>
					<div class="col-lg-2">
						<div class="form-group input-group">
							<button type="button" onClick="add()" class="btn btn-primary">Tambah Listing</button>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group input-group">
							<button type="button" onClick="back()" class="btn btn-primary">Kembali</button>
						</div>
					</div>
				</div>
				<?php else:?>
				<div class="row">
					<div class="col-lg-4">
						<form id="cari_submit" action="<?php echo site_url()?>backend/m_listing/cari" role="form" method="post" enctype="multipart/form-data">
						<div class="form-group input-group">
							<input type="text" class="form-control" name="vendor_name" id="vendor_name" placeholder="Nama...">
							<span class="input-group-btn">
								<button class="btn btn-default" onClick="SubmitCari()" type="button"><i class="fa fa-search"></i> </button>
							</span>
						</div>
						</form>
					</div>
					<div class="col-lg-8">
						<div class="form-group input-group">
							<button type="button" onClick="add()" class="btn btn-primary">Tambah Listing</button>
						</div>
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
										<th>Nama Vendor</th>
										<th>Telp / HP </th>
										<th>Type</th>
										<th>Alamat Tampil</th>
										<th>Area</th>
										<th>Created</th>
										<th>Modified</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no = 1 + $urut;
									foreach($res as $row):
								?>
									<tr>
										<td><?php echo $no;?></td>
										<td>
										<b><?php echo anchor('backend/m_listing/edit/'.$row["id_listing"].'/'.$row["type"],$row["vendor_name"]);?></b>
										<div class="action">
											<?php echo anchor('backend/m_listing/edit/'.$row["id_listing"],'Edit',array('type'=>'button','class'=>'btn btn-primary btn-xs'))?>
											<?php echo anchor('backend/m_listing/delete/'.$row["id_listing"].'/'.$no,'Hapus',array('type'=>'button','class'=>'btn btn-danger btn-xs','onclick' => "return confirm('Anda yakin menghapus data ini?')"))?>
										</div>
										</td>
										<td><?php echo $row['phone_1']?></td>
										<td><?php echo $row['type'] ?></td>
										<td><?php echo $row['addres_show'] ?></td>
										<td><?php echo $row['area']?></td>
										<td><?php echo $row['date_created']; ?></td>
										<td><?php echo $row['date_modified']; ?></td>
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
