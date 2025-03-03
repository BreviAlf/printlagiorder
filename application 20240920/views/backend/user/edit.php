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
						<?php echo form_error('user_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="user_name">Username</span>
							<input type="text" name="user_name" class="form-control" value="<?php echo $row->user_name;?>">
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
							<input type="text" name="user_display_name" class="form-control" value="<?php echo $row->user_display_name;?>">
						</div>
						<?php echo form_error('user_email', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="user_email">Email</span>
							<input type="text" name="user_email" class="form-control" value="<?php echo $row->user_email;?>">
						</div>
						<?php echo form_error('user_role', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="user_role">User Role</span>
							<?php echo ruleDropdown($row->user_role);?>
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