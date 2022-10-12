<div class="row">
    <?php foreach ($products as $product): ?>
        <div class="col-md-3" >
            <div class="card" >
                
                <article class="well">
                    
                    <?= $this->Html->image('../files/products/product_img/' . $product->product_img_dir . '/square_' . $product->product_img, ['alt' => $product->product_description, 'class' => 'bd-placeholder-img card-img-top']) ?>
                    <div class="card-body">
                        <strong><?= h($product->product_description) ?></strong>
                        <br>
                        <strong>Precio: </strong> <?= h($product->product_price) ?>
                        <br>

                        
                        <?= $this->Html->link('Ver producto', ['controller' => 'Products', 'action' => 'view', $product->product_id],
                            ['class' => 'btn btn-sm btn-success']) ?>
                        
                    
                    </div>
                </article>
            
            </div>
            <br><br>
        </div>
    <?php endforeach; ?>
</div>