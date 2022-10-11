<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 750px;">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-2">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-1">
                                <h1>
                                    <i class="bi bi-exclamation-diamond text-danger" style="-webkit-text-stroke: 1px; width:30px;"></i>
                                </h1>
                            </div>
                            <div class="col-md-10 ms-3 mt-2">
                                <h4>Eliminar proveedor.</h4>
                                <h6 class="text-secondary fw-normal mt-3" id="deleteSup"></h6>
                                <h6 class="text-danger">Este proceso no puede ser deshecho.</h6>    
                            </div>
                        </div>  
                        
                       
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <?= $this->Form->button(__('Eliminar'), ['class' => 'btn btn-danger', 'id' => 'delete-button']) ?>
                <?= $this->Form->end() ?>
            
            </div>
        </div>
    </div>
</div>