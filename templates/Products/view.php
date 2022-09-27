<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->product_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->product_id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->product_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="products view content">
            <h3><?= h($product->product_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product Img') ?></th>
                    <td><?= h($product->product_img) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Description') ?></th>
                    <td><?= h($product->product_description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= $product->has('category') ? $this->Html->link($product->category->category_id, ['controller' => 'Categories', 'action' => 'view', $product->category->category_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Supplier') ?></th>
                    <td><?= $product->has('supplier') ? $this->Html->link($product->supplier->supplier_id, ['controller' => 'Suppliers', 'action' => 'view', $product->supplier->supplier_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Id') ?></th>
                    <td><?= $this->Number->format($product->product_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Price') ?></th>
                    <td><?= $this->Number->format($product->product_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Stock') ?></th>
                    <td><?= $this->Number->format($product->product_stock) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Status') ?></th>
                    <td><?= $this->Number->format($product->product_status) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
