<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title><?php if(isset($title)) echo $title;?></title>

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="<?php echo base_url()?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="<?php echo base_url()?>assets/dist/css/timeline.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo base_url()?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="<?php echo base_url()?>assets/bower_components/morrisjs/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<script type="text/javascript">
function back()
{
	url = "<?php echo site_url().'dashboard'?>";
	window.open(url, '_self');
}
</script>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">No access</h3>
                    </div>
                    <div class="panel-body">
                        <p>Maaf, anda tidak diperkenankan mengakses halaman ini</p>
                    </div>
					<div class="panel-footer">
						<button onClick="back()" type="button" class="btn btn-warning btn-block">Kembali</button>
					</div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url()?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>assets/dist/js/sb-admin-2.js"></script>

</body>

</html>

