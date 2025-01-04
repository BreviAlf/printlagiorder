<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
        <h5 class="card-title">Ekspor Data Harian</h5>
          <form method="post" action="<?= base_url() ?>backend/report/get_data_spk_admin_bydate">
            <div class="row mb-3">
              <label for="i_mobile_no" class="col-sm-2 col-form-label">SPK Admin</label>
              <div class="col-sm-2">
                <input class="form-control" type="date" id="spk_admin_date_bydate" name="spk_admin_date_bydate" > 
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">Download</button>
              </div>
            </div>
          </form>
          <form method="post" action="<?= base_url() ?>backend/report/get_data_spk_layout_bydate">
            <div class="row mb-3">
              <label for="i_chat" class="col-sm-2 col-form-label">Batch SPK Layout</label>
              <div class="col-sm-2">
                <input class="form-control" type="date" id="spk_layout_date_bydate" name="spk_layout_date_bydate"> 
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">Download</button>
              </div>
            </div>
          </form>
          <form method="post" action="<?= base_url() ?>backend/report/get_data_spk_packing_bydate">
            <div class="row mb-3">
              <label for="i_code" class="col-sm-2 col-form-label">Packing</label>
              <div class="col-sm-2">
                <input class="form-control" type="date" id="spk_packing_date_bydate" name="spk_packing_date_bydate"> 
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">Download</button>
              </div>
            </div>
          </form>
          <hr>
          <h5 class="card-title">Ekspor Data Bulanan</h5>
          <form method="post" action="<?= base_url() ?>backend/report/get_data_spk_admin">
            <div class="row mb-3">
              <label for="i_mobile_no" class="col-sm-2 col-form-label">SPK Admin</label>
              <div class="col-sm-2">
                <input class="form-control" type="month" id="spk_admin_date" name="spk_admin_date" > 
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">Download</button>
              </div>
            </div>
          </form>
          <form method="post" action="<?= base_url() ?>backend/report/get_data_spk_layout">
            <div class="row mb-3">
              <label for="i_chat" class="col-sm-2 col-form-label">Batch SPK Layout</label>
              <div class="col-sm-2">
                <input class="form-control" type="month" id="spk_layout_date" name="spk_layout_date"> 
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">Download</button>
              </div>
            </div>
          </form>
          <form method="post" action="<?= base_url() ?>backend/report/get_data_spk_packing">
            <div class="row mb-3">
              <label for="i_code" class="col-sm-2 col-form-label">Packing</label>
              <div class="col-sm-2">
                <input class="form-control" type="month" id="spk_packing_date" name="spk_packing_date"> 
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">Download</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
