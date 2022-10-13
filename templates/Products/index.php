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

<div class="container mb-4" style="border: 1px solid #DEE2E6; border-radius: 8px;">
    <div class="row mt-3 ms-3 me-3">
        <div class="row mb-2" >
            <div class="panel-heading col-md-9 mt-1">
                <h4><?= __('Productos') ?></h4>
            </div>
            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus me-1"></i> Nuevo Producto
                </button> 
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-4 fw-bold">
                <label style="font-size: 15px;" class="mb-1">Filtrar por descripción</label>
                <?= $this->Form->control('Buscar', ['style' => 'height: 35px; font-size:15px', 'label' => false, 'placeholder' => 'Descripción del producto']);?>
            </div>             
        </div>
        <hr style="color: #c4c8cc;">
        <div class="table-content mt-2">
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3" >
                        <div class="card" >
                            <article class="well">
                                <?= $this->Html->image('../files/products/product_img/' . $product->product_img_dir . '/square_' . $product->product_img, ['alt' => $product->product_description, 'class' => 'bd-placeholder-img card-img-top']) ?>
                                <div class="card-body">
                                    <strong><?= h($product->product_description) ?></strong>
                                    <br>
                                    <strong>Precio: </strong> $<?= h(number_format($product->product_price, 2)) ?> 
                                    <br>
                                    <?= $this->Html->link('Ver producto', ['controller' => 'Products', 'action' => 'view', $product->product_id],
                                        ['class' => 'btn btn-sm btn-primary mt-2']) ?>
                                </div>
                            </article>
                        
                        </div>
                        <br><br>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
        </div>

    </div>
</div>

<script>
    $('document').ready(function(){
         $('#buscar').keyup(function(){
            var searchkey = $(this).val();
            search(searchkey);
         });

        function search( keyword ){
            var data = new FormData();
            data.append('keyword', keyword);
            $.ajax({
                type: 'post',
                url : "<?php echo $this->Url->build( [ 'controller' => 'Products', 'action' => 'search'] ); ?>",
                data: data,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                cache : false,
                processData: false,
                contentType: false,
                success: function(response) {
                    $( '.table-content' ).html(response);
                }
            });
        };
    });
</script>