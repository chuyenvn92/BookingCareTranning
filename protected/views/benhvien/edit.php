<h1 class="mt-4">Sửa thông tin Bệnh viện</h1>
<div class="card mb-4">
    <div class="card-body">
        <?php echo CHtml::beginForm(); ?>
        <div class="form-group">
            <?php echo CHtml::activeLabel($model, 'Tên Bênh viện', array('class' => 'col-form-label')); ?>
            <?php echo CHtml::activeTextField($model, 'ten', array('class' => 'form-control')) ?>
            <?php echo CHtml::error($model, 'ten', array('class' => 'text-danger')); ?>
        </div>
        <div class="form-group">
            <?php echo CHtml::activeLabel($model, 'Địa chỉ', array('class' => 'col-form-label')); ?>
            <?php echo CHtml::activeTextField($model, 'diachi', array('class' => 'form-control')) ?>
            <?php echo CHtml::error($model, 'diachi', array('class' => 'text-danger')); ?>
        </div>
        <div class="form-group">
            <?php echo CHtml::activeLabel($model, 'Giới thiệu', array('class' => 'col-form-label')); ?>
            <?php echo CHtml::activeTextField($model, 'gioithieu', array('class' => 'form-control')) ?>
            <?php echo CHtml::error($model, 'gioithieu', array('class' => 'text-danger')); ?>
        </div>
        <div class="modal-footer">
            <a href="<?php echo $this->createUrl('index') ?>" class="btn btn-secondary">Trở về</a>
            <?php echo CHtml::submitButton('Sửa', array('class' => 'btn btn-primary')); ?>
        </div>
        <?php echo CHtml::endForm(); ?>
    </div>
</div>