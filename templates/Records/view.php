<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Record'), ['action' => 'edit', $record->record_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Record'), ['action' => 'delete', $record->record_id], ['confirm' => __('Are you sure you want to delete # {0}?', $record->record_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Records'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Record'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="records view content">
            <h3><?= h($record->record_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Record Description') ?></th>
                    <td><?= h($record->record_description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Record Reference') ?></th>
                    <td><?= h($record->record_reference) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $record->has('product') ? $this->Html->link($record->product->product_id, ['controller' => 'Products', 'action' => 'view', $record->product->product_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Record Id') ?></th>
                    <td><?= $this->Number->format($record->record_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Record Quantity') ?></th>
                    <td><?= $this->Number->format($record->record_quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Record Date') ?></th>
                    <td><?= h($record->record_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
