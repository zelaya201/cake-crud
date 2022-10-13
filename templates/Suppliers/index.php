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
<div class="suppliers index content">
    <div class="row">
        <div class="col-md-9">
            <h3><?= __('Proveedores') ?></h3>
        </div>
        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="bi bi-person-plus me-2"></i>Nuevo Proveedor
            </button> 
        </div>
    </div>
    <div class="table-responsive">
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
<script>
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

                    console.log(data);
                    $('#id').val(data['supplier_id']);
                    $('#supplier-name').val(data['supplier_name']);
                    $('#supplier-address').val(data['supplier_address']);
                    $('#supplier-phone').val(data['supplier_phone']);
                    $('#supplier-email').val(data['supplier_email']);
                }

            })
        } /* FIN de editSupplierId() */

        $("#form-edit").on('submit',(function(e) {
            e.preventDefault();

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
        }));

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
                console.log(response);
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
</script>