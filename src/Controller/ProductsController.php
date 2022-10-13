<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Records; // Se agrega el controlador de Records

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 * @property \App\Model\Table\RecordsTable $Records
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */ 

    public function findProductById() {
        $id = $this->request->getData('product_id');

        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        exit (json_encode($product));
    }

    /**
     * AddStock method
     *
     * @param string|null $id Product id.
    */

    public function movingStock($id = null) {
        $Records = new RecordsController;
        
        $product = $this->Products->get($id, [
            'contain' => [],
        ]); 

        if ($this->request->is('post')) {
            $formData = $this->request->getData(); //Se obtienen los datos del formulario

            if ($formData['accion'] == "agregar") {
                $product->product_stock = intval($formData['quantity']) + $product->product_stock;
            }else if ($formData['accion'] == 'eliminar') {
                if ($product->product_stock >= intval($formData['quantity'])) {
                    $product->product_stock = $product->product_stock - intval($formData['quantity']);
                }else {
                    $this->Flash->error(__('Error: No existe el stock suficiente para eliminar.'));
                    return $this->redirect(['controller' => 'Products', 'action' => 'view', $product->product_id]);
                }
            }
            if ($this->Products->save($product)) {
                if ($Records->add($formData, $product->product_id)) {
                    if ($formData['accion'] == "agregar") {
                        $this->Flash->success(__('Se ha agregado a inventario correctamente.'));
                    }else if ($formData['accion'] == "eliminar") {
                        $this->Flash->success(__('Se ha eliminado de inventario correctamente.'));
                    }

                    return $this->redirect(['controller' => 'Products', 'action' => 'view', $product->product_id]);
                }
            }else {
                return $this->redirect(['controller' => 'Products', 'action' => 'view', $product->product_id]);
                
                $this->Flash->error(__('No se ha podido mover el inventario correctamente. Por favor, intente de nuevo.'));
            }
        }
    }

    public function index() {
        $this->paginate = [
            'contain' => ['Categories', 'Suppliers'],
        ];
        $products = $this->paginate($this->Products);

        $product = $this->Products->newEmptyEntity();

        $categories = $this->Products->Categories->find('list', ['limit' => 200])->all();
        $suppliers = $this->Products->Suppliers->find('list', ['limit' => 200])->all();

        $this->set(compact('product', 'products', 'categories', 'suppliers'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $this->loadModel('Records'); //Se carga el modelo de Records

        /* Se limita el tamaño de la paginación */

        $record = $this->Records->newEmptyEntity(); //Se setea el nuevo objeto
        $records = $this->paginate($this->Records->find('all', ['conditions' => ['Records.record_product_id' => $id]]), 
                            ['limit' => 8]); //Se traen todos los registros de records


        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'Suppliers'],
        ]);

        $categories = $this->Products->Categories->find('list', ['limit' => 200])->all();
        $suppliers = $this->Products->Suppliers->find('list', ['limit' => 200])->all();

        $this->set(compact('record', 'records', 'product', 'categories', 'suppliers'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $product = $this->Products->newEmptyEntity();
                                          
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            
            $product->product_category_id = $formData['category'];
            $product->product_supplier_id = $formData['supplier'];
            $product->product_img = $formData['img'];
            $product->product_description = $formData['description'];
            $product->product_price = $formData['price'];
            $product->product_stock = 0;

            if ($this->Products->save($product)) {
                $this->Flash->success(__('El producto ha sido agregado con éxito.'));

                return $this->redirect(['action' => 'index']);
            }else {
                $this->Flash->error(__('El producto no se ha podido agregar correctamente. Por favor, intente de nuevo.'));

                return $this->redirect(['action' => 'index']);
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $formData = $this->request->getData();

            $product->product_description = $formData['product_description'];
            $product->product_category_id = $formData['product_category_id'];
            $product->product_supplier_id = $formData['product_supplier_id'];
            $product->product_price = $formData['product_price'];
            
            if ($this->Products->save($product)) {
                $this->Flash->success(__('El producto ha sido modificado con éxito.'));

                return $this->redirect(['action' => 'view', $product->product_id]);
            }else {
                $this->Flash->error(__('El producto no se ha modificado correctamente. Por favor, intente de nuevo.'));
                
                return $this->redirect(['action' => 'view', $product->product_id]);
            }
        }

        $this->set(compact('product'));
    }

    public function editImage($id = null) {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $formData = $this->request->getData();

            $product->product_img = $formData['input-img'];
            
            if ($this->Products->save($product)) {
                $this->Flash->success(__('La imagen del producto ha sido modificada correctamente.'));

                return $this->redirect(['action' => 'view', $product->product_id]);
            }else {
                $this->Flash->error(__('No se ha podido modificar la imagen. Por favor, intente de nuevo.'));
                
                return $this->redirect(['action' => 'view', $product->product_id]);
            }
        }

        $this->set(compact('product'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('El producto ha sido eliminado correctamente.'));
        } else {
            $this->Flash->error(__('No se ha podido eliminar el producto. Por favor, intente de nuevo.'));
        }

        exit(json_encode($product));
        return $this->redirect(['action' => 'index']);
    }

    public function search() {
        $this->request->allowMethod('ajax');
   
        $keyword = $this->request->getData('keyword');

        $query = $this->Products->find('all',[
              'conditions' => ['product_description LIKE'=>'%'.$keyword.'%'],
              'order' => ['Products.product_id'=>'ASC']
        ]);

        $this->set('products', $this->paginate($query));
        $this->set('_serialize', ['products']); 
    }
}
