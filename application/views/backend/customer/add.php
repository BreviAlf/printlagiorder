<div class="row">
	<div class="col-lg-12">
        <?php echo $this->session->flashdata('message_type');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $title;?> - Tambah
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form action="" role="form" method="post" enctype="multipart/form-data">
					<div class="col-lg-6">
						<?php echo form_error('user_login', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="user_login">Username</span>
							<input type="text" name="user_login" class="form-control" value="<?php echo set_value('user_login');?>">
						</div>
						<?php echo form_error('user_password', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="user_password">Password</span>
							<input type="password" name="user_password" class="form-control" value="">
						</div>
						<?php echo form_error('retype_user_password', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="retype_user_password">Re-type Password</span>
							<input type="password" name="retype_user_password" class="form-control" value="">
						</div>
						<?php echo form_error('user_display_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="user_display_name">Display Name</span>
							<input type="text" name="user_display_name" class="form-control" value="<?php echo set_value('user_display_name');?>">
						</div>
						<?php echo form_error('user_email', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="user_email">Email</span>
							<input type="text" name="user_email" class="form-control" value="<?php echo set_value('user_email');?>">
						</div>
						<?php echo form_error('user_rule', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="user_rule">User Rule</span>
							<?php echo ruleDropdown(set_value('user_rule'));?>
						</div>
						<div class="form-group input-group">
							<input type="submit" class="btn btn-primary" value="Simpan">
							<?php echo anchor('backend/user','Batalkan',array('class'=>'btn btn-warning'))?>
						</div>
					</div>	
				</form>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->