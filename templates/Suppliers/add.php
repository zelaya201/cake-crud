<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
?>
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nuevo proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-md-1"></div>
                    <div class="col-md-10">
                    <?= $this->Form->create($supplier, ['url' => ['action' => 'add'], 'id' => 'form-add', 
                                            'class' => 'needs-validation', 'novalidate' => true]) ?>
                        <div class="row">
                            <div class="col">
                                <div id="alertPlaceholderAdd">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Nombre</h6>
                            </div>
                            <div class="col-md-8">  
                                <?= $this->Form->control('name', ['label' => false, 'class' => 'form-control', 'required' => true]) ?>
                                    <div class="invalid-feedback d-block">
                                        <div id="invalid-name" class="mb-3">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Dirección</h6>
                            </div>
                            <div class="col-md-8">  
                                <?= $this->Form->control('address', ['label' => false, 'class' => 'form-control', 'required' => true]) ?>
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-address" class="mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Teléfono</h6>
                            </div>
                            <div class="col-md-8">  
                                <?= $this->Form->control('phone', ['label' => false, 'class' => 'form-control', 'required' => true, 
                                                                'placeholder' => '1234-5678', 'maxlength' => '9']) ?>
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-phone" class="mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Correo electrónico</h6>
                            </div>
                            <div class="col-md-8">  
                                <?= $this->Form->control('email', ['label' => false, 'class' => 'form-control', 
                                                    'placeholder' => 'ejemplo@ejemplo.com']) ?>
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-email" class="mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close-button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?= $this->Form->button(__('Guardar'), ['class' => 'btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>