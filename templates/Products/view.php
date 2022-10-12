<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 * @var \App\Model\Entity\Record $record
 * @var iterable<\App\Model\Entity\Record> $records
 */
include 'stock-modal.php';
include 'edit.php';
include 'delete-modal.php'
?>
<script>
    /* Lanzar modal y cambiarle titulo segun la acción */
    $('#stockModal').on('show.bs.modal', function (accion) {
        const btns = document.querySelectorAll('img[id^="stock-"]'); // Se traen los botones
        btns.forEach((btn) => { //Por cada boton
            btn.addEventListener('click', e => { // Al hacer click
                if(e.target.id == 'stock-add') { // Si el id del boton es
                    $('.modal-title').text('Agregar stock'); //Entonces agregar el titulo "x"
                    $('.btn-primary').attr('id', 'add-stock');
                }else {
                    $('.modal-title').text('Eliminar stock');
                    $('.btn-primary').attr('id', 'delete-stock');
                }
            });
        });
    
    });

    /* Agregar y eliminar stock*/
    $("#form-stock").on('submit',(function(e) {
        event.preventDefault();
        
        if(document.querySelector('button[id="add-stock"]')){
            accion = 'agregar'
        }else {
            accion = 'eliminar'
        }

        parametros = new FormData(this); // Se instancia el formData
        parametros.append('accion', accion) // Se agrega el valor de la accion al formData

        $.ajax({
            url: '<?= $this->Url->build(['controller' => 'Records', 'action' => 'add', $product->product_id]) ?>',
            type: 'POST',
            data: parametros,
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            cache : false,
            processData: false,
            contentType: false,
            beforeSend: function(){},
            success: function(response) {
                if (response) {
                    window.location = "/products/view/" + "<?php echo ($product->product_id); ?>";
                    
                }
            }
        })
    }))

    /* Eliminar producto */
    function addToModal(formName) {
        const modal = document.getElementById('deleteModal');

        modal.dataset.formName = formName;
    }

    $('#delete-button').on('click', function() {
        const modal = document.getElementById('deleteModal');
        formName = modal.dataset.formName;
        
        if (formName) {
            document[formName].submit();
        }
    })

    /* Cambiar imagen */
    $(document).ready(function() {
        $('#input-img').change(function() {
            $('#form-img').submit()
        })
    })
</script>
<div class="container" style="border: 1px solid #DEE2E6; border-radius: 8px;">
    <div class="row">
        <div class="col-md-12">
            <div class="row mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <div class="text-center">
                        <?= $this->Form->create($product, ['url' => ['action' => 'editImage', $product->product_id], 'type' => 'file', 'id' => 'form-img']) ?>
                            <?= $this->Html->image('../files/products/product_img/' . $product->product_img_dir . '/square_' . $product->product_img,
                                            ['alt' => $product->product_description, 'class' => 'img-responsive img-thumbnail center-block', 'width' => '270px' ]) ?>
                    </div>
                    <div class="text-center mt-3">
                            <?= $this->Form->control('input-img', ['type' => 'file', 'style' => 'display: none;', 'label' => false]) ?>
                            <label for="input-img" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-image-fill"></i>&nbsp;&nbsp;Cambiar foto
                            </label>
                            
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="bi bi-pencil-fill"></i>&nbsp;&nbsp;Editar
                            </button>
                        <?= $this->Form->end() ?>
                            
                        <?php $this->Form->setTemplates([
                            'confirmJs' => "addToModal('{{formName}}'); return false;"
                        ]) ?>

                        <?= $this->Form->postLink(__('<i class="bi bi-trash"></i>&nbsp;&nbsp;Eliminar'), 
                                    ['action' => 'delete', $product->product_id], 
                                    ['confirm' => __('Are you sure you want to delete # {0}?', $product->product_id),
                                    'class' => 'btn btn-outline-danger btn-sm',
                                    'data-bs-toggle' => 'modal',
                                    'data-bs-target' => '#deleteModal',
                                    'escape' => false]) ?>
                        
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 style="margin: 0;">
                                <?php echo (h($product->product_description)) ?>
                            </h4>
                        </div>
                    </div>   
                    <label class="fs-5">Stock disponible</label><br>
                    <label class="fw-bold fs-3"><?= $this->Number->format($product->product_stock) ?></label>                 
                    <br>
                    <div class="mb-2">
                        <span class="badge bg-success" style="margin:0;">
                            Precio:
                            <?= $this->Number->format($product->product_price, ['places' => 2, 'before' => '$']) ?>
                        </span><br>
                        <span class="badge bg-primary" style="margin:0;">
                            Categoria:
                            <?= $product->has('category') ? $product->category->category_name : '' ?>
                        </span><br>
                        <span class="badge bg-warning text-dark " style="margin:0;">
                            Proveedor:
                            <?= $product->has('supplier') ? $product->supplier->supplier_name : '' ?>
                        </span>
                    </div>
                    <div>
                        <a data-bs-toggle="modal" data-bs-target="#stockModal" style="cursor: pointer;">
                            <?= $this->Html->image('../img/stock-in.png',
                                            ['alt' => 'stock-in', 'id' => 'stock-add', 'width' => '100px']) ?>
                        </a>
                        <a data-bs-toggle="modal" data-bs-target="#stockModal" style="cursor: pointer;">
                            <?= $this->Html->image('../img/stock-out.png',
                                            ['alt' => 'stock-out', 'id' => 'stock-delete', 'width' => '100px']) ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 mb-3">
        <div class="container" style="width: 900px;">
            <hr>
                <h5 class="text-center">Historial de inventario</h5>
            <hr>
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <th>Fecha</td>
                        <th>Hora</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Referencia</th>
                    </tr>
                    <?php 
                    if (!empty($records)) {
                        foreach ($records as $record): 
                            
                                $fecha = $record->record_date->format('d/m/Y'); // Se obtiene la fecha
                                $hora = $record->record_date->format('g:i:s A'); // Se obtiene la hora ?>
                                <tr>
                                    <td><?= h($fecha) ?></td>
                                    <td><?= h($hora) ?></td>
                                    <td><?= h($record->record_description) ?></td>
                                    <td><?= $this->Number->format($record->record_quantity) ?></td>
                                    <td><?= h($record->record_reference) ?></td>
                                </tr>
                    <?php
                        endforeach;
                    } if(empty($records)) { ?>
                        <tr class="text-center">
                            <td colspan="5">No existen registros de historial para este producto</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
                </ul>
                <!-- <p><?= $this->Paginator->counter(__('Pag{{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p> -->
            </div>
        </div>
        
    </div>
</div>

<script>
    // obtenemos el formulario
    var form = document.getElementById('form-edit');

    // Obtenemos todos los campos del formulario
    var textArea = document.querySelector('#form-edit textarea');
    var inputs = document.querySelectorAll('#form-edit input');
    var selects = document.querySelectorAll('#form-edit select')

    // Obtenemos el div para mostrar la alerta
    var alertPlaceholder = document.getElementById('alertPlaceholder');

    // Arreglo para validar los campos
    const campos = {
        product_description: true,
        product_category_id: true,
        product_price: true,
        product_supplier_id: true,
    }

    // Arreglo de mensajes invalidos
    const mensajes = {
        product_description: 'Descripción requerida.',
        product_category_id: 'Categoria requerida,',
        product_price: 'Precio requerido.',
        product_supplier_id: 'Proveedor requerido.',
    }

    // Arreglo de expresiones regulares para validación
    var expresiones = {
        price: /^(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/,
    }

    const validarInputs = (e) => {
        switch (e.target.name) {
            case "product_price" :
                validarCampo(expresiones.price, e.target, 'product_price', 'El precio solo debe contener numeros, ser mayor a cero y no poseer más de dos decimales.');
                break;
        }
    }

    const validarCampo = (expresion, input, campo, mensaje) => {
        if(expresion.test(input.value)){
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            document.getElementById(`invalid-${campo}`).innerHTML = "";
            
            campos[campo] = true;
        }else {
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            
            document.getElementById(`invalid-${campo}`).innerHTML = mensaje;
            campos[campo] = false;
        }

        if (input.value == "") {
            input.classList.add('is-invalid'); 
            campos[campo] = true;
        }

        if(campos.product_description && campos.product_category_id && campos.product_price && campos.product_supplier_id) {
            alertPlaceholder.classList.add('d-none');
        }else {
            alertPlaceholder.classList.remove('d-none');
        }
    }

    const validarTextArea = (e) => {
        if (e.target.value == "") {
            e.target.classList.add('is-invalid');
            e.target.classList.remove('is-valid');

            document.getElementById(`invalid-${e.target.name}`).innerHTML = mensajes[`${e.target.name}`];

            campos[e.target.name] = false;
        }else {
            e.target.classList.remove('is-invalid');
            e.target.classList.add('is-valid');
            document.getElementById(`invalid-${e.target.name}`).innerHTML = "";
            campos[e.target.name] = true;
        }

        if(campos.product_description && campos.product_category_id && campos.product_price && campos.product_supplier_id) {
            alertPlaceholder.classList.add('d-none');
        }else {
            alertPlaceholder.classList.remove('d-none');
        }
    }


    function alert(message) {
        alertPlaceholder.innerHTML = '<div class="alert alert-danger alert-dismissible" role="alert">'
                            + '<i class="bi bi-exclamation-triangle-fill me-2"></i>' + message 
                            + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
    }

    /* Seteo de eventos en los campos */
    textArea.addEventListener('keyup', validarTextArea);
    textArea.addEventListener('blur', validarTextArea); 

    inputs.forEach((input) => {
        if (input.name == 'product_price'){
            input.addEventListener('keyup', validarInputs);
            input.addEventListener('blur', validarInputs);
        }
    })

    selects.forEach((select) => {
        select.addEventListener('blur', validarTextArea);
        select.addEventListener('change', validarTextArea);
    })
    

    // Validacion de submit
    form.addEventListener('submit', (e) => {
        if (!form.checkValidity() || !campos.product_description || !campos.product_category_id || !campos.product_price || !campos.product_supplier_id) {
            e.preventDefault();
            alert('Error: Por favor rellene el formulario correctamente.'); 

            if (textArea.value == "") {
                textArea.classList.add('is-invalid');

                document.getElementById('invalid-product_description').innerHTML = mensajes['product_description'];
            }

            selects.forEach((select) => {
                if (select.value == "") {
                    select.classList.add('is-invalid');

                    document.getElementById(`invalid-${select.name}`).innerHTML = mensajes[select.name];
                }
            })

            inputs.forEach((input) => {
                if (input.value == "") {
                    input.classList.add('is-invalid');

                    document.getElementById(`invalid-${input.name}`).innerHTML = mensajes[input.name];
                }
            })
        }   
    })

    $('#close-button').on('click', function() {
        alertPlaceholder.innerHTML = "";
        
        textArea.classList.remove('is-invalid');
        textArea.classList.remove('is-valid');
        document.getElementById(`invalid-product_description`).innerHTML = "";

        inputs.forEach((input) => {
            if (input.name == 'product_price') {
                input.classList.remove('is-invalid');
                input.classList.remove('is-valid');
                document.getElementById(`invalid-${input.name}`).innerHTML = "";
            }
        })
        
        selects.forEach((select) => {
            select.classList.remove('is-invalid');
            select.classList.remove('is-valid');
            document.getElementById(`invalid-${select.name}`).innerHTML = "";
        })

        form.reset();
    })
</script>

