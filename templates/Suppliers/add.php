<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            
            <?= $this->Html->link(__('Lista de proveedores'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80" >
        <div class="suppliers form content">
            <?= $this->Form->create($supplier) ?>
            <fieldset>
                <legend><?= __('Agregar proveedor') ?></legend>
                <?php
                    echo $this->Form->control('Nombre de proveedor');
                    echo $this->Form->control('Dirección');
                    echo $this->Form->control('Telefono');
                    echo $this->Form->control('Correo electronico');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Realizado'), ['class' => 'btn btn-success']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
