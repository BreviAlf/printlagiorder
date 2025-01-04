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
				<form action="<?php echo site_url() . 'backend/material/edit/' . $row_data->material_id; ?>" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
					<div class="row">
						<div class="col-lg-7">
							<div class="row mb-3">
								<label for="material_name" class="col-sm-3 col-form-label">Name</label>
								<div class="col-sm-9">
									<div class="input-group has-validation">
										<?php echo form_error('material_name', '<div class="alert alert-danger">', '</div>'); ?>
										<input type="text" name="material_name" id="material_name" class="form-control" value="<?php echo $row_data->material_name; ?>" required>
										<div class="invalid-feedback">Please enter product name.</div>
									</div>
								</div>
							</div>
							<div class="row mb-3">
                <label for="material_code" class="col-sm-3 col-form-label">material_code</label>
                <div class="col-sm-9">
                  <textarea name="material_code" class="form-control" style="height: 100px"><?php echo $row_data->material_code; ?></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label for="material_gsm" class="col-sm-3 col-form-label">material_gsm</label>
                <div class="col-sm-9">
                  <textarea name="material_gsm" class="form-control" style="height: 100px"><?php echo $row_data->material_gsm; ?></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label for="material_price" class="col-sm-3 col-form-label">material_price</label>
                <div class="col-sm-9">
                  <textarea name="material_price" class="form-control" style="height: 100px" ><?php echo $row_data->material_price; ?></textarea>
                </div>
              </div>

							<div class="d-flex mt-2 flex-row-reverse">
								<div class="p-2">
									<button class="btn btn-primary float-right" type="submit">Save</button>
									<a href="<?php echo site_url(); ?>backend/material/" class="btn btn-warning float-right">Cancel</a>
								</div>
							</div>

				</form>

			</div>

		</div>
	</div>

</div>
</div>
</section>