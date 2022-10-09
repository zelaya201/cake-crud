<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \App\Model\Entity\Record $record
 * @var iterable<\App\Model\Entity\Record> $records
 */
include 'stock-modal.php';
?>
<!-- <div class="row">
    <div class="column-responsive column-80">
        <div class="products view content">
            <h3><?= h($product->product_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product Img') ?></th>
                    <td><?= h($product->product_img) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Description') ?></th>
                    <td><?= h($product->product_description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= $product->has('category') ? $this->Html->link($product->category->category_id, ['controller' => 'Categories', 'action' => 'view', $product->category->category_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Supplier') ?></th>
                    <td><?= $product->has('supplier') ? $this->Html->link($product->supplier->supplier_id, ['controller' => 'Suppliers', 'action' => 'view', $product->supplier->supplier_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Id') ?></th>
                    <td><?= $this->Number->format($product->product_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Price') ?></th>
                    <td><?= $this->Number->format($product->product_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Stock') ?></th>
                    <td><?= $this->Number->format($product->product_stock) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Status') ?></th>
                    <td><?= $this->Number->format($product->product_status) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div> -->
<script>
    /* Lanzar modal y cambiarle titulo segun la acción */
    $('#stockModal').on('show.bs.modal', function (accion) {
        const btns = document.querySelectorAll('button[id^="stock-"]'); // Se traen los botones
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

    /* */
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
</script>
<div class="container" style="border: 1px solid #DEE2E6; border-radius: 8px;">
    <div class="row">
        <div class="col-md-12">
            <div class="row mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <?= $this->Html->image('../files/products/product_img/' . $product->product_img_dir . '/square_' . $product->product_img,
                                            ['alt' => $product->product_description, 'class' => 'img-responsive img-thumbnail center-block']) ?>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-5">
                            <h4 style="margin: 0;">
                                <?php echo (h($product->product_description)) ?>
                            </h4>
                        </div>
                        <div class="col-md-7">
                            
                        </div>
                    </div>
                    
                    
                    <label class="fw-light fs-4" style="margin: 0;">
                        $<?= $this->Number->format($product->product_price) ?>
                    </label>
                    
                    <br>
                    <label class="fs-5">Stock disponible</label><br>
                    <label class="fw-bold fs-4"><?= $this->Number->format($product->product_stock) ?></label>                 
                    <br>
                    <span class="badge bg-success" style="margin:0;">
                                <i class="bi bi-grid me-2"></i>
                                <?= $product->has('category') ? $product->category->category_name : '' ?>
                            </span>
                            <span class="badge bg-info" style="margin:0;">
                                <i class="bi bi-grid me-2"></i>
                                <?= $product->has('supplier') ? $product->supplier->supplier_name : '' ?>
                            </span><br><br>
                    <button id="stock-add" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stockModal">
                        Agregar stock
                    </button>
                    <button id='stock-delete' type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stockModal">
                        Eliminar stock
                    </button>
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
                    <?php foreach ($records as $record): 
                        if($record->record_product_id == $product->product_id) {
                            $fecha = $record->record_date->format('d/m/Y'); // Se obtiene la fecha
                            $hora = $record->record_date->format('g:i:s A'); // Se obtiene la hora ?>
                            <tr>
                                <td><?= h($fecha) ?></td>
                                <td><?= h($hora) ?></td>
                                <td><?= h($record->record_description) ?></td>
                                <td><?= $this->Number->format($record->record_quantity) ?></td>
                                <td><?= h($record->record_reference) ?></td>
                            </tr>
                    <?php } endforeach; ?>
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

