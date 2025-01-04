<html>
    <head>
        <title>Demo CRUD</title>
    </head>
    <body>
        <h2>Demo CRUD dengan Metode query()</h2>
        <p><strong>Tambah Data</strong></p>

        <form action="create" method="post">
            <?php echo $model->labels['kode']; ?> <br>
            <input type="text" name="kode" size="10" maxlength="4" />
            <br><br>

            <?php echo $model->labels['nama']; ?> <br>
            <input type="text" name="nama" size="30" maxlength="25" />
            <br><br>

            <?php echo $model->labels['harga']; ?> <br>
            <input type="text" name="harga" size="20" />
            <br><br>

            <?php echo $model->labels['stok']; ?> <br>
            <input type="text" name="stok" size="10" />
            <br><br>

            <input type="submit" name="btnSubmit" value="Simpan" />
            <input type="button" value="Batal" onclick="javascript:history.go(-1);"/>
        </form>
    </body>
</html>