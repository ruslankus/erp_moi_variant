<?php /* @var $suppliers array */ ?>
<?php /* @var $supplier Clients */ ?>
<?php /* @var $rights UserRights */ ?>
<?php /* @var $this ContractorsController */ ?>
<?php /* @var $table_actions array */ ?>

<?php
$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/table.css');
?>

<?php $this->renderPartial('//partials/_sub_menu',array('links' => $this->GetSubMenu(), 'params' => array())); ?>

<div class="container content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="table-holder">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->labels['personal/company code']; ?></th>
                        <th><?php echo $this->labels['company']; ?></th>
                        <th><?php echo $this->labels['name']; ?></th>
                        <th><?php echo $this->labels['date of contract']; ?></th>
                        <th><?php echo $this->labels['signer name']; ?></th>
                        <th><?php echo $this->labels['phone']; ?></th>
                        <th><?php echo $this->labels['email']; ?></th>
                        <th><?php echo $this->labels['payment method']; ?></th>
                        <th><?php echo $this->labels['actions']; ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($suppliers as $supplier): ?>
                        <tr>
                            <td><?php echo $supplier->id; ?></td>
                            <td><?php echo $supplier->type == 1 ? $supplier->company_code : $supplier->personal_code; ?></td>
                            <td><?php echo $supplier->type == 1 ? $this->labels['yes'] : $this->labels['no']; ?></td>
                            <td><?php echo $supplier->type == 1 ? $supplier->company_name : $supplier->name.' '.$supplier->surname; ?></td>
                            <td><?php echo $supplier->lastInvoice ? date('Y.m.d',$supplier->lastInvoice->date_created) : '-'; ?></td>
                            <td><?php echo $supplier->lastInvoice ? $supplier->lastInvoice->signer_name : '-'; ?></td>
                            <td><?php echo $supplier->phone1; ?></td>
                            <td><?php echo $supplier->email1; ?></td>
                            <td><?php echo $supplier->lastInvoice ? $supplier->lastInvoice->paymentMethod->name : '-'; ?></td>
                            <td>
                                <?php if($this->rights['suppliers_edit']): ?>
                                    <?php echo CHtml::link($this->labels['edit'],'/'.$this->id.'/editsupp/id/'.$supplier->id,array('class' => 'actions action-edit')); ?>
                                <?php endif; ?>
                                <?php if($this->rights['suppliers_delete']): ?>
                                    <?php echo CHtml::link($this->labels['delete'],'/'.$this->id.'/deletesupp/id/'.$supplier->id,array('class' => 'actions action-delete')); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!--/table-holder -->
        </div>
    </div>
</div><!--/container -->
