<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $suppliers
 */
include 'add.php';
include 'edit.php';
?>
<script>
        /* function editProductId(product_id) {
            event.preventDefault();
            parameters = {
                'product_id': product_id
            }

            $.ajax({
                data: parameters,
                url:'<?= $this->Url->build(['controller' => 'Products', 'action' => 'findProductById' ]) ?>',
                type: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                beforeSend: function(){},
                success: function(response) {
                    data = $.parseJSON(response);

                    console.log(data);
                    $('#id-edit').val(data['product_id']);
                    $('#description-edit').val(data['product_description']);
                    $('#category-edit').val(parseInt(data['product_category_id']));
                    $('#price-edit').val(data['product_price']);
                    $('#supplier-edit').val(parseInt(data['product_supplier_id']));
                    $('#stock-edit').val(parseInt(data['product_stock']));
                    $('#status-edit').val(parseInt(data['product_status']));
                }
                
            })
        }

        $("#form-edit").on('submit',(function(e) {
            e.preventDefault();

            id = $('#id-edit').val();

            parameters = {
                'formData': new FormData(this),
                'product_id': $('#id-edit').val(),
            }

            $.ajax({
                url: '<?= $this->Url->build(['controller' => 'Products', 'action' => 'edit', $product->product_id]) ?>',
                type: 'POST',
                data: new FormData(this),
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                cache : false,
                processData: false,
                contentType: false,
                beforeSend: function(){},
                success: function(response) {
                    if (response) {
                        window.location = "/products/";
                    }
                }

            })
        }));    */
</script>

<div class="products index content">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
        Nuevo Producto
    </button>

    <h3><?= __('Productos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Id') ?></th>
                    <th><?= $this->Paginator->sort('Imagen') ?></th>
                    <th><?= $this->Paginator->sort('Descripción') ?></th>
                    <th><?= $this->Paginator->sort('Precio') ?></th>
                    <th><?= $this->Paginator->sort('Stock') ?></th>
                    <th><?= $this->Paginator->sort('Estado') ?></th>
                    <th><?= $this->Paginator->sort('Categoria') ?></th>
                    <th><?= $this->Paginator->sort('Proveedor') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $this->Number->format($product->product_id) ?></td>
                    <td><?= h($product->product_img) ?></td>
                    <td><?= h($product->product_description) ?></td>
                    <td><?= $this->Number->format($product->product_price) ?></td>
                    <td><?= $this->Number->format($product->product_stock) ?></td>
                    <td><?= $this->Number->format($product->product_status) ?></td>
                    <td><?= $product->has('category') ? $product->category->category_name : '' ?></td>
                    <td><?= $product->has('supplier') ? $product->supplier->supplier_name : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $product->product_id]) ?>
                        <?php echo('<a href="#"  data-bs-toggle="modal" data-bs-target="#editModal" onclick="editProductId(\'' . $product->product_id . '\')">
                                        Editar
                                    </a>'
                            
                        ); ?>
                        <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $product->product_id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->product_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>

</div>
