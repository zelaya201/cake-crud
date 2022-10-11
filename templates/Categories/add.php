<!-- <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            
            <?= $this->Html->link(__('Lista de categorias'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="categories form content">
            <?= $this->Form->create($category) ?>
            <fieldset>
                <legend><?= __('Agregar categoria') ?></legend>
                <?php
                    echo $this->Form->control('category_name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Realizado'), ['class' => 'btn btn-success']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nueva categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?= $this->Form->create($category, ['url' => ['action' => 'add'],'type' => 'file']) ?>
                                                
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Nombre</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('name', ['label' => false]) ?> 
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