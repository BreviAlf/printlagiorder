<script type="text/javascript">
function add()
{
	url = "<?php echo site_url().'backend/m_marketing/add'?>";
	window.open(url, '_self');
}
</script>
<div class="row">
	<div class="col-lg-12">
	<?php echo $this->session->flashdata('message_type');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $title;?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<div class="form-group input-group">
							<button type="button" onClick="add()" class="btn btn-primary">Tambah</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive table-bordered">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Marketing</th>
										<th>Phone</th>
										<th>Email</th>
										<th>Alamat</th>
										<th>KTP</th>
									</tr>
								</thead>
								<?php
									$no = 1;
									foreach($res as $row):
								?>
								<tr class="<?php if ($no %2 == 0) echo 'even';?>">
									<td><?php echo $no;?></td>
									<td>
									<b><?php echo anchor('backend/m_marketing/edit/'.$row["id_marketing"],$row["name_marketing"]);?></b>
									<div>
										<?php echo anchor('backend/m_marketing/edit/'.$row["id_marketing"],'Edit',array('class' => 'btn btn-primary btn-xs'))?>
										<?php echo anchor('backend/m_marketing/delete/'.$row["id_marketing"],'Hapus',array('onclick' => "return confirm('Anda yakin menghapus data m_marketing ini?')",'class' => 'btn btn-danger btn-xs'))?>
									</div>
									</td>
									<td><?php echo $row['phone_1']?></td>
									<td><?php echo $row['email']?></td>
									<td><?php echo $row['address']?></td>
									<td width="40%">
									<a href="<?php echo base_url().$row['img_url'];?>" target="_blank">
									<img src="<?php echo base_url().$row['img_url'];?>" class="img-rounded" alt="" width="50%"> </td>
								</tr>
								<?php
									$no++;
									endforeach;
								?>
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
