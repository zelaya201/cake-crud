<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Supplier> $suppliers
 */
?>
<div class="suppliers index content">
    <div class="row">
        <div class="col-md-10">
            <h3><?= __('Proveedores') ?></h3>
        </div>
        <div class="col-md-2 text-end">
            <?= $this->Html->link(__('Nuevo proveedor'), ['action' => 'add'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Proveedor</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($suppliers as $supplier): ?>
                <tr>
                    <td><?= $this->Number->format($supplier->supplier_id) ?></td>
                    <td><?= h($supplier->supplier_name) ?></td>
                    <td><?= h($supplier->supplier_address) ?></td>
                    <td><?= h($supplier->supplier_phone) ?></td>
                    <td><?= h($supplier->supplier_email) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $supplier->supplier_id], ['class' => 'btn btn-primary']) ?>
                        
                        <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $supplier->supplier_id], ['confirm' => __('Estas seguro de eliminar: {0}?', $supplier->supplier_name), 'class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} total')) ?></p>
    </div>
</div>