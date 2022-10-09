<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <?= $this->Html->css(['BootstrapUI.bootstrap.min']) ?>
    <?= $this->Html->script(['BootstrapUI.bootstrap.min.js']) ?>
    
    

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
       <!-- <nav class="bg-dark text-light">
            <div class="container">
                <header class="d-flex flex-wrap justify-content-center py-2 mb-4 text-light">
                <!-- Linkeo entre paginas -->
                <!-- <?= $this->Html->link('CRUD Inventario', 
                                    ['controller' => 'Products', 'action' => 'index'],
                                    ['class' => 'd-flex align-items-center mb-3 mb-md-0 
                                    me-md-auto text-decoration-none fs-4 text-light']) ?> --> 
                <!-- Esto seria equivalente en HTML a: -->
                <!-- <a href="/Views/Index" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none"> -->
                
                <!-- <ul class="nav nav-pills">
                    <li class="nav-item">
                        <?= $this->Html->link('Inventario', 
                                        ['controller' => 'Products', 'action' => 'index'],
                                        ['class' => 'nav-link active']) ?>
                    </li>                
                </ul>
                </header>
            </div>
        </nav>  -->
        
        <header>
    <div class="px-3 py-1 bg-dark mb-4">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <?= $this->Html->link('<i class="bi bi-box-seam me-3"></i>Inventario', 
                                    ['controller' => 'Products', 'action' => 'index'],
                                    ['class' => 'd-flex align-items-center mb-3 mb-md-0 
                                    me-md-auto text-decoration-none fs-4 text-light', 'escape' => false]) ?>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
                <?= $this->Html->link('<i class="bi bi-boxes me-2"></i>Productos', 
                                    ['controller' => 'Products', 'action' => 'index'],
                                    ['class' => 'nav-link text-white mt-2 mb-1', 'escape' => false]) ?>
            </li>
            <li>
                <?= $this->Html->link('<i class="bi bi-people me-2"></i>Proveedores', 
                                    ['controller' => 'Suppliers', 'action' => 'index'],
                                    ['class' => 'nav-link text-white mt-2 mb-1', 'escape' => false]) ?>
            </li>
            <li>
                <?= $this->Html->link('<i class="bi bi-grid me-2"></i>Categorías', 
                                    ['controller' => 'Categories', 'action' => 'index'],
                                    ['class' => 'nav-link text-white mt-2 mb-1', 'escape' => false]) ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
  </header>
    
    
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
