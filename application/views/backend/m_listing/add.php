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

	function CheckAddress()
	{
		
		var address_full	= $('#address_full').val();
		
		if(address_full != '')
		{
			$('#ModalCheck').modal('show');
			$.ajax({
					url: '<?php echo site_url().'backend/m_listing/check_address'?>',
					cache: false,
					type: 'POST',
					data: {
						address_full		:address_full
					},
					success: function(result) {
						//var json_string = eval(json);
						//alert(result);
						//$('#sess_uid').text(json_string.sess_uid);
						//var ss = '<p>tes</p>';
						
						$("#load_data_check").html(result);
					},
					failure: function(errMsg) {
						alert(errMsg);
					}
				});
		}else
		{
			alert('alamat harus diisi');
		}

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

</script>
<div class="row">
	<div class="col-lg-12">
		<?php echo $this->session->flashdata('message_type');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $title;?> - Tambah
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body"> 
			<!--<form action="" role="form" method="post" enctype="multipart/form-data"> -->
				<form id="form_listing" action="<?php echo site_url(). 'backend/m_listing/add/';?>" role="form" method="post" enctype="multipart/form-data">
					<div class="col-lg-6">
						<?php echo form_error('date_listing', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Listing *</span>
							<input type="text" id="datetimepicker1" name="date_listing" class="form-control" value="<?php echo set_value('date_listing');?>">
						</div>
						<?php echo form_error('name_jenis_listing', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Jenis Listing *</span>	
							<?php echo commonDropdown('tb_m_jenis_listing', false, 'name_jenis_listing', 'name_jenis_listing', set_value('name_jenis_listing')); ?>
						</div>
						<?php echo form_error('vendor_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nama Vendor *</span>
							<input type="text" name="vendor_name" class="form-control" value="<?php echo set_value('vendor_name');?>">
						</div>
						<?php echo form_error('phone_1', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Telp / HP 1 *</span>
							<input type="text" name="phone_1" class="form-control" value="<?php echo set_value('phone_1'); ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Telp / HP 2</span>
							<input type="text" name="phone_2" class="form-control" value="<?php echo set_value('phone_2'); ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Telp / HP 3</span>
							<input type="text" name="phone_3" class="form-control" value="<?php echo set_value('phone_3'); ?>">
						</div>
						<?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Email</span>
							<input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>">
						</div>
						<div class="form-group input-group">
							<label>Alamat </label>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Full*</span>
							<input type="text" id="address_full" name="address_full" class="form-control" value="<?php echo set_value('address_full'); ?>">
							<span class="input-group-btn">
								<button class="btn btn-default" onClick="CheckAddress()" type="button">Check!</button>
							</span>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Singkat*</span>
							<input type="text" name="addres_show" class="form-control" value="<?php echo set_value('addres_show'); ?>">
						</div>
						<?php echo form_error('prov', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Province *</span>
							<?php echo provDropdown(set_value('prov'), 'prov','showKab')?>
						</div>
						<?php echo form_error('kab', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Kabupaten *</span>
							<div id="txtHintKab">
								<?php echo kabDropdown(set_value('prov'),set_value('kab'), 'kab','showKotkec')?>
							</div>
						</div>
						<?php echo form_error('kotkec', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Kecamatan *</span>
							<div id="txtHintKotkec">
								<?php echo kotkecDropDown(set_value('prov'),set_value('kab'),set_value('kotkec'), 'kotkec'); ?>
							</div>
						</div>
						<?php echo form_error('area', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Area *</span>	
							<input type="text" name="area" class="form-control" value="<?php echo set_value('area'); ?>">
						</div>

					</div>
					<div class="col-lg-6">
						<?php echo form_error('price_sell', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Harga Jual</span>
							<input type="text" name="price_sell" class="form-control" value="<?php echo set_value('price_sell'); ?>">
						</div>
						<?php echo form_error('price_rent', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Harga Sewa</span>
							<input type="text" name="price_rent" class="form-control" value="<?php echo set_value('price_rent'); ?>">
						</div>
						<?php echo form_error('name_type', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Type</span>
							<?php echo commonDropdown('tb_m_type', FALSE, 'name_type','name_type',set_value('name_type'));?>
						</div>
						<?php echo form_error('luas_tanah', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Luas Tanah</span>
							<input type="text" name="luas_tanah" class="form-control" value="<?php echo set_value('luas_tanah'); ?>">
						</div>
						<?php echo form_error('luas_bangunan', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Luas Bangunan</span>
							<input type="text" name="luas_bangunan" class="form-control" value="<?php echo set_value('luas_bangunan'); ?>">
						</div>
						<?php echo form_error('jml_kt', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Jumlah KT</span>
							<input type="text" name="jml_kt" class="form-control" value="<?php echo set_value('jml_kt'); ?>">
						</div>
						<?php echo form_error('jml_km', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Jumlah KM</span>
							<input type="text" name="jml_km" class="form-control" value="<?php echo set_value('jml_km'); ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Garasi</span>
							<input type="text" name="garasi" class="form-control" value="<?php echo set_value('garasi'); ?>">
						</div>
						<?php echo form_error('sertifikat', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Sertifikat</span>
							<?php echo commonDropdown('tb_m_sertifikat', false, 'sertifikat', 'sertifikat', set_value('sertifikat')); ?>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Ket Properti</span>
							<input type="text" name="ket_prop" class="form-control" value="<?php echo set_value('ket_prop'); ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">ME 1</span>
							<?php echo commonDropdown('tb_m_marketing', false, 'name_marketing', 'name_marketing_1', set_value('name_marketing_1')); ?>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">ME 2</span>
							<?php echo commonDropdown('tb_m_marketing', false, 'name_marketing', 'name_marketing_2', set_value('name_marketing_2')); ?>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">ME 1</span>
							<?php echo commonDropdown('tb_m_marketing', false, 'name_marketing', 'name_marketing_3', set_value('name_marketing_3')); ?>
						</div>
						<?php echo form_error('komisi', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Komisi</span>
							<input type="text" name="komisi" class="form-control" value="<?php echo set_value('komisi'); ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Ket. Listing</span>
							<input type="text" name="ket_listing" class="form-control" value="<?php echo set_value('ket_listing'); ?>">
						</div>
						<?php echo form_error('status_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Status</span>
							<?php echo commonDropdown('tb_status', false, 'status_name', 'status_name', set_value('status_name')); ?>
						</div>
						<hr>
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
							<button type="button" class="btn btn-warning">Batal</button>
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

<!-- Modal -->
<div class="modal fade" id="ModalCheck" tabindex="-1" role="dialog" aria-labelledby="ModalDetailListingTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalDetailListingTitle">Data Listing</h5>
      </div>
      <div class="modal-body">
	  	<div id ="load_data_check">
		  please wait...
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /.row -->