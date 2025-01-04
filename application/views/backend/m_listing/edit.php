<script type="text/javascript">
	function f_tcalUpdate (n_date, b_keepOpen) 
	{
		var e_input = f_tcalGetInputs(true);
		if (!e_input) return;
		
		d_date = new Date(n_date);
		var s_pfx = A_TCALCONF.cssprefix;

		if (b_keepOpen) {
			var e_cal = document.getElementById(s_pfx);
			if (!e_cal || e_cal.style.visibility != 'visible') return;
			e_cal.innerHTML = f_tcalGetHTML(d_date, e_input);
		}
		else {
			e_input.value = f_tcalGenerateDate(d_date, A_TCALCONF.format);
			f_tcalCancel();
		}
	}
	function showKab(val)
	{
		$('#txtHintKab').load('<?php echo site_url().'backend/m_listing/ajaxShowKab/kab/'?>'+val+'/showKotKec');
		$('#txtHintKotkec').load('<?php echo site_url(). 'backend/m_listing/ajaxShowKotKec/kotkec'?>');
	}
	
	function showKotKec(val)
	{
		prov_id = $('#prov').val();
		$('#txtHintKotkec').load('<?php echo site_url(). 'backend/m_listing/ajaxShowKotKec/kotkec/'?>'+val+'/'+prov_id);
	}
	
	$(function () {
		$('#datetimepicker1').datetimepicker({
			format		: 'YYYY-MM-DD',
			showClose: true,
			showClear: true
		}).on("dp.change", function(e){
			var newDate = e.date.format('YYYY-MM-DD');
			var oldDate = e.oldDate.format('YYY-MM-DD');		
			if (newDate === oldDate){
				$(this).data("DateTimePicker").hide();
				//alert(newDate +'   '+oldDate);
			}else{
				$(this).data("DateTimePicker").hide();
			}
			});
	});

	function ClearFiles()
	{
		var list_id = document.getElementById("fileList");
		var div_clear = document.getElementById("div_clear");

		list_id.innerHTML = '';
		div_clear.innerHTML = '';
	}

	function makeFileList() 
	{
		var input = document.getElementById("multiFiles");
		var list_id = document.getElementById("fileList");
		var div_clear = document.getElementById("div_clear");

		list_id.innerHTML = '';
		div_clear.innerHTML = '';

		//while (ul.hasChildNodes()) {
		//	ul.removeChild(ul.firstChild);
		//}
		for (var i = 0; i < input.files.length; i++) {
			var div 	= document.createElement("div");
			var span 	= document.createElement("span");
			//var span_btn 	= document.createElement("span");
			//var button 		= document.createElement("button");
			var inp 	= document.createElement("input");
			var text 	= input.files[i].name;


			div.setAttribute("class","form-group input-group");
			div.setAttribute("id", "btn_file");
			span.setAttribute("class","input-group-addon");
			//span_btn.setAttribute("class","input-group-btn");
			//button.setAttribute("class","btn btn-danger");
			//button.setAttribute("type","button");
			//button.setAttribute('onclick','DelFile('+i+')');

			inp.setAttribute("type", "text");
			inp.setAttribute("class","form-control");
			inp.setAttribute("name", "files_name[]");
			inp.setAttribute("value", "NAMA_FILE_"+i);

			var t = document.createTextNode(text);
			var t_btn  = document.createTextNode("Delete");


  			span.appendChild(t);
			//button.appendChild(t_btn);
			//span_btn.appendChild(button);
			div.appendChild(span);
			div.appendChild(inp);
			//div.appendChild(span_btn);
			list_id.appendChild(div);
		}
		var div_clear = document.getElementById("div_clear");
		var clear_btn = document.createElement("button");
		clear_btn.setAttribute("class","btn btn-danger");
		clear_btn.setAttribute("type","button");
		clear_btn.setAttribute('onclick','ClearFiles()');
		var t_c_btn  = document.createTextNode("Clear Files");
		clear_btn.appendChild(t_c_btn);
		div_clear.appendChild(clear_btn);

	}

	function Back()
	{
		var url = '<?php echo site_url(). 'backend/m_listing/index/'.$this->uri->segment(5);?>';
		window.open(url,'_self');
	}

	function SubmitForm()
	{
		var form_data = new FormData();
			var ins = document.getElementById('multiFiles').files.length;
			if (ins < 20 )
			{	
				for (var x = 0; x < ins; x++) {
					form_data.append("files[]", document.getElementById('multiFiles').files[x]);
				}
				
				document.getElementById("form_listing").submit();
				/*
				$.ajax({
					url: '<?php //echo site_url(). 'backend/m_listing/upload_files/';?>', // point to server-side PHP script 
					dataType: 'text', // what to expect back from the PHP script
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function (response) {
						$('#msg').html(response); // display success response from the PHP script
					},
					error: function (response) {
						$('#msg').html(response); // display error response from the PHP script
					}
				});
				*/
				
			}else{
				alert('file terlalu banyak');
			}
	}

	function DeleteFile(id)
	{
		var url = '<?php echo site_url(). 'backend/m_listing/delete_file/'.$row->id_listing.'/'?>'+id;
		window.open(url,'_self');
	}

	function DownloadFile(id)
	{
		var url = '<?php echo site_url(). 'backend/m_listing/download_file/'.$row->id_listing.'/'?>'+id;
		window.open(url, '_blank');
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
			<form id="form_listing" action="<?php echo site_url(). 'backend/m_listing/edit/'.$row->id_listing.'/'.$this->uri->segment(5);?>" role="form" method="post" enctype="multipart/form-data">
					<div class="col-lg-6">
						<?php echo form_error('date_listing', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Listing *</span>
							<input type="text" id="datetimepicker1" name="date_listing" class="form-control" value="<?php echo  $row->date_listing;?>">
						</div>
						<?php echo form_error('name_jenis_listing', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Jenis Listing *</span>	
							<?php echo commonDropdown('tb_m_jenis_listing', false, 'name_jenis_listing', 'name_jenis_listing', $row->jenis_listing); ?>
						</div>
						<?php echo form_error('vendor_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nama Vendor *</span>
							<input type="text" name="vendor_name" class="form-control" value="<?php echo $row->vendor_name;?>">
						</div>
						<?php echo form_error('phone_1', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Telp / HP 1 *</span>
							<input type="text" name="phone_1" class="form-control" value="<?php echo $row->phone_1; ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Telp / HP 2</span>
							<input type="text" name="phone_2" class="form-control" value="<?php echo $row->phone_2; ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Telp / HP 3</span>
							<input type="text" name="phone_3" class="form-control" value="<?php echo $row->phone_3; ?>">
						</div>
						<?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Email</span>
							<input type="text" name="email" class="form-control" value="<?php echo $row->email; ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Alamat Lengkap *</span>
							<input type="text" name="address_full" class="form-control" value="<?php echo $row->address_full; ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Alamat Singkat *</span>
							<input type="text" name="addres_show" class="form-control" value="<?php echo $row->addres_show; ?>">
						</div>
						<?php echo form_error('prov', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Province *</span>
							<?php echo provDropdown($row->prov, 'prov','showKab')?>
						</div>
						<?php echo form_error('kab', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Kabupaten *</span>
							<div id="txtHintKab">
								<?php echo kabDropdown($row->prov,$row->kab, 'kab','showKotkec')?>
							</div>
						</div>
						<?php echo form_error('kotkec', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Kecamatan *</span>
							<div id="txtHintKotkec">
								<?php echo kotkecDropDown($row->prov,$row->kab,$row->kotkec, 'kotkec'); ?>
							</div>
						</div>
						<?php echo form_error('area', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Area *</span>	
							<input type="text" name="area" class="form-control" value="<?php echo $row->area; ?>">
						</div>

					</div>
					<div class="col-lg-6">
						<?php echo form_error('price_sell', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Harga Jual</span>
							<input type="text" name="price_sell" class="form-control" value="<?php echo $row->price_sell; ?>">
						</div>
						<?php echo form_error('price_rent', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Harga Sewa</span>
							<input type="text" name="price_rent" class="form-control" value="<?php echo $row->price_rent; ?>">
						</div>
						<?php echo form_error('name_type', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Type</span>
							<?php echo commonDropdown('tb_m_type', FALSE, 'name_type','name_type',$row->type);?>
						</div>
						<?php echo form_error('luas_tanah', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Luas Tanah</span>
							<input type="text" name="luas_tanah" class="form-control" value="<?php echo $row->luas_tanah; ?>">
						</div>
						<?php echo form_error('luas_bangunan', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Luas Bangunan</span>
							<input type="text" name="luas_bangunan" class="form-control" value="<?php echo $row->luas_bangunan; ?>">
						</div>
						<?php echo form_error('jml_kt', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Jumlah KT</span>
							<input type="text" name="jml_kt" class="form-control" value="<?php echo $row->jml_kt; ?>">
						</div>
						<?php echo form_error('jml_km', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Jumlah KM</span>
							<input type="text" name="jml_km" class="form-control" value="<?php echo $row->jml_km; ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Garasi</span>
							<input type="text" name="garasi" class="form-control" value="<?php echo $row->garasi; ?>">
						</div>
						<?php echo form_error('sertifikat', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Sertifikat</span>
							<?php echo commonDropdown('tb_m_sertifikat', false, 'sertifikat', 'sertifikat', $row->sertifikat); ?>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Ket Properti</span>
							<input type="text" name="ket_prop" class="form-control" value="<?php echo $row->ket_prop; ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">ME 1</span>
							<?php echo commonDropdown('tb_m_marketing', false, 'name_marketing', 'name_marketing_1', $row->me_1); ?>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">ME 2</span>
							<?php echo commonDropdown('tb_m_marketing', false, 'name_marketing', 'name_marketing_2', $row->me_2); ?>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">ME 1</span>
							<?php echo commonDropdown('tb_m_marketing', false, 'name_marketing', 'name_marketing_3', $row->me_3); ?>
						</div>
						<?php echo form_error('komisi', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Komisi</span>
							<input type="text" name="komisi" class="form-control" value="<?php echo $row->komisi; ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Ket. Listing</span>
							<input type="text" name="ket_listing" class="form-control" value="<?php echo $row->ket_listing; ?>">
						</div>
						<?php echo form_error('status_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Status</span>
							<?php echo commonDropdown('tb_status', false, 'status_name', 'status_name', $row->status); ?>
						</div>

						
					</div>

					<div class="col-lg-12">
					<div class="table-responsive table-bordered">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>File</th>
										<th>Type</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$i = 1;
								foreach($arr_files as $row_files) :?>
									<tr>
										<td><?php echo $row_files['user_rename'];?></td>
										<td><?php echo $row_files['type'];?></td>
										<td>
										<button type="button" id="del" class="btn btn-default btn-xs" onclick="DownloadFile(<?php echo $row_files['id_files'];?>)">Download</button>
										<button type="button" id="del" class="btn btn-danger btn-xs" onclick="DeleteFile(<?php echo $row_files['id_files'];?>)">Del</button>
										</td>
									</tr>
								<?php 
								$i++;
								endforeach;?>
								</tbody>
							</table>
						</div>
						<p id="msg"></p>
						<input type="hidden" id="upload_id" name="upload_id" value="<?php echo $upload_id;?>">
						<span class="btn btn-default btn-file">
							<input type="file" id="multiFiles" name="files[]" multiple="multiple" onChange="makeFileList(); "/>
						</span>
						<br />
						<br />
						<div id="fileList"></div>
						<div id="div_clear"></div>
						<p>
							* Harus diisi
						</p>
						<p>
							<button type="button" id="upload" class="btn btn-primary" onclick="SubmitForm()">Simpan</button>
							<button type="button" onclick="Back()" class="btn btn-warning">Kembali</button>
						</p>
					</div>
				</form>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->