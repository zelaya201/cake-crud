<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 */
?>
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?= $this->Form->create($product, ['url' => ['action' => 'add'], 'id' => 'form-add', 'type' => 'file', 
                                                            'class' => 'needs-validation', 'novalidate' => true]) ?>
                        <div class="row">
                            <div class="col">
                                <div id="alertPlaceholder">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Descripción</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('description', 
                                    ['type' => 'textarea', 'cols' => 8,'rows' => 2 ,'label' => false, 'required' => true,
                                    'class' => 'form-control']) ?>
                                    <div class="invalid-feedback d-block">
                                        <div id="invalid-description" class="mb-3">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Categoría</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('category', 
                                        ['options' => $categories, 'empty' => 'Seleccione...', 'label' => false, 
                                        'required' => true, 'class' => 'form-control']) ?>
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-category" class="mb-3"></div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Precio</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('price', ['label' => false, 'required' => true]) ?> 
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-price" class="mb-3"></div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Proveedor</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('supplier', 
                                    ['options' => $suppliers, 'empty' => 'Seleccione...', 'label' => false, 'required' => true]) ?> 
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-supplier" class="mb-3"></div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>(*) Imagen</h6>
                            </div>
                            <div class="col-md-8">
                                <?= $this->Form->control('img', ['type' => 'file', 'label' => false, 'required' => true]) ?> 
                                <div class="invalid-feedback d-block">
                                    <div id="invalid-img"></div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close-button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?= $this->Form->button(__('Guardar'), ['class' => 'btn-primary', 'id' => 'submit-button']) ?>
                <?= $this->Form->end() ?>
            
            </div>
        </div>
    </div>
</div>
<script>
    // obtenemos el formulario
    var form = document.getElementById('form-add');

    // Obtenemos todos los campos del formulario
    var textArea = document.getElementById('description');
    var inputs = document.querySelectorAll('#form-add input');
    var selects = document.querySelectorAll('#form-add select')

    // Obtenemos el div para mostrar la alerta
    var alertPlaceholder = document.getElementById('alertPlaceholder');

    // Arreglo para validar los campos
    const campos = {
        description: false,
        category: false,
        price: false,
        supplier: false,
        img: false,
    }

    // Arreglo de mensajes invalidos
    const mensajes = {
        description: 'Descripción requerida.',
        category: 'Categoria requerida,',
        price: 'Precio requerido.',
        supplier: 'Proveedor requerido.',
        img: 'Imagen requerida.',
    }

    // Arreglo de expresiones regulares para validación
    var expresiones = {
        price: /^(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/,
        img : /(\.jpg|\.jpeg|\.png)$/i,
    }

    const validarInputs = (e) => {
        switch (e.target.name) {
            case "price" :
                validarCampo(expresiones.price, e.target, 'price', 'El precio solo debe contener numeros, ser mayor a cero y no poseer más de dos decimales.');
                break;
            case "img":
                validarCampo(expresiones.img, e.target, 'img', 'Solo se permiten archivos de tipo .jpg, .jpeg y .png.');
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
            document.getElementById(`${campo}`).classList.remove('is-invalid'); 
            campos[campo] = true;
        }

        if(campos.description && campos.category && campos.price && campos.supplier && campos.img) {
            alertPlaceholder.classList.add('d-none');
        }else {
            alertPlaceholder.classList.remove('d-none');
        }
    }

    const validarTextArea = (e) => {
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

        if(campos.description && campos.category && campos.price && campos.supplier && campos.img) {
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
        if (input.name == 'img') {
            img.addEventListener('change', validarInputs);
        }else if (input.name == 'price'){
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
        if (!form.checkValidity() || !campos.description || !campos.category || !campos.price || !campos.supplier || !campos.img) {
            e.preventDefault();
            alert('Error: Por favor rellene el formulario correctamente.'); 

            if (textArea.value == "") {
                textArea.classList.add('is-invalid');

                document.getElementById('invalid-description').innerHTML = mensajes['description'];
            }

            selects.forEach((select) => {
                if (select.value == "") {
                    document.getElementById(`${select.name}`).classList.add('is-invalid');

                    document.getElementById(`invalid-${select.name}`).innerHTML = mensajes[select.name];
                }
            })

            inputs.forEach((input) => {
                if (input.value == "") {
                    document.getElementById(`${input.name}`).classList.add('is-invalid');

                    document.getElementById(`invalid-${input.name}`).innerHTML = mensajes[input.name];
                }
            })
        }   
    })

    $('#close-button').on('click', function() {
        alertPlaceholder.innerHTML = "";
        
        textArea.classList.remove('is-invalid');
        textArea.classList.remove('is-valid');
        document.getElementById(`invalid-description`).innerHTML = "";

        inputs.forEach((input) => {
            if (input.name == 'price' || input.name == 'img') {
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