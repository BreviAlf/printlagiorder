<html>
    <head>
        <title>Demo CRUD</title>
    </head>
    <body>
        <h2>Demo CRUD dengan Metode query()</h2>
        <p><a href="crud/create">Tambah</a></p>
        <table border="1">
            <tr>
                <th >Material ID</th>
                <th >Material Code</th>
                <th >Material Name</th>
                <th >Material GSM</th>
                <th >Material Price</th>
                <th >Ubah</th>
                <th >Hapus</th>
            </tr>
            
            <?php
            foreach ($rows as $row) { 
            ?>
            
            <tr>
                <td><?php echo $row->material_id; ?></td>
                <td><?php echo $row->material_code; ?></td>
                <td><?php echo $row->material_name; ?></td>
                <td><?php echo $row->material_gsm; ?></td>
                <td><?php echo $row->material_price; ?></td>
                <td align="center">
                    <a href="crud/update/<?php echo $row->material_id; ?>">Ubah</a>
                </td>
                <td align="center">
                    <a href="crud/delete/<?php echo $row->material_id; ?>">Hapus</a>
                </td>
            </tr>
            
            <?php 
            } 
            ?>
        </table>
    </body>
</html>
