<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
 */
?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?= $this->Form->create($supplier, ['url' => ['action' => 'edit', $supplier->supplier_id], 'id' => 'form-edit',
                                                'class' => 'needs-validation', 'novalidate' => true]) ?>
                        <?= $this->Form->control('id', ['label' => false, 'type' => 'hidden']) ?> 
                        <div class="row">
                            <div class="col">
                                <div id="alertPlaceholderEdit">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Nombre</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('suppliername', ['label' => false, 'class' => 'form-control', 'required' => true]) ?> 
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-suppliername" class="mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Dirección</h6>
                            </div>
                            <div class="col-md-8">  
                                <?= $this->Form->control('supplieraddress', ['label' => false, 'class' => 'form-control', 'required' => true]) ?>
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-supplieraddress" class="mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Teléfono</h6>
                            </div>
                            <div class="col-md-8">  
                                <?= $this->Form->control('supplierphone', ['label' => false, 'class' => 'form-control', 'required' => true, 
                                                                'placeholder' => '1234-5678', 'maxlength' => '9']) ?>
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-supplierphone" class="mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h6>Correo electrónico</h6>
                            </div>
                            <div class="col-md-8">  
                                <?= $this->Form->control('supplieremail', ['label' => false, 'class' => 'form-control', 
                                                    'placeholder' => 'ejemplo@ejemplo.com']) ?>
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-supplieremail" class="mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close-button-edit" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?= $this->Form->button(__('Guardar'), ['class' => 'btn-primary']) ?>
                <?= $this->Form->end() ?>
            
            </div>
        </div>
    </div>
</div>
