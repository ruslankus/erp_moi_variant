<?php foreach($data as $row): ?>
    <tr>
        <td><a href="#" data-toggle="modal" data-target=".cust-info"><?php echo $row['name']?> <?php echo $row['surname']?></a></td>
        <td><?php echo $row['personal_code']?></td>
        <td>Kanto al 18-29</td>
    </tr>
<?php endforeach; ?>