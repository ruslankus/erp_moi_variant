<?php /* @var $this Controller */ ?>
<?php /* @var $client Clients */ ?>
<?php /* @var $operation OperationsOut */ ?>
<?php /* @var $next_controller string */ ?>
<?php /* @var $next_action string */ ?>


<div class="modal-header clearfix">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->labels['close']; ?></span></button>
    <h4 class="modal-title"><?php echo $client->getFullName(); ?></h4>
</div><!--/modal-header -->

<div class="modal-body">
    <div class="cust-info-table">
        <h5><?php echo $this->labels['customer info']; ?></h5>
        <table>
            <tr>
                <td><?php echo $this->labels['name']; ?></td>
                <td><?php echo $client->name; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->labels['surname']; ?></td>
                <td><?php echo $client->surname; ?></td>
            </tr>
            <tr>
                <td><?php echo $client->type == 1 ? $this->labels['company_code'] : $this->labels['personal_code']; ?></td>
                <td><?php echo $client->type == 1 ? $client->company_code : $client->personal_code; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->labels['phone']; ?></td>
                <td><?php echo $client->phone1; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->labels['email']; ?></td>
                <td><?php echo $client->email1; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->labels['address']; ?></td>
                <td><?php echo $client->country.', '.$client->city.', '.$client->street.', '.$client->building_nr; ?></td>
            </tr>
        </table>
    </div><!--/cust-info-table -->
    <div class="last-purchase-table">
        <h5><?php $this->labels['last purchase']; ?></h5>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th><?php echo $this->labels['date']; ?></th>
                <th><?php echo $this->labels['code']; ?></th>
                <th><?php echo $this->labels['name'];?></th>
            </tr>
            </thead>
            <tbody>
            <?php if($client->lastInvoice): ?>
                <?php foreach($client->lastInvoice->operationsOuts as $operation): ?>
                    <tr>
                        <td><?php echo $operation->id; ?></td>
                        <td><?php echo date('Y.m.d',$operation->date); ?></td>
                        <td><?php echo $operation->productCard->product_code; ?></td>
                        <td><?php echo $operation->productCard->product_name; ?></td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </div><!--/last-purchase-table -->
</div><!--/modoal-body -->

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->labels['close']; ?><span class="glyphicon glyphicon-thumbs-down"></span></button>
    <a href="<?php echo Yii::app()->createUrl('/sell/nextstepcreate', array('id' => $client->id)); ?>">
        <button type="button" class="btn btn-primary"><?php echo $this->labels['continue']; ?><span class="glyphicon glyphicon-share-alt"></span></button>
    </a>
</div><!--/modal-footer -->

