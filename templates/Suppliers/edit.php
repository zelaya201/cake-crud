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
                        <?= $this->Form->create($supplier, ['url' => ['action' => 'edit', $supplier->supplier_id]], ['id' => 'form-edit']) ?>
                        <?= $this->Form->control('id', ['label' => false, 'type' => 'hidden']) ?> 
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Nombre</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('supplier-name', ['label' => false]) ?> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h6>Dirección</h6>
                            </div>
                            <div class="col-md-8">  
                            <?= $this->Form->control('supplier-address', ['label' => false]) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h6>Teléfono</h6>
                            </div>
                            <div class="col-md-8">  
                            <?= $this->Form->control('supplier-phone', ['label' => false]) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <h6>Correo electrónico</h6>
                            </div>
                            <div class="col-md-8">  
                            <?= $this->Form->control('supplier-email', ['label' => false]) ?>
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