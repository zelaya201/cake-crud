<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var string[]|\Cake\Collection\CollectionInterface $categories
 * @var string[]|\Cake\Collection\CollectionInterface $suppliers
 */
?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?= $this->Form->create($product, ['url' => ['action' => 'edit', $product->product_id]], ['id' => 'form-edit']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Descripción</h6>
                            </div>
                            <div class="col-md-8">
                            <?= $this->Form->control('id-edit', ['type' => 'hidden']) ?>
                            <?= $this->Form->control('product_description', 
                                ['type' => 'textarea', 'cols' => 8,'rows' => 2 ,'label' => false]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Categoría</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('product_category_id', 
                                        ['options' => $categories, 'empty' => 'Seleccione...', 'label' => false]) ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Precio</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('product_price', ['label' => false]) ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Proveedor</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('product_supplier_id', 
                                    ['options' => $suppliers, 'empty' => 'Seleccione...', 'label' => false]) ?> 
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