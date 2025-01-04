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
        <form action="<?php echo site_url() . 'backend/landing/edit/' . $row_data->landing_id; ?>" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
          <div class="row">
            <div class="col-lg-7">
              <div class="row mb-3">
                <label for="landing_name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    <?php echo form_error('landing_name', '<div class="alert alert-danger">', '</div>'); ?>
                    <input type="text" name="landing_name" id="landing_name" class="form-control" value="<?php echo $row_data->landing_name; ?>" required>
                    <div class="invalid-feedback">Please enter landing name.</div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
              <label for="landing_page_title" class="col-sm-3 col-form-label">Page Title</label>
                <div class="col-sm-9">
                  <div class="input-group has-validation">
                    <?php echo form_error('landing_page_title', '<div class="alert alert-danger">', '</div>'); ?>
                    <input type="text" name="landing_page_title" id="landing_page_title" class="form-control"  value="<?php echo $row_data->landing_page_title;?>" required>
                    <div class="invalid-feedback">Please enter landing page title.</div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="landing_slug" class="col-sm-3 col-form-label">Slug</label>
                <div class="col-sm-9">
                  <input type="text" name="landing_slug" id="landing_slug" class="form-control" value="<?php echo $row_data->landing_slug; ?>">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label">Header Image</label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-3">
                      <img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->landing_header_img_url; ?>" alt="">
                    </div>
                    <div class="col-sm-9 align-self-center">
                      <input class="form-control" type="file" name="file_header" id="file_header">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-2">
                <label for="prod_desc" class="col-sm-3 col-form-label">Content Header</label>
                <textarea name="landing_hedaer_content" id="content_header">
                  <?php echo $row_data->landing_hedaer_content; ?>
                </textarea><!-- End TinyMCE Editor -->
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label">Header Image Mobile</label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-3">
                      <img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->landing_header_img_url_mobile; ?>" alt="">
                    </div>
                    <div class="col-sm-9 align-self-center">
                      <input class="form-control" type="file" name="file_header_mobile" id="file_header_mobile">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 mb-2">
                <label for="prod_desc" class="col-sm-9 col-form-label">Content Header Mobile</label>
                <textarea name="landing_hedaer_content_mobile" id="content_header_mobile">
                  <?php echo $row_data->landing_hedaer_content_mobile; ?>
                </textarea><!-- End TinyMCE Editor -->
              </div>
              <div class="col-12 mb-2">
                <label for="prod_desc" class="col-sm-3 col-form-label">Content 1</label>
                <textarea name="landing_body_content_1" id="content1">
                  <?php echo $row_data->landing_body_content_1; ?>
                </textarea><!-- End TinyMCE Editor -->
              </div>
              <div class="col-12 mb-2">
                <label for="prod_desc" class="col-sm-3 col-form-label">Content 2</label>
                <textarea name="landing_body_content_2" id="content2">
				        	<?php echo $row_data->landing_body_content_2; ?>
                </textarea><!-- End TinyMCE Editor -->
              </div>
              <div class="col-12 mb-2">
                <label for="prod_desc" class="col-sm-3 col-form-label">Content 3</label>
                <textarea name="landing_body_content_3" id="content3">
				        	<?php echo $row_data->landing_body_content_3; ?>
                </textarea><!-- End TinyMCE Editor -->
              </div>
              <div class="col-12 mb-2">
                <label for="prod_desc" class="col-sm-3 col-form-label">Content 4</label>
                <textarea name="landing_body_content_4" id="content4">
				        	<?php echo $row_data->landing_body_content_4; ?>
                </textarea><!-- End TinyMCE Editor -->
              </div>
              <div class="col-12 mb-2">
                <label for="prod_desc" class="col-sm-3 col-form-label">Content 5</label>
                <textarea name="landing_body_content_5" id="content5">
				        	<?php echo $row_data->landing_body_content_5; ?>
                </textarea><!-- End TinyMCE Editor -->
              </div>
            </div>
            <div class="col-lg-5">
              <div class="col-12 mb-2">
                <label for="inputNanme4" class="form-label">Google Tag Code</label>
                <textarea name="landing_google_tag" class="form-control" style="height: 200px"><?php echo $row_data->landing_google_tag; ?></textarea>
              </div>
              <div class="col-12 mb-2">
                <label for="inputNanme4" class="form-label">FB Tag Code</label>
                <textarea name="landing_fb_pixel" class="form-control" style="height: 200px"><?php echo $row_data->landing_fb_pixel; ?></textarea>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label">Footer BG</label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-3">
                      <img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->landing_footer_img_url; ?>" alt="">
                    </div>
                    <div class="col-sm-9 align-self-center">
                      <input class="form-control" type="file" name="file_footer" id="file_footer">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label">Footer BG Mobile</label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-3">
                      <img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->landing_footer_img_url_mobile; ?>" alt="">
                    </div>
                    <div class="col-sm-9 align-self-center">
                      <input class="form-control" type="file" name="file_footer_mobile" id="file_footer_mobile">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label">Image Size Guide</label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-3">
                      <img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->landing_img_size_url; ?>" alt="">
                    </div>
                    <div class="col-sm-9 align-self-center">
                      <input class="form-control" type="file" name="file_img_size" id="file_footer_mobile">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label">CTA WA Number</label>
                <div class="col-sm-9">
                  <input placeholder="ex : 628156677899" type="number" name="landing_cta_wa_number" id="landing_cta_wa_number" class="form-control" value="<?php echo $row_data->landing_cta_wa_number;?>">  
                </div>
              </div>
              <div class="col-12 mb-2">
                <label for="inputNanme4" class="form-label">CTA WA Text On Product</label>
                <textarea placeholder="Hallo kak saya mau produk ini dong" name="landing_cta_wa_text" class="form-control" style="height: 200px"><?php echo $row_data->landing_cta_wa_text;?></textarea>
              </div>
              <div class="col-12 mb-2">
                <label for="inputNanme4" class="form-label">CTA WA Text On Event</label>
                <textarea placeholder="Hallo kak saya mau mendapatkan promo dari ISAMU!!!" name="landing_cta_event_text" class="form-control" style="height: 200px"><?php echo $row_data->landing_cta_event_text;?></textarea>
              </div>
              <div class="col-12 mb-2">
                <label for="inputNanme4" class="form-label">Meta Desc</label>
                <textarea placeholder="Isamu Berani Tampil Beda" name="landing_meta_desc" class="form-control" style="height: 200px"><?php echo $row_data->landing_meta_desc;?></textarea>
              </div>
              <div class="col-12 mb-2">
                <label for="inputNanme4" class="form-label">Meta Keywords</label>
                <textarea placeholder="t-shirt,kemeja,kaos" name="landing_meta_key" class="form-control" style="height: 200px"><?php echo $row_data->landing_meta_key;?></textarea>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-3 col-form-label">Meta Image</label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-3">
                      <img class="img-thumbnail" src="<?php echo site_url() . '' . $row_data->landing_meta_img_url; ?>" alt="">
                    </div>
                    <div class="col-sm-9 align-self-center">
                      <input class="form-control" type="file" name="file_meta" id="file_meta">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <?php echo DropdownStatus($row_data->landing_status, 'landing_status'); ?>
                </div>
              </div>

              <div class="d-flex mt-2 flex-row-reverse">
                <div class="p-2">
                  <button class="btn btn-primary float-right" type="submit">Save</button>
                  <a href="<?php echo site_url(); ?>backend/landing/" class="btn btn-warning float-right">Cancel</a>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>