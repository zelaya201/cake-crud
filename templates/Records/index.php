<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Record> $records
 */
?>
<div class="records index content">
    <?= $this->Html->link(__('New Record'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Records') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('record_id') ?></th>
                    <th><?= $this->Paginator->sort('record_date') ?></th>
                    <th><?= $this->Paginator->sort('record_description') ?></th>
                    <th><?= $this->Paginator->sort('record_quantity') ?></th>
                    <th><?= $this->Paginator->sort('record_reference') ?></th>
                    <th><?= $this->Paginator->sort('record_product_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= $this->Number->format($record->record_id) ?></td>
                    <td><?= h($record->record_date) ?></td>
                    <td><?= h($record->record_description) ?></td>
                    <td><?= $this->Number->format($record->record_quantity) ?></td>
                    <td><?= h($record->record_reference) ?></td>
                    <td><?= $record->has('product') ? $this->Html->link($record->product->product_id, ['controller' => 'Products', 'action' => 'view', $record->product->product_id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $record->record_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $record->record_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $record->record_id], ['confirm' => __('Are you sure you want to delete # {0}?', $record->record_id)]) ?>
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
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
