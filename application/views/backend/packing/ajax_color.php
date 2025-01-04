<?php foreach ($arr_color as $color) : ?>
  <div class="input-group mt-2 has-validation">
    <div class="input-group">
      <span class="input-group-text" id="basic-addon3">Pilihan <?php echo $color['color_parent']; ?></span>
      <input type="text" value="<?php echo $color['color_name']; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
      <a href="javascript:void(0)" onclick="DeleteColor(<?php echo $prod_id; ?>,<?php echo $color['color_id']; ?>)" class="btn btn-danger">Hapus </a>
    </div>
  </div>
<?php endforeach; ?>