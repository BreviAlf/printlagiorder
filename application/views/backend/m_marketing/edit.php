<script type="text/javascript">

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
				<?php echo $title;?> - Edit
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form action="" role="form" method="post" enctype="multipart/form-data">
					<div class="col-lg-6">
						<?php echo form_error('name_marketing', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="name_marketing">Nama Marketing</span>
							<input type="text" name="name_marketing" class="form-control" value="<?php echo $row->name_marketing;?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon" for="phone_1">Phone 1</span>
							<input type="text" name="phone_1" class="form-control" value="<?php echo $row->phone_1;?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon" for="phone_2">Phone 2</span>
							<input type="text" name="phone_2" class="form-control" value="<?php echo $row->phone_2;?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon" for="email">Email </span>
							<input type="text" name="email" class="form-control" value="<?php echo $row->email;?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon" for="address">Alamat</span>
							<input type="text" name="address" class="form-control" value="<?php echo $row->address;?>">
						</div>
						<img src="<?php echo base_url().$row->img_url;?>" class="img-rounded" alt="" width="200" height="120">
						<hr>
						<p id="msg"></p>
						<input type="hidden" id="upload_id" name="upload_id" value="upload_id">
						<span class="btn btn-default btn-file">
							<input type="file" id="multiFiles" name="files[]" onChange="makeFileList(); "/>
						</span>
						<br />
						<br />
						<div id="fileList"></div>
						<div id="div_clear"></div>
						<br />
							<input type="submit" class="btn btn-primary" value="Simpan">
							<?php echo anchor('backend/m_marketing','Batalkan',array('class'=>'btn btn-warning'))?>
					</div>	
				</form>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->