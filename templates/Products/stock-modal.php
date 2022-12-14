<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Agregar stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?= $this->Form->create($record, ['url' => ['controller' => 'Products', 'action' => 'movingStock', $product->product_id], 'id' => 'form-stock',
                                                'class' => 'needs-validation', 'novalidate' => true]) ?>
                        <div class="row">
                            <div class="col">
                                <div id="alertPlaceholderStock">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Cantidad</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('quantity', 
                                ['label' => false, 'required' => true]) ?>
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-quantity" class="mb-3"></div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Referencia</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('reference', 
                                        ['label' => false]) ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close-button-stock" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?= $this->Form->button(__('Guardar'), ['class' => 'btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>