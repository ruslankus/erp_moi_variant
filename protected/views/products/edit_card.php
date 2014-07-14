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
                    <?php echo $form->label($model,'product_code');?>
                    <?php echo $form->textField($model,'product_code',array('class'=>'form-control','value'=> $card->product_code,));?>
                    <?php echo $form->error($model,'product_code');?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'product_name');?>
                    <?php echo $form->textField($model,'product_name',array('class'=>'form-control','value'=> $card->product_name));?>
                    <?php echo $form->error($model,'product_name');?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'category_id');?>                  
                    <?php echo $form->dropDownList($model,'category_id',$categories,array('class'=>'form-control','options' => array($card->category_id =>array('selected'=>true))));?>
                </div>

                <fieldset>
                    <legend><?php echo $this->labels['dimension units']; ?></legend>
                    <div class="form-group">
                        <div class="radio">
                            <label>
                                <?php echo $form->radioButton($model,'units',array('value'=>'units','uncheckValue'=>null,'checked'=>true));?>
                                <?php echo $this->labels['units']; ?>
                            </label>
                            
                        </div>
                        <div class="radio">
                              <label>
                                 <?php echo $form->radioButton($model,'units',array('value'=>'kg','uncheckValue'=>null));?>
                                <?php echo $this->labels['kg']; ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                 <?php echo $form->radioButton($model,'units',array('value'=>'litres','uncheckValue'=>null));?>
                                <?php echo $this->labels['liters']; ?>
                            </label>
                        </div>
                    </div><!--/form-group -->
                </fieldset>

                <div class="form-group">
                    <?php echo $form->label($model,'description')?>
                    <?php echo $form->textArea($model,'description',array('class'=>'form-control'));?>
                </div>
                <button type="submit"><span><?php echo $this->labels['save']; ?></span><span class="glyphicon glyphicon-plus"></span></button>
            <?php $this->endWidget();?>
        </div>
    </div>
</div>