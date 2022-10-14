<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Supplier> $suppliers
 * @var \App\Model\Entity\Supplier $supplier
 */
include 'add.php';
include 'edit.php';
include 'delete-modal.php';
?>
<div class="container mb-4" style="border: 1px solid #DEE2E6; border-radius: 8px;">
    <div class="row mt-3 ms-3 me-3">
        <div class="row mb-2">
            <div class="col-md-9 mt-1">
                <h4><?= __('Proveedores') ?></h4>
            </div>
            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-person-plus me-2"></i>Nuevo Proveedor
                </button> 
            </div>
        </div>
        <hr>
        <div class="table-responsive mt-2">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Proveedor</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($suppliers as $supplier): ?>
                    <tr>
                        <td><?= $this->Number->format($supplier->supplier_id) ?></td>
                        <td><?= h($supplier->supplier_name) ?></td>
                        <td><?= h($supplier->supplier_address) ?></td>
                        <td><?= h($supplier->supplier_phone) ?></td>
                        <td><?= h($supplier->supplier_email) ?></td>
                        <td class="actions">
                        <!-- <?php echo('<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editSupplierId(\'' . $supplier->supplier_id . '\')">
                                            <i class="bi bi-pencil-fill"></i>&nbsp;&nbsp;Editar
                                        </a>'); ?> -->
                            <button type="button" class="btn btn-primary" onclick="editSupplierId()" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="bi bi-pencil-fill"></i>&nbsp;&nbsp;Editar
                            </button> 
                            <!-- formName almacena un numero "serial de cada modal correspondiente a un registro -->
                            <?php $this->Form->setTemplates([
                                'confirmJs' => "addToModal('{{formName}}'); return false;"
                            ]) ?>
                            <?= $this->Form->postLink(__('      Eliminar'), ['action' => 'delete', $supplier->supplier_id], ['confirm' => __('Estas seguro de eliminar: {0}?', $supplier->supplier_name), 'class' => 'btn btn-danger bi bi-trash',
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
        address: false,
        phone: false,
        email: false,
        suppliername: true,
        supplieraddress: true,
        supplierphone: true,
        supplieremail: true,
    }

    // Arreglo de mensajes invalidos
    const mensajes = {
        name: 'Nombre requerido.',
        address: 'Dirección requerida',
        phone: 'Teléfono requerido',
        suppliername: 'Nombre requerido.',
        supplieraddress: 'Dirección requerida',
        supplierphone: 'Teléfono requerido',
    }

    // Arreglo de expresiones regulares para validación
    const expresiones = {
        phone: /(\d{4})+-(\d{4})/,
        email: /^[a-zA-Z0-9.!#$%&*+\/=?^_{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
    }

    function editSupplierId() {
        event.preventDefault();
        
        $.ajax({
            url:'<?= $this->Url->build(['controller' => 'Suppliers', 'action' => 'findSupplierById', $supplier->supplier_id ]) ?>',
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            
            success: function(response) {
                data = $.parseJSON(response);

                $('#id').val(data['supplier_id']);
                $('#suppliername').val(data['supplier_name']);
                $('#supplieraddress').val(data['supplier_address']);
                $('#supplierphone').val(data['supplier_phone']);
                $('#supplieremail').val(data['supplier_email']);
            }

        })
    } /* FIN de editSupplierId() */

    /* Eliminar producto */
    function addToModal(formName) {
        const modal = document.getElementById('deleteModal');
        const h6 = document.getElementById('deleteSup');
        modal.dataset.formName = formName;

        $.ajax({
            url: '<?= $this->Url->build(['controller' => 'Suppliers', 'action' => 'findSupplierById', $supplier->supplier_id]) ?>',
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
                
                h6.innerHTML = '¿Estás seguro que deseas eliminar el proveedor <b>'+ data['supplier_name'] + '</b>?';
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

    const validarInputs = (e) => {
        switch (e.target.name) {
            case "phone" :
                validarCampo(expresiones.phone, e.target, 'phone', 'Formato de teléfono incorrecto. Solo se permite un máximo de 8 números y un guión como separador');
                break;
            case "email":
                validarCampo(expresiones.email, e.target, 'email', 'El correo solo puede contener letras, numeros, puntos, guion y guion bajo.');
                break;
            case "supplierphone" :
                validarCampo(expresiones.phone, e.target, 'supplierphone', 'Formato de teléfono incorrecto. Solo se permite un máximo de 8 números y un guión como separador');
                break;
            case "supplieremail":
                validarCampo(expresiones.email, e.target, 'supplieremail', 'El correo solo puede contener letras, numeros, puntos, guion y guion bajo.');
                break;
            
        }
    }

    const validarCampo = (expresion, input, campo, mensaje) => {
        if(expresion.test(input.value)){
            document.getElementById(`${campo}`).classList.remove('is-invalid');
            document.getElementById(`${campo}`).classList.add('is-valid');
            document.getElementById(`invalid-${campo}`).innerHTML = "";

            campos[campo] = true;
        }else {
            document.getElementById(`${campo}`).classList.add('is-invalid');
            document.getElementById(`${campo}`).classList.remove('is-valid');
            
            document.getElementById(`invalid-${campo}`).innerHTML = mensaje;
            campos[campo] = false;
        }

        if (input.value == "") {
            if (input.name == 'email' || input.name == 'supplieremail') {
                document.getElementById(`${campo}`).classList.remove('is-invalid');
                document.getElementById(`invalid-${campo}`).innerHTML = "";
            }else {
                document.getElementById(`${campo}`).classList.remove('is-valid');
            }
        }
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
        if (input.name == 'name' || input.name == 'address') {
            input.addEventListener('keyup', validarText);
            input.addEventListener('blur', validarText);    
        }else {
            input.addEventListener('keyup', validarInputs);
            input.addEventListener('blur', validarInputs);
        }
        
    })

    inputsEdit.forEach((input) => {
        if (input.name == 'suppliername' || input.name == 'supplieraddress') {
            input.addEventListener('keyup', validarText);
            input.addEventListener('blur', validarText);    
        }else {
            input.addEventListener('keyup', validarInputs);
            input.addEventListener('blur', validarInputs);
        }
        
    })

    // Validacion de submit
    formAdd.addEventListener('submit', (e) => {
        if (!formAdd.checkValidity() || !campos.name || !campos.address || !campos.phone) {
            e.preventDefault();
            alert('Error: Por favor rellene el formulario correctamente.', 'Add'); 

            inputsAdd.forEach((input) => {
                if (input.value == "" && input.name != 'email') {
                    document.getElementById(`${input.name}`).classList.add('is-invalid');

                    document.getElementById(`invalid-${input.name}`).innerHTML = mensajes[input.name];
                }
            })
        }   
    })

    formEdit.addEventListener('submit',(function(e) {
        if (!formEdit.checkValidity() || !campos.suppliername || !campos.supplieraddress || !campos.supplierphone) {
            e.preventDefault();
            alert('Error: Por favor rellene el formulario correctamente.', 'Edit'); 

            inputsEdit.forEach((input) => {
                if (input.value == "" && input.name != 'supplieremail') {
                    document.getElementById(`${input.name}`).classList.add('is-invalid');

                    document.getElementById(`invalid-${input.name}`).innerHTML = mensajes[input.name];
                }
            })
        }else {
            $.ajax({
                url: '<?= $this->Url->build(['controller' => 'Suppliers', 'action' => 'edit', $supplier->supplier_id]) ?>',
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
                        window.location = "/suppliers/";
                    }
                }

            })
        }
    }));

    $('#close-button').on('click', function() {
        alertPlaceholderAdd.innerHTML = "";

        inputsAdd.forEach((input) => {  
            if (input.name != '_csrfToken')  {
                input.classList.remove('is-invalid');
                input.classList.remove('is-valid');
                document.getElementById(`invalid-${input.name}`).innerHTML = "";
            }
        })

        formAdd.reset();
    })

    $('#close-button-edit').on('click', function() {
        alertPlaceholderEdit.innerHTML = "";

        inputsEdit.forEach((input) => { 
            if (input.name != '_csrfToken' && input.name != 'id')  {
                input.classList.remove('is-invalid');
                input.classList.remove('is-valid');
                document.getElementById(`invalid-${input.name}`).innerHTML = "";
            }
        })

        formEdit.reset();
    })
</script>