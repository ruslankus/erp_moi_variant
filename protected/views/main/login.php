<?php /* @var $errors array */ ?>


<div class="row">

    <div class="form-holder col-xs-12">
        <div class="main-form-wrapper">
            <div class="login-header-holder"><h1><?php echo $this->labels['enter password']; ?></h1></div>

            <div class="form-wrapper">
                
                 <?php $form=$this->beginWidget('CActiveForm', array('id' =>'login-form','enableAjaxValidation'=>false,'htmlOptions'=>array('class'=>'clearfix'))); ?> 

                    <div class="form-group">
                        <label for="login"><?php echo $this->labels['login']?></label>
                      
                        <?php echo $form->textField($model,'username',array('class'=>'form-control'));?>
                        <?php echo $form->error($model,'username'); ?>
                    </div>

                    <div class="form-group">
                        <label for="password"><?php echo $this->labels['password']; ?></label>                        
                        <?php echo $form->passwordField($model,'password',array('class'=>'form-control'));?>
                        <?php echo $form->error($model,'password');?>                       
                    </div>

                    <button class="btn btn-default pull-right"><span><?php echo $this->labels['login']; ?></span><span><img src="/images/filters_arrow.png" width="36" height="36" ></span></button>
                <?php $this->endWidget(); ?>
            </div><!--/form-wrapper -->
        </div><!--/form-holder -->
    </div>
</div><!--/row -->