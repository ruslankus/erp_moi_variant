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
            <form id="add-product-form" action="<?php echo Yii::app()->createUrl(Yii::app()->controller->id.'/updatecat'); ?>" method="post" role="form">

                <?php if(!$category ->isNewRecord): ?>
                    <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="category-name"><?php echo $this->labels['category_name']; ?></label>
                    <input value="<?php echo $category->name; ?>" name="category_name" class="form-control" id="category-name" type="text">
                </div>

                <div class="form-group">
                    <label for="remark"><?php echo $this->labels['remark'] ?></label>
                    <textarea name="remark" id="remark" class="form-control" style="margin: 0 488px 0 0; height: 57px; width: 453px;"><?php echo $category->remark; ?></textarea>
                </div>

                <button type="submit"><span><?php echo $this->labels['save']; ?></span><span class="glyphicon glyphicon-plus"></span></button>
            </form>
        </div>
    </div>
</div>