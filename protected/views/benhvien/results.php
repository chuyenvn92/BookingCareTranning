<?php if($data) : ?>
<h1 class="mt-4">Có <?php echo $count ?> kết quả với từ khóa "<?php echo $search ?>"</h1>
<?php else : ?>
<?php endif; ?>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Địa chỉ</th>
                        <th>Giới thiệu</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>   
                <?php if ($data): ?>
                    <tbody>
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <td><?php echo $row->ten ?></td>
                                <td><?php echo $row->diachi ?></td>
                                <td><?php echo $row->gioithieu ?></td>
                                <td>  
                                    <a class="btn btn-primary" href="<?php echo Yii::app()->createUrl("benhvien/edit", array('id' => $row->id)) ?>" tilte="Sửa"><i class="fas fa-edit"></i>Sửa</a>
                                    <a class="btn btn-danger" href="<?php echo Yii::app()->createUrl("benhvien/delete", array('id' => $row->id)) ?>" id="delete" title="Xóa"><i class="far fa-trash-alt"></i>Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php else : ?>
                    <h3>Không có kết quả tìm kiếm cho "<?php echo $search ?>"</h3>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>