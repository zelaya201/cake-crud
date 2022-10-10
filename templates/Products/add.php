<!-- <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="products form content">
            <?= $this->Form->create($product) ?>
            <fieldset>
                <legend><?= __('Add Product') ?></legend>
                <?php
                    echo $this->Form->control('product_img');
                    echo $this->Form->control('product_description');
                    echo $this->Form->control('product_price');
                    echo $this->Form->control('product_stock');
                    echo $this->Form->control('product_status');
                    echo $this->Form->control('product_category_id', ['options' => $categories, 'empty' => true]);
                    echo $this->Form->control('product_supplier_id', ['options' => $suppliers, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?= $this->Form->create($product, ['url' => ['action' => 'add'],'type' => 'file']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Descripción</h6>
                            </div>
                            <div class="col-md-8">
                            <?= $this->Form->control('description', 
                                ['type' => 'textarea', 'cols' => 8,'rows' => 2 ,'label' => false]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Categoría</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('category', 
                                        ['options' => $categories, 'empty' => 'Seleccione...', 'label' => false]) ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Precio</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('price', ['label' => false]) ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Proveedor</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('supplier', 
                                    ['options' => $suppliers, 'empty' => 'Seleccione...', 'label' => false]) ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Stock</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('stock', ['label' => false]) ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Estado</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('status', 
                                    ['options' => [1 => 'Activo', 2 => 'Inactivo'], 'empty' => [0 => 'Seleccione...'], 'label' => false]) ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Imagen</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('img', ['type' => 'file', 'label' => false]) ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?= $this->Form->button(__('Guardar'), ['class' => 'btn-primary']) ?>
                <?= $this->Form->end() ?>
            
            </div>
        </div>
    </div>
</div>
