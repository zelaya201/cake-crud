<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?= $this->Form->create($category, ['url' => ['action' => 'edit', $category->category_id], 'id' => 'form-edit',
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
                                <h6>Nombre</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('categoryname', ['label' => false]) ?>
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-categoryname" class="mb-3">
                                    </div>
                                </div> 
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close-buton-edit" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?= $this->Form->button(__('Guardar'), ['class' => 'btn-primary']) ?>
                <?= $this->Form->end() ?>
            
            </div>
        </div>
    </div>
</div>