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
				<form action="<?php echo site_url().'backend/niche/edit/'.$row_data->niche_id;?>" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
					<div class="row">
						<div class="col-lg-7">
							<div class="row mb-3">
								<label for="niche_name" class="col-sm-3 col-form-label">Name</label>
								<div class="col-sm-9">
									<div class="input-group has-validation">
										<?php echo form_error('niche_name', '<div class="alert alert-danger">', '</div>'); ?>
										<input type="text" name="niche_name" id="niche_name" class="form-control" value="<?php echo $row_data->niche_name; ?>" required>
										<div class="invalid-feedback">Please enter product name.</div>
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<label for="niche_desc" class="col-sm-3 col-form-label">Desc</label>
								<div class="col-sm-9">
									<textarea name="niche_desc" class="form-control" style="height: 100px"><?php echo $row_data->niche_desc; ?></textarea>
								</div>
							</div>

							<div class="row mb-3">
								<label for="inputNumber" class="col-sm-3 col-form-label">Image</label>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-sm-3">
											<img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->niche_img_url;?>" alt="">
										</div>
										<div class="col-sm-9 align-self-center">
											<input class="form-control" type="file" name="file_image" id="file_image">
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="col-lg-5">
							<div class="row mb-3">
								<label for="inputText" class="col-sm-3 col-form-label">Status</label>
								<div class="col-sm-9">
									<?php echo DropdownStatus($row_data->niche_status, 'cat_status'); ?>
								</div>
							</div>

							<div class="d-flex mt-2 flex-row-reverse">
								<div class="p-2">
									<button class="btn btn-primary float-right" type="submit">Save</button>
									<a href="<?php echo site_url(); ?>backend/niche/" class="btn btn-warning float-right">Cancel</a>
								</div>
							</div>

				</form>

			</div>

		</div>
	</div>

</div>
</div>
</section>