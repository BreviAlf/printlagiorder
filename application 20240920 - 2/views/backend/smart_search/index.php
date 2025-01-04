<script type="text/javascript">
	$(document).ready(function () {
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
function GoSmartSearch()
{

	var keywords	= $('#keywords').val();

	$.ajax({
                url: '<?php echo site_url().'backend/smart_search/AjaxSmartSearch'?>',
				cache: false,
				type: 'POST',
                data: {
                    keywords	:keywords
                },
                success: function(result) {
					$("#load_data_search").html(result);
					//$( "#collapseOne" ).slideToggle( "slow" );
				},
				failure: function(errMsg) {
					alert(errMsg);
				}
    		});
	
}

function ExportPDF()
{
	var keywords = $("#keywords").val();
	window.open('<?php echo site_url().'backend/cetak/export_search_smart/'?>'+keywords, '_blank');
}

function CollapseOne()
{
	//$( "#collapseOne" ).slideToggle( "slow" );
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
			<div class="panel-heading">
				<?php echo $title;?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="panel-group" id="accordion">
                	<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="panel-title" style="cursor: pointer;" onclick="CollapseOne()">
								<a href="JavaScript:Void(0)" class="">Filter Pencarian</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group input-group">
											<span class="input-group-addon">Keywords</span>	
											<input type="text" id="keywords" name="keywords" class="form-control" value="">
										</div>
									</div>
									<div class="col-lg-4">
										<button type="button" id="cari" onClick="GoSmartSearch()" class="btn btn-primary">Cari</button>
										<button type="button" onClick="CollapseOne()" class="btn btn-default">Hide</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="row">
					<div id="load_data_search">
					</div>
				</div>
			</div>		
		</div>
	</div>
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
