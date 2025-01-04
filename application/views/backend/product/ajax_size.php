<?php foreach ($arr_size as $size) : ?>
  <div class="input-group mt-2 has-validation">
    <div class="input-group">
      <span class="input-group-text" id="basic-addon3">Pilihan</span>
      <input type="text" class="form-control" id="size_name_<?php echo $size['uid'];?>" value="<?php echo $size['size_name']; ?>" aria-describedby="basic-addon3">
      <a href="javascript:void(0)" onclick="DeleteSize(<?php echo $prod_id; ?>,'<?php echo $size['uid']; ?>')" class="btn btn-danger">Hapus </a>
    </div>
  </div>
<?php endforeach; ?>