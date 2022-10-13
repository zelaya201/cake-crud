<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Category> $categories
 * @var \App\Model\Entity\Supplier $supplier
 */
include 'add.php';
include 'edit.php';
include 'delete-modal.php';
?>
<div class="container mb-4" style="border: 1px solid #DEE2E6; border-radius: 8px;">
    <div class="row mt-3 ms-3 me-3">
        <div class="row">
            <div class="col-md-9 mb-2 mt-1">
                <h4><?= __('Categorías') ?></h3>
            </div>
            <div class="col-md-3 text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-journal-plus me-2"></i>Nueva Categoría
                </button> 
            </div>
        </div>
        <hr>
        <div class="table-responsive mt-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Categoría</th>
                        <th>Nombre</th>
                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $this->Number->format($category->category_id) ?></td>
                        <td><?= h($category->category_name) ?></td>
                        <td class="actions">
                        <button type="button" class="btn btn-primary" onclick="editCategoryId()" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="bi bi-pencil-fill"></i>&nbsp;&nbsp;Editar
                        </button> 

                        <?php $this->Form->setTemplates([
                                'confirmJs' => "addToModal('{{formName}}'); return false;"
                            ]) ?>   

                        <?= $this->Form->postLink(__('      Eliminar'), ['action' => 'delete', $category->category_id], ['confirm' => __('Estas seguro de eliminar: {0}?', $category->category_name), 'class' => 'btn btn-danger bi bi-trash',
                                                'data-bs-toggle' => 'modal',
                                                'data-bs-target' => '#deleteModal',]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('Previo')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
            </ul>
        </div>
    </div>
</div>
<script>
    function editCategoryId(){
        event.preventDefault();

        $.ajax({
                url:'<?= $this->Url->build(['controller' => 'Categories', 'action' => 'findCategoryById', $category->category_id]) ?>',
                type: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                
                success: function(response) {
                    data = $.parseJSON(response);

                    console.log(data);
                    $('#id').val(data['category_id']);
                    $('#category-name').val(data['category_name']);
                }

            })
    }

    $("#form-edit").on('submit',(function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?= $this->Url->build(['controller' => 'Categories', 'action' => 'edit', $category->category_id]) ?>',
                type: 'POST',
                data: new FormData(this),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                cache : false,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        window.location = "/categories/";
                    }
                }
            })
        }));

        function addToModal(formName) {
        const modal = document.getElementById('deleteModal');
        const h6 = document.getElementById('deleteCat');
        modal.dataset.formName = formName;

        $.ajax({
            url: '<?= $this->Url->build(['controller' => 'Categories', 'action' => 'findCategoryById', $category->category_id]) ?>',
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            cache : false,
            processData: false,
            contentType: false,
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                console.log(response);
                h6.innerHTML = '¿Estás seguro que deseas eliminar la categoria <b>'+ data['category_name'] + '</b>?';
            }
        })
    }

    $('#delete-button').on('click', function() {
        const modal = document.getElementById('deleteModal');
        formName = modal.dataset.formName;

        if (formName) {
            document[formName].submit();
        }
    })
</script>