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
				<form action="<?php echo site_url() . 'backend/user_crud/edit/' . $row_data->user_id; ?>" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
					<div class="row">
						<div class="col-lg-7">
							<div class="row mb-3">
								<label for="user_name" class="col-sm-3 col-form-label">Name</label>
								<div class="col-sm-9">
									<div class="input-group has-validation">
										<?php echo form_error('user_name', '<div class="alert alert-danger">', '</div>'); ?>
										<input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $row_data->user_name; ?>" required>
										<div class="invalid-feedback">Please enter user name.</div>
									</div>
								</div>
							</div>
							<div class="row mb-3">
                <label for="user_display_name" class="col-sm-3 col-form-label">Display Name</label>
                <div class="col-sm-9">
                  <input name="user_display_name" class="form-control" value="<?php echo $row_data->user_display_name; ?>" required></input>
                </div>
              </div>
              <div class="row mb-3">
                <label for="user_email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" name="user_email" class="form-control" required value="<?php echo $row_data->user_email; ?>"></input>
                </div>
              </div>
              <div class="row mb-3">
                <label for="user_password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input name="user_password" class="form-control" required></input>
                </div>
              </div>
			  <div class="row mb-3">
                <label for="user_role" class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                  <input name="user_role" class="form-control" value="<?php echo $row_data->user_role; ?>" required></input>
                </div>
              </div>

							<div class="d-flex mt-2 flex-row-reverse">
								<div class="p-2">
									<button class="btn btn-primary float-right" type="submit">Save</button>
									<a href="<?php echo site_url(); ?>backend/user_crud/" class="btn btn-warning float-right">Cancel</a>
								</div>
							</div>

				</form>

			</div>

		</div>
	</div>

</div>
</div>
</section>