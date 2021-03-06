<?php /* @var $invoices OperationsOut[] */ ?>
<?php /* @var $this SellController */ ?>
<?php /* @var $cities array */ ?>
<?php /* @var $types array */ ?>
<?php /* @var $statuses array */ ?>
<?php /* @var $gen_link string */ ?>
<?php /* @var $pages int */ ?>
<?php /* @var $current_page int */ ?>

<?php
$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/invoice_list.css');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/paginator.css');
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/sales_list.js',CClientScript::POS_END);
?>

<?php $this->renderPartial('//partials/_sub_menu',array('links' => $this->GetSubMenu(), 'params' => array())); ?>

<div class="container-fluid  main-content-holder content-wrapper">
    <div class="row filter-holder">
        <form class="filter-form" method="get" action="<?php echo Yii::app()->createUrl('/sell/filtertable'); ?>" data-pages="<?php echo Yii::app()->createUrl('/sell/ajaxpages'); ?>">
            <input type="text" id="client-name-inputs" placeholder="<?php echo $this->labels['client name']; ?>">
            <input type="text" id="invoice-code-input" placeholder="<?php echo $this->labels['invoice code']; ?>">
            <select id="cli-type">
                <option value=""><?php echo $this->labels['client type']; ?></option>
                <?php foreach($types as $id => $type): ?>
                    <option value="<?php echo $id; ?>"><?php echo $type; ?></option>
                <?php endforeach;?>
            </select>
            <select id="city-selector">
                <option value=""><?php echo $this->labels['city']; ?></option>
                <?php foreach($cities as $id => $city): ?>
                    <option value="<?php echo $id; ?>"><?php echo $city; ?></option>
                <?php endforeach;?>
            </select>
            <input id="date-from" class="date-picker-cl" type="text" placeholder="<?php echo $this->labels['date from']; ?>">
            <input id="date-to" class="date-picker-cl" type="text" placeholder="<?php echo $this->labels['date to']; ?>">
            <select id="delivery-status">
                <option value=""><?php echo $this->labels['delivery status']; ?></option>
                <?php foreach($statuses as $id => $status): ?>
                    <option value="<?php echo $id; ?>"><?php echo $status; ?></option>
                <?php endforeach;?>
            </select>
            <button class="filter-button-top"><?php echo $this->labels['search']; ?><span class="glyphicon glyphicon-search"></span></button>
        </form>
    </div><!--/filter-holder -->
    <div class="row table-holder">
        <table class="table table-bordered table-striped table-hover" >
            <thead>
            <tr>
                <th>#</th>
                <th><?php echo $this->labels['operation id']; ?></th>
                <th><?php echo $this->labels['client']; ?></th>
                <th><?php echo $this->labels['client type']; ?></th>
                <th><?php echo $this->labels['city']; ?></th>
                <th><?php echo $this->labels['created']; ?></th>
                <th><?php echo $this->labels['invoice code']; ?></th>
                <th><?php echo $this->labels['PDF']; ?></th>
                <th><?php echo $this->labels['delivery status']; ?></th>
                <th><?php echo $this->labels['actions']; ?></th>
            </tr>
            </thead>
            <tbody class="ops-tbl-filter">
            <?php foreach($invoices as $nr => $operation): ?>
                <tr id="op_id_<?php echo $operation->id;?>">
                    <td><?php echo $nr + 1; ?></td>
                    <td><a class="info-open-lnk" href="<?php echo Yii::app()->createUrl('/ajax/operationoutinfo',array('id' => $operation->id)); ?>" data-toggle="modal" data-id="<?php echo $operation->id; ?>" data-target="#invoiceInfo"><?php echo $operation->id; ?></a></td>
                    <td><?php echo $operation->client->getFullName(); ?></td>
                    <td><?php echo $operation->client->typeObj->name; ?></td>
                    <td><?php echo $operation->stock->location->city_name; ?></td>
                    <td><?php echo date('Y.m.d G:i',$operation->date_created_ops); ?></td>
                    <td class="invoice-code"><?php echo $operation->invoice_code; ?></td>
                    <td><a class="gen-pdf" data-id="<?php echo $operation->id; ?>" href="<?php echo Yii::app()->createUrl('sell/generate',array('id' => $operation->id)); ?>"><?php echo $this->labels['generate pdf']; ?></a></td>
                    <td><?php echo $operation->status->name; ?></td>
                    <td><a href="#"><?php echo $this->labels['send invoice']; ?></a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

        <div class="pages-holder">
            <ul class="paginator">
                <?php for($i = 0; $i < $pages; $i++): ?>
                    <li class="<?php if(($i+1) == $current_page): ?>current-page<?php endif; ?> links-pages"><?php echo ($i+1) ?></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div><!--/table-holder -->



    <div class="modals-holder">
        <div class="invoice-ready">
            <div class="modal fade" id="invoiceInfo" tabindex="-1" role="dialog">
                <div id="modal-operation-info" class="modal-dialog">
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div><!--/invoice-ready -->
    </div><!--/modals-holder -->

</div><!--/container -->
<iframe class="file-load-frame" style="display: none; width: 0; height: 0" src="<?php echo $gen_link; ?>"></iframe>