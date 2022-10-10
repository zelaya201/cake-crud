<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $supplier->supplier_id],
                ['confirm' => __('Are you sure you want to delete {0}?', $supplier->supplier_name), 'class' => 'btn btn-sm btn-danger']
            ) ?>
            <?= $this->Html->link(__('Lista de proveedores'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="suppliers form content">
            <?= $this->Form->create($supplier) ?>
            <fieldset>
                <legend><?= __('Editando proveedor') ?></legend>
                <?php
                    echo $this->Form->control('supplier_name');
                    echo $this->Form->control('supplier_address');
                    echo $this->Form->control('supplier_phone');
                    echo $this->Form->control('supplier_email');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Editar'), ['class' => 'btn btn-success']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
