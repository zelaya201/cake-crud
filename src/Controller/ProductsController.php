<?php
declare(strict_types=1);

namespace App\Controller;

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

    public function movingStock($id = null, $quantity, $action) {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]); 
        
        if ($action == 'agregar') {
            $product->product_stock = intval($quantity) + $product->product_stock;
        }else if ($action == 'eliminar') {
            $product->product_stock = $product->product_stock - intval($quantity);
        }

        if ($this->Products->save($product)) {
            return true;
        }else {
            return false;
        }

        //exit (json_encode($product->product_stock));

    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Suppliers'],
        ];
        $products = $this->paginate($this->Products);

        $product = $this->Products->newEmptyEntity();

        $categories = $this->Products->Categories->find('list', ['limit' => 200])->all();
        $suppliers = $this->Products->Suppliers->find('list', ['limit' => 200])->all();

        $this->set(compact('product', 'products', 'categories', 'suppliers'));
        //$this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Records'); //Se carga el modelo de Records

        /* Se limita el tamaño de la paginación */
        $this->paginate = [
            'limit' => 8,
        ];

        $record = $this->Records->newEmptyEntity(); //Se setea el nuevo objeto
        $records = $this->paginate($this->Records); //Se traen todos los registros de records


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
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
                                          
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            
            $product->product_category_id = $formData['category'];
            $product->product_supplier_id = $formData['supplier'];
            $product->product_img = $formData['img'];
            $product->product_description = $formData['description'];
            $product->product_price = $formData['price'];
            $product->product_stock = $formData['stock'];
            $product->product_status = $formData['status'];
            //$product = $this->Products->patchEntity($product, $this->request->getData());

            if ($this->Products->save($product)) {
                $this->Flash->success(__('El producto se ha guardado con exito.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('El producto no se pudo guardar. Por favor, vuelva a intentar.'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
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
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'view', $product->product_id]);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function search()
    {

        $this->request->allowMethod('ajax');
   
        $keyword = $this->request->getData('keyword');

        

        $query = $this->Products->find('all',[
              'conditions' => ['product_description LIKE'=>'%'.$keyword.'%'],
              'order' => ['Products.product_id'=>'DESC']
        ]);

        $this->set('products', $this->paginate($query));
        $this->set('_serialize', ['products']); 

    }
}
