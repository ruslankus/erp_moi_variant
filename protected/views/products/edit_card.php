<?php /* @var $card ProductCards */ ?>
<?php /* @var $categories array */ ?>
<?php /* @var $category ProductCardCategories */ ?>
<?php /* @var $this ProductsController */ ?>
<?php /* @var $errors array */ ?>

<?php
$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/add_product.css');
?>

<?php if($errors): ?><?php Debug::out($errors); ?><?php endif;?>

<?php $this->renderPartial('//partials/_sub_menu',array('links' => $this->GetSubMenu(), 'params' => array())); ?>

<div class="container content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            
             <?php $form=$this->beginWidget('CActiveForm', array('id' =>'add-product-form','enableAjaxValidation'=>false,)); ?> 
             
                <?php if(!$card->isNewRecord): ?>
                    <input name="id" type="hidden" value="<?php echo $card->id; ?>">
                <?php endif;?>

                <div class="form-group">
                    <?php echo $form->label($model,'code');?>
                    <?php echo $form->textField($model,'code',array('class'=>'form-control'));?>
                    <?php echo $form->error($model,'code');?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'name');?>
                    <?php echo $form->textField($model,'name',array('class'=>'form-control'));?>
                    <?php echo $form->error($model,'name');?>
                </div>

                <div class="form-group">
                    <label><?php echo $this->labels['category']; ?></label>

                    
                    <?php echo $form->dropDownList($model,'category_id',$categories,array('class'=>'form-control'))?>
                </div>

                <fieldset>
                    <legend><?php echo $this->labels['dimension units']; ?></legend>
                    <div class="form-group">
                        <div class="radio">
                            <label>
                                <input <?php if($card->units == 'units'): ?>checked<?php endif; ?> type="radio" name="dim_units" value="units">
                                <?php echo $this->labels['units']; ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input <?php if($card->units == 'kg'): ?>checked<?php endif; ?> type="radio" name="dim_units" value="kg">
                                <?php echo $this->labels['kg']; ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input <?php if($card->units == 'liters'): ?>checked<?php endif; ?> type="radio" name="dim_units" value="liters">
                                <?php echo $this->labels['liters']; ?>
                            </label>
                        </div>
                    </div><!--/form-group -->
                </fieldset>

                <div class="form-group">
                    <label><?php echo $this->labels['description']; ?></label>
                    <textarea name="description" class="form-control"><?php echo $card->description; ?></textarea>
                </div>
                <button type="submit"><span><?php echo $this->labels['save']; ?></span><span class="glyphicon glyphicon-plus"></span></button>
            <?php $this->endWidget();?>
        </div>
    </div>
</div>