<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Category> $categories
 */
?>
<div class="categories index content">
    <div class="row">
        <div class="col-md-10">
            <h3><?= __('Categorías') ?></h3>
        </div>
        <div class="col-md-2 text-end">
            <?= $this->Html->link(__('Nueva categoria'), ['action' => 'add'], ['class' => 'btn btn-success']) ?>
        </div>
        
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Categoría</th>
                    <th>Nombre</th>
                    <th class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $this->Number->format($category->category_id) ?></td>
                    <td><?= h($category->category_name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $category->category_id], ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $category->category_id], ['confirm' => __('Estas seguro de eliminar: {0}?', $category->category_name), 'class' => 'btn btn-danger']) ?>
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
