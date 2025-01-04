<script type="text/javascript">
	$(document).ready(function () {
		// DISABLE
		$('#name_marketing_1').prop('disabled', true);
		$('#name_marketing_2').prop('disabled', true);
		$('#name_marketing_3').prop('disabled', true);
		$('#date_listing_from').prop('disabled', true);
		$('#date_listing_to').prop('disabled', true);
		$('#date_listing_to').prop('disabled', true);
		$('#status_name').prop('disabled', true);


		var ckboxHarga = $('#harga');
		$('input').on('click',function () {
			if (ckboxHarga.is(':checked')) {
				$('#harga_min').prop('disabled', false);
				$('#harga_max').prop('disabled', false);
				$('#harga').val(1);
			} else {
				$('#harga_min').prop('disabled', true);
				$('#harga_max').prop('disabled', true);
				$('#harga').val(0);
			}
		});
		var ckboxLuas = $('#luas');
		$('input').on('click',function () {
			if (ckboxLuas.is(':checked')) {
				$('#luas_tanah').prop('disabled', false);
				$('#luas_bangunan').prop('disabled', false);
				$('#luas').val(1);
			} else {
				$('#luas_tanah').prop('disabled', true);
				$('#luas_bangunan').prop('disabled', true);
				$('#luas').val(0);
			}
		});
		var ckboxLokasi = $('#lokasi');
		$('input').on('click',function () {
			if (ckboxLokasi.is(':checked')) {
				$('#area').prop('disabled', false);
				$('#prov').prop('disabled', false);
				$('#kab').prop('disabled', false);
				$('#kotkec').prop('disabled', false);
				$('#lokasi').val(1);
			} else {
				$('#area').prop('disabled', true);
				$('#prov').prop('disabled', true);
				$('#kab').prop('disabled', true);
				$('#kotkec').prop('disabled', true);
				$('#lokasi').val(0);
			}
		});
		var ckboxMkt = $('#check_mkt');
		$('input').on('click',function () {
			if (ckboxMkt.is(':checked')) {
				$('#name_marketing_1').prop('disabled', false);
				$('#name_marketing_2').prop('disabled', false);
				$('#name_marketing_3').prop('disabled', false);
				$('#check_mkt').val(1);
			} else {
				$('#name_marketing_1').prop('disabled', true);
				$('#name_marketing_2').prop('disabled', true);
				$('#name_marketing_3').prop('disabled', true);
				$('#check_mkt').val(0);
			}
		});
		var ckboxDate = $('#check_date');
		$('input').on('click',function () {
			if (ckboxDate.is(':checked')) {
				$('#date_listing_from').prop('disabled', false);
				$('#date_listing_to').prop('disabled', false);
				
				$('#date_listing_from').datetimepicker({
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
				$('#check_date').val(1);

				$('#date_listing_to').datetimepicker({
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
			} else {
				$('#date_listing_from').prop('disabled', true);
				$('#date_listing_to').prop('disabled', true);
				$('#check_date').val(0);
			}
		});

		var ckboxStat = $('#check_stat');
		$('input').on('click',function () {
			if (ckboxStat.is(':checked')) {
				$('#status_name').prop('disabled', false);
				$('#check_stat').val(1);
			} else {
				$('#status_name').prop('disabled', true);
				$('#check_stat').val(0);
			}
		});




		
	});

	function FormatIDRMin(val)
	{
		$('#harga_min').val(formatRupiah(val));
	}

	function FormatIDRMax(val)
	{
		$('#harga_max').val(formatRupiah(val));
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

	function formatRupiah(bilangan, prefix)
	{
		var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	
	function limitCharacter(event)
	{
		key = event.which || event.keyCode;
		if ( key != 188 // Comma
			 && key != 8 // Backspace
			 && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
			 && (key < 48 || key > 57) // Non digit
			 // Dan masih banyak lagi seperti tombol del, panah kiri dan kanan, tombol tab, dll
			) 
		{
			event.preventDefault();
			return false;
		}
	}

</script>
<script type="text/javascript">
	function GoCari()
	{
		
		var jenis 		= $('#name_jenis_listing option:selected').val();
		var name_type 	= $('#name_type option:selected').val();
		var harga_min	= $('#harga_min').val();
		var harga_max	= $('#harga_max').val();
		var luas_tanah		= $('#luas_tanah').val();
		var luas_bangunan	= $('#luas_bangunan').val();
		var prov_id		= $('#prov').val();
		var kab_id		= $('#kab').val();
		var kotkec_id	= $('#kotkec').val();
		var area		= $('#area').val();
		var harga		= $('#harga').val();
		var luas		= $('#luas').val();
		var lokasi		= $('#lokasi').val();
		var check_mkt		= $('#check_mkt').val();
		var check_date		= $('#check_date').val();
		var check_stat		= $('#check_stat').val();
		var name_marketing_1 	= $('#name_marketing_1 option:selected').val();
		var name_marketing_2 	= $('#name_marketing_2 option:selected').val();
		var name_marketing_3 	= $('#name_marketing_3 option:selected').val();
		var date_listing_from 	= $('#date_listing_from').val();
		var date_listing_to 	= $('#date_listing_to').val();
		var status_name 		= $('#status_name option:selected').val();

		//alert('luas>'+luas+' hrg>'+harga+' mkt>'+check_mkt+' loc>'+lokasi+' date>'+check_date+'stat>'+check_stat);


		if((jenis != '') && (name_type!=''))
		{
			$.ajax({
					url: '<?php echo site_url().'backend/search_listing/AjaxSearch'?>',
					cache: false,
					type: 'POST',
					data: {
						jenis		:jenis,
						name_type	:name_type,
						harga_min	:harga_min,
						harga_max	:harga_max,
						luas_tanah		:luas_tanah,
						luas_bangunan	:luas_bangunan,
						prov_id		:prov_id,
						kab_id		:kab_id,
						kotkec_id	:kotkec_id,
						area		:area,
						harga		:harga,
						luas		:luas,
						lokasi		:lokasi,
						check_mkt		:check_mkt,
						check_date		:check_date,
						check_stat		:check_stat,
						name_marketing_1		:name_marketing_1,
						name_marketing_2		:name_marketing_2,
						name_marketing_3		:name_marketing_3,
						date_listing_from		:date_listing_from,
						date_listing_to			:date_listing_to,
						status_name		:status_name
					},
					success: function(result) {
						//var json_string = eval(json);
						//alert(result);
						//$('#sess_uid').text(json_string.sess_uid);
						//var ss = '<p>tes</p>';
						$("#load_data_search").html(result);
						$( "#collapseOne" ).slideToggle( "slow" );
					},
					failure: function(errMsg) {
						alert(errMsg);
					}
				});
		}else
		{
			alert('Jenis dan Tipe Harus diisi');
		}


		
	}
	function ExportPDF()
	{
		
		var jenis 		= $('#name_jenis_listing option:selected').val();
		var name_type 	= $('#name_type option:selected').val();

		if((jenis != '') && (name_type!=''))
		{
			//document.export_search_listing.submit();
			document.forms["export_search_listing"].submit();
		}else{
			alert('Jenis dan Tipe Harus diisi');
		}
	}

	function CollapseOne()
	{
		$( "#collapseOne" ).slideToggle( "slow" );
		return false;
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
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<!-- /.panel-heading -->
			<div class="panel-body">
			<form id="export_search_listing" action="<?php echo site_url(). 'backend/cetak/export_search_listing';?>" role="form" method="post" enctype="multipart/form-data">
				<div class="panel-group" id="accordion">
                	<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="panel-title" style="cursor: pointer;" onclick="CollapseOne()">
								<a href="JavaScript:Void(0)" class="">Filter Pencarian</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
							<div class="panel-body">
								<label>Tipe dan Jenis *)</label>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group input-group">
											<span class="input-group-addon">Jenis Listing</span>	
											<?php echo commonDropdown('tb_m_jenis_listing', false, 'name_jenis_listing', 'name_jenis_listing', set_value('name_jenis_listing')); ?>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group input-group">
											<span class="input-group-addon">Tipe Properti</span>	
											<?php echo commonDropdown('tb_m_type', FALSE, 'name_type','name_type',set_value('name_type'));?>
										</div>
									</div>
								</div>
								<label><input type="checkbox" id="harga" name="harga" value="0" /> Harga</label>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group input-group">
											<span class="input-group-addon">Minimal</span>
											<input type="text" id="harga_min" name="harga_min" class="form-control" onkeyup="FormatIDRMin(this.value)" value="" disabled>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group input-group">
											<span class="input-group-addon">Maksimal</span>
											<input type="text" id="harga_max" name="harga_max" class="form-control" onkeyup="FormatIDRMax(this.value)" value="" disabled>
										</div>
									</div>
								</div>
								<label><input type="checkbox" id="luas" name="luas" value="0" /> Luas</label>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group input-group">
											<span class="input-group-addon">Tanah</span>
											<input type="text" id="luas_tanah"name="luas_tanah" class="form-control" value="" disabled>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group input-group">
											<span class="input-group-addon">Bangunan</span>
											<input type="text" id="luas_bangunan" name="luas_bangunan" class="form-control" value="" disabled>
										</div>
									</div>
								</div>
								<label><input type="checkbox" id="lokasi" name="lokasi" value="0" /> Lokasi</label>
								<div class="row">
									<div class="col-lg-3">
										<?php echo form_error('prov', '<div class="alert alert-danger">', '</div>'); ?>
										<div class="form-group input-group">
											<span class="input-group-addon">Province</span>
											<?php echo provDropdown(set_value('prov'), 'prov','showKab','disabled')?>
										</div>
									</div>
									<div class="col-lg-3">
										<?php echo form_error('kab', '<div class="alert alert-danger">', '</div>'); ?>
										<div class="form-group input-group">
											<span class="input-group-addon">Kabupaten</span>
											<div id="txtHintKab">
												<?php echo kabDropdown(set_value('prov'),set_value('kab'), 'kab','showKotkec','disabled')?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3">
										<?php echo form_error('kotkec', '<div class="alert alert-danger">', '</div>'); ?>
										<div class="form-group input-group">
											<span class="input-group-addon">Kecamatan</span>
											<div id="txtHintKotkec">
												<?php echo kotkecDropDown(set_value('prov'),set_value('kab'),set_value('kotkec'), 'kotkec','disabled'); ?>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<?php echo form_error('area', '<div class="alert alert-danger">', '</div>'); ?>
										<div class="form-group input-group">
											<span class="input-group-addon">Area</span>	
											<input type="text" id="area" name="area" class="form-control" value="" disabled>
										</div>
									</div>
								</div>
								<label><input type="checkbox" id="check_mkt" name="check_mkt" value="0" /> Marketing</label>
								<div class="row">
									<div class="col-lg-2">
										<div class="form-group input-group">
											<span class="input-group-addon">ME 1</span>
											<?php echo commonDropdown('tb_m_marketing', false, 'name_marketing', 'name_marketing_1', set_value('name_marketing_1')); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group input-group">
											<span class="input-group-addon">ME 1</span>
											<?php echo commonDropdown('tb_m_marketing', false, 'name_marketing', 'name_marketing_2', set_value('name_marketing_2')); ?>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group input-group">
											<span class="input-group-addon">ME 1</span>
											<?php echo commonDropdown('tb_m_marketing', false, 'name_marketing', 'name_marketing_3', set_value('name_marketing_3')); ?>
										</div>
									</div>
								</div>
								<label><input type="checkbox" id="check_date" name="check_date" value="0" /> Tanggal Listing</label>
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group input-group">
											<span class="input-group-addon">Dari</span>
											<input type="text" id="date_listing_from" name="date_listing_from" class="form-control" value="<?php echo set_value('date_listing_from');?>">
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group input-group">
											<span class="input-group-addon">Sampai</span>
											<input type="text" id="date_listing_to" name="date_listing_to" class="form-control" value="<?php echo set_value('date_listing_to');?>">
										</div>
									</div>

								</div>
								<label><input type="checkbox" id="check_stat" name="check_stat" value="0" /> Status Listing</label>
								<div class="row">
									<div class="col-lg-2">
										<div class="form-group input-group">
											<span class="input-group-addon">Status</span>
											<?php echo commonDropdown('tb_status', false, 'status_name', 'status_name', set_value('status_name')); ?>
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-lg-3">
										<button type="button" id="cari" onClick="GoCari()" class="btn btn-primary">Cari</button>
										<button type="button" onClick="CollapseOne()" class="btn btn-default">Hide</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				</div>
				<div id="row">
					<div id="load_data_search">
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>

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

