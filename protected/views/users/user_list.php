<?php /* @var $user Users */?>
<?php /* @var $users Array */ ?>
<?php /* @var $this UsersController */ ?>

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
                        <th><?php echo $this->labels['name']; ?></th>
                        <th><?php echo $this->labels['surname']; ?></th>
                        <th><?php echo $this->labels['position']; ?></th>
                        <th><?php echo $this->labels['actions'] ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user->id; ?></td>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $user->surname; ?></td>
                            <td><?php echo $user->position ? $user->position->name : '-'; ?></td>
                            <td>
                                <?php if($this->rights['users_edit']): ?>
                                    <?php echo CHtml::link($this->labels['edit'],'/'.$this->id.'/edit/id/'.$user->id,array('class' => 'actions action-edit')); ?>
                                <?php endif; ?>
                                <?php if($this->rights['users_delete']): ?>
                                    <?php echo CHtml::link($this->labels['delete'],'/'.$this->id.'/delete/id/'.$user->id,array('class' => 'actions action-delete')); ?>
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
