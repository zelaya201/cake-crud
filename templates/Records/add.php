<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 * @var \Cake\Collection\CollectionInterface|string[] $products
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Records'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="records form content">
            <?= $this->Form->create($record) ?>
            <fieldset>
                <legend><?= __('Add Record') ?></legend>
                <?php
                    echo $this->Form->control('record_date');
                    echo $this->Form->control('record_description');
                    echo $this->Form->control('record_quantity');
                    echo $this->Form->control('record_reference');
                    echo $this->Form->control('record_product_id', ['options' => $products, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
