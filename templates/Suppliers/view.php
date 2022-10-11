<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 * @var \App\Model\Entity\Record $record
 * @var iterable<\App\Model\Entity\Record> $records
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Supplier'), ['action' => 'edit', $supplier->supplier_id], ['class' => 'btn btn-sm btn-secondary']) ?>
            <?= $this->Form->postLink(__('Delete Supplier'), ['action' => 'delete', $supplier->supplier_id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplier->supplier_id), 'class' => 'btn btn-sm btn-secondary']) ?>
            <?= $this->Html->link(__('List Suppliers'), ['action' => 'index'], ['class' => 'btn btn-sm btn-secondary']) ?>
            <?= $this->Html->link(__('New Supplier'), ['action' => 'add'], ['class' => 'btn btn-sm btn-secondary']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="suppliers view content">
            <h3><?= h($supplier->supplier_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Supplier Name') ?></th>
                    <td><?= h($supplier->supplier_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Supplier Address') ?></th>
                    <td><?= h($supplier->supplier_address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Supplier Phone') ?></th>
                    <td><?= h($supplier->supplier_phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Supplier Email') ?></th>
                    <td><?= h($supplier->supplier_email) ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>
