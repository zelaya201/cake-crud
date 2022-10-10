<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 */
include 'add.php';
include 'edit.php';
?>
<<<<<<< HEAD
<div class="row">
    <div class="row">
        <div class="col-md-10">
            <h3><?= __('Productos') ?></h3>
        </div>
        <div class="col-md-2 text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Nuevo Producto
            </button>
            
        </div>
    </div>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4" >
                <div class="card" >
                    
                    <article class="well">
                        
                        <?= $this->Html->image('../files/products/product_img/' . $product->product_img_dir . '/square_' . $product->product_img, ['alt' => $product->product_description, 'class' => 'bd-placeholder-img card-img-top']) ?>
                        <div class="card-body">
                            <strong><?= h($product->product_description) ?></strong>
                            <br>
                            <strong>Precio: </strong> <?= h($product->product_price) ?>
                            <br>

                            
                            <?= $this->Html->link('Ver producto', ['controller' => 'Products', 'action' => 'view', $product->product_id],
                                ['class' => 'btn btn-sm btn-success']) ?>
                            
                        
                        </div>
                    </article>
                
                </div>
                <br><br>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>

</div>
