<div class="row">
	<div class="col-lg-12">

		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><?php echo $title; ?></h5>
				<?php echo $this->session->flashdata('message_type'); ?>
				<div class="d-flex mt-4 flex-row-reverse">
					<div class="p-2">

					</div>
				</div>
				<form action="" role="form" method="post" enctype="multipart/form-data">
					<div class="col-lg-6">
						<?php echo form_error('user_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="row mb-3">
						<label for="user_name" class="col-sm-3 col-form-label">Name</label>
						<div class="col-sm-9">
						
							<input type="text" name="user_name" class="form-control" value="<?php echo set_value('user_name');?>" required>
						</div></div>
						<?php echo form_error('user_password', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="row mb-3">
						<label for="user_password" class="col-sm-3 col-form-label">password</label>
						<div class="col-sm-9">
							
							<input type="password" name="user_password" class="form-control" value="">
						</div></div>
						<?php echo form_error('retype_user_password', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="row mb-3">
						<label for="retype_user_password" class="col-sm-3 col-form-label">Retype Password</label>
						<div class="col-sm-9">
							
							<input type="password" name="retype_user_password" class="form-control" value="">
						</div></div>
						<?php echo form_error('user_display_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="row mb-3">
						<label for="user_display_name" class="col-sm-3 col-form-label">Display Name</label>
						<div class="col-sm-9">
							
							<input type="text" name="user_display_name" class="form-control" value="<?php echo set_value('user_display_name');?>" required>
						</div></div>
						<?php echo form_error('user_email', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="row mb-3">
						<label for="user_email" class="col-sm-3 col-form-label">Email</label>
						<div class="col-sm-9">
							
							<input type="text" name="user_email" class="form-control" value="<?php echo set_value('user_email');?>" required>
						</div></div>

						<?php //echo form_error('user_role', '<div class="alert alert-danger">', '</div>'); ?>
						<!--div class="col-sm-9">
							<span class="input-group-addon" for="user_role">role</span>
							<input type="text" name="user_role" class="form-control" value="<?php// echo set_value('user_role');?>" required>
						</div-->

						<?php echo form_error('user_role', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="row mb-3">
						<label for="user_role" class="col-sm-3 col-form-label">User Role</label>
						<div class="col-sm-9">
						
							<?php echo ruleDropdown(set_value('user_role'));?>
						</div></div>
						<div class="d-flex mt-2 flex-row-reverse">
							<input type="submit" class="btn btn-primary" value="Simpan">
							<?php echo anchor('backend/user_crud','Batalkan',array('class'=>'btn btn-warning'))?>
						</div></div>
					</div>	
				</form>
			
				</div>

</div>
</div>

</div>
</div>
</section>