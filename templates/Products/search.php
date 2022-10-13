<div class="row">
    <?php 
        if (sizeof($products) > 0) {
            foreach ($products as $product): ?>
            
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
        <?php }else {?>
            <strong class="mb-3">No se han encontrado resultados</strong>
            <?php } ?> 
</div>
