<?php if($type == 1):?>
    <?php foreach($data as $row): ?>
        <tr>
            <td><a href="#" class="cust-link" data-link='/ajax/custinfo/<?php echo $row['id'];?>'><?php echo $row['company_name'] ?></a></td>
            <td><?php echo $row['company_code']?></td>
            <td>Kanto al 18-29</td>
        </tr>
    <?php endforeach;?>
<?php else:?>
    <?php foreach($data as $row): ?>
        <tr>
            <td><a href="#" class="cust-link" data-link='/ajax/custinfo/<?php echo $row['id'];?>' ><?php echo $row['name']?> <?php echo $row['surname']?></a></td>
            <td><?php echo $row['personal_code']?></td>
            <td>Kanto al 18-29</td>
        </tr>
    <?php endforeach; ?>
<?php endif;?>