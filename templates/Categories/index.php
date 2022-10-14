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
    // obtenemos el formulario
    const formAdd = document.getElementById('form-add');
    const formEdit = document.getElementById('form-edit');
    
    // Obtenemos todos los campos del formulario
    const inputsAdd = document.querySelectorAll('#form-add input');
    const inputsEdit = document.querySelectorAll('#form-edit input');

    // Obtenemos el div para mostrar la alerta
    const alertPlaceholderAdd = document.getElementById('alertPlaceholderAdd');
    const alertPlaceholderEdit = document.getElementById('alertPlaceholderEdit');

    // Arreglo para validar los campos
    const campos = {
        name: false,
        categoryname: true,
    }

    // Arreglo de mensajes invalidos
    const mensajes = {
        name: 'Nombre requerido.',
        categoryname: 'Nombre requerido.',
    }

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

                $('#id').val(data['category_id']);
                $('#categoryname').val(data['category_name']);
            }

        })
    }

    const validarText = (e) => {
        if (e.target.value == "") {
            document.getElementById(`${e.target.name}`).classList.add('is-invalid');
            document.getElementById(`${e.target.name}`).classList.remove('is-valid');

            document.getElementById(`invalid-${e.target.name}`).innerHTML = mensajes[`${e.target.name}`];

            campos[e.target.name] = false;
        }else {
            document.getElementById(`${e.target.name}`).classList.remove('is-invalid');
            document.getElementById(`${e.target.name}`).classList.add('is-valid');
            document.getElementById(`invalid-${e.target.name}`).innerHTML = "";
            campos[e.target.name] = true;
        }
    }

    function alert(message, action) {
        if (action == 'Add') {
            alertPlaceholderAdd.innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert">'
                            + '<i class="bi bi-exclamation-triangle-fill me-2"></i>' + message 
                            + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
        }else if (action == 'Edit') {
            alertPlaceholderEdit.innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert">'
                            + '<i class="bi bi-exclamation-triangle-fill me-2"></i>' + message 
                            + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
        }
        
    }

    /* Seteo de eventos en los campos */
    inputsAdd.forEach((input) => {
        input.addEventListener('keyup', validarText);
        input.addEventListener('blur', validarText);    
        
    })

    inputsEdit.forEach((input) => {
        input.addEventListener('keyup', validarText);
        input.addEventListener('blur', validarText);    
        
    })

    // Validacion de submit
    formAdd.addEventListener('submit', (e) => {
        if (!formAdd.checkValidity() || !campos.name) {
            e.preventDefault();
            alert('Error: Por favor rellene el formulario correctamente.', 'Add'); 

            inputsAdd.forEach((input) => {
                if (input.value == "") {
                    document.getElementById(`${input.name}`).classList.add('is-invalid');

                    document.getElementById(`invalid-${input.name}`).innerHTML = mensajes[input.name];
                }
            })
        }   
    })

    formEdit.addEventListener('submit',(function(e) {
        if (!formEdit.checkValidity() || !campos.categoryname) {
            e.preventDefault();
            alert('Error: Por favor rellene el formulario correctamente.', 'Edit'); 

            inputsEdit.forEach((input) => {
                if (input.value == "") {
                    document.getElementById(`${input.name}`).classList.add('is-invalid');

                    document.getElementById(`invalid-${input.name}`).innerHTML = mensajes[input.name];
                }
            })
        }else {
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
        }
        
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