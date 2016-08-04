<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th><?php echo CHtml::encode($data->getAttributeLabel('id_petani')); ?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('nama_petani')); ?></th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th><?php echo CHtml::encode($data->getAttributeLabel('id_petani')); ?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('nama_petani')); ?></th>
    </tr>
    </tfoot>
    <tbody>
    <tr>
        <td><?php echo CHtml::link(CHtml::encode($data->id_petani), array('view', 'id'=>$data->id_petani)); ?></td>
        <td><?php echo CHtml::link(CHtml::encode($data->nama_petani), array('view', 'id'=>$data->nama_petani)); ?></td>
        <td>
            <i class="glyphicon glyphicon-edit"></i>
            <i class="glyphicon glyphicon-remove"></i>
        </td>
    </tr>
    </tbody>
</table>

