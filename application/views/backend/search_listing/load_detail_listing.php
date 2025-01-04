 

  <table class="table table-striped">
    <tbody>
      <tr>
        <td>Tanggal Listing</td>
        <td><strong><?php echo $row_data->date_listing;?></strong></td>
      </tr>
      <tr>
        <td>Tanggal Expired</td>
        <td><strong><?php echo GetExpired($row_data->date_listing,getOption('expired'));?></strong></td>
      </tr>
      <tr>
        <td>Jenis Listing</td>
        <td><strong><?php echo $row_data->jenis_listing;?></strong></td>
      </tr>
      <tr>
        <td>Nama Vendor</td>
        <td><strong><?php echo $row_data->vendor_name;?></strong></td>
      </tr>
      <tr>
        <td>No Telp / HP 1</td>
        <td><strong><?php echo $row_data->phone_1;?></strong></td>
      </tr>
      <tr>
        <td>No Telp / HP 2</td>
        <td><strong><?php echo $row_data->phone_2;?></strong></td>
      </tr>
      <tr>
        <td>No Telp / HP 3</td>
        <td><strong><?php echo $row_data->phone_3;?></strong></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><strong><?php echo $row_data->email;?></strong></td>
      </tr>
      <tr>
        <td>Alamat Full</td>
        <?php
          $this->db->where('kab_prov_id',$row_data->prov);
          $this->db->where('kab_id',$row_data->kab);
          $row_kab = $this->db->get('tb_kabupaten')->row();

          if($row_kab->kab_name){
            $kab = $row_kab->kab_name.', ';
          }else{
            $kab = '';
          }
        ?>
        <td><strong><?php echo $row_data->address_full.'<br>'. $kab.''.getDataTableById('tb_prov','prov_name','prov_id',$row_data->prov);?></strong></td>
      </tr>
      <tr>
        <td>Alamat Singkat</td>
        <td><strong><?php echo $row_data->addres_show;?></strong></td>
      </tr>
      <tr>
        <td>ME 1</td>
        <td><strong><?php echo $row_data->me_1;?></strong></td>
      </tr>
      <tr>
        <td>ME 2</td>
        <td><strong><?php echo $row_data->me_2;?></strong></td>
      </tr>
      <tr>
        <td>ME 3</td>
        <td><strong><?php echo $row_data->me_3;?></strong></td>
      </tr>
      <tr>
        <td>Area</td>
        <td><strong><?php echo $row_data->area;?></strong></td>
      </tr>
      <tr>
        <td>Tipe</td>
        <td><strong><?php echo $row_data->type;?></strong></td>
      </tr>
      <tr>
        <td>Luas Tanah</td>
        <td><strong><?php echo $row_data->luas_tanah;?></strong></td>
      </tr>
      <tr>
        <td>Luas Bangunan</td>
        <td><strong><?php echo $row_data->luas_bangunan;?></strong></td>
      </tr>
      <tr>
        <td>KT</td>
        <td><strong><?php echo $row_data->jml_kt;?></strong></td>
      </tr>
      <tr>
        <td>KM</td>
        <td><strong><?php echo $row_data->jml_km;?></strong></td>
      </tr>
      <tr>
        <td>Garasi</td>
        <td><strong><?php echo $row_data->garasi;?></strong></td>
	  </tr>
	  <tr>
        <td>Sertifikat</td>
        <td><strong><?php echo $row_data->sertifikat;?></strong></td>
	  </tr>
	  <tr>
        <td>Ket. Properti</td>
        <td><strong><?php echo $row_data->ket_prop;?></strong></td>
    </tr>
    <tr>
        <td>Ket. Listing</td>
        <td><strong><?php echo $row_data->ket_listing;?></strong></td>
	  </tr>
    <tr>
        <td>Harga Jual</td>
        <td><strong><?php echo FormatRupiah($row_data->price_sell);?></strong></td>
    </tr>
    <tr>
        <td>Harga Sewa</td>
        <td><strong><?php echo FormatRupiah($row_data->price_rent);?></strong></td>
      </tr>
    </tbody>
  </table>
  <div class="table-responsive table-bordered">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>File</th>
										<th>Type</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$i = 1;
								foreach($arr_files as $row_files) :?>
									<tr>
										<td><?php echo $row_files['user_rename'];?></td>
										<td><?php echo $row_files['type'];?></td>
										<td>
										<a type="button" id="del" class="btn btn-default btn-xs" href="<?php echo site_url(). 'backend/m_listing/download_file/'.$row_data->id_listing.'/'.$row_files['id_files']?>" target="_blank"> Download</a>
										</td>
									</tr>
								<?php 
								$i++;
								endforeach;?>
								</tbody>
							</table>
  </div>
  <div style="margin-top:10px;" class="text-right">
    <p>
    <a type="button" id="" class="btn btn-primary" href="<?php echo site_url(). 'backend/cetak/detail/'.$row_data->id_listing;?>" target="_blank"> Cetak Lengkap</a>
    <a type="button" id="" class="btn btn-primary" href="<?php echo site_url(). 'backend/cetak/singkat/'.$row_data->id_listing;?>" target="_blank"> Cetak Umum</a>
    <a type="button" id="" class="btn btn-primary" href="<?php echo site_url(). 'backend/cetak/client/'.$row_data->id_listing;?>" target="_blank"> Cetak Client</a>
   </p>
</div>

	

				