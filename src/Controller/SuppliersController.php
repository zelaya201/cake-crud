<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Suppliers Controller
 *
 * @property \App\Model\Table\SuppliersTable $Suppliers
 * @method \App\Model\Entity\Supplier[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SuppliersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $supplier = $this->Suppliers->newEmptyEntity();
        $suppliers = $this->paginate($this->Suppliers);

        
        $this->set(compact('suppliers','supplier'));
    }

    /**
     * View method
     *
     * @param string|null $id Supplier id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $supplier = $this->Suppliers->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('supplier'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $supplier = $this->Suppliers->newEmptyEntity();
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            
            $supplier->supplier_name = $formData['name'];
            $supplier->supplier_address = $formData['address'];
            $supplier->supplier_phone = $formData['phone'];
            $supplier->supplier_email = $formData['email'];

            /* $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData()); */
            if ($this->Suppliers->save($supplier)) {
                $this->Flash->success(__('El proveedor se ha guardado con éxito.'));

                return $this->redirect(['action' => 'index']);
            }else {
                $this->Flash->error(__('El proveedor no se ha podido guardar. Por favor, intentelo de nuevo.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->set(compact('supplier'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Supplier id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formData = $this->request->getData();
            $supplier = $this->Suppliers->get($formData['id'], [
            'contain' => [],
            ]);

            $supplier->supplier_name = $formData['suppliername'];
            $supplier->supplier_address = $formData['supplieraddress'];
            $supplier->supplier_phone = $formData['supplierphone'];
            $supplier->supplier_email = $formData['supplieremail'];

            if ($this->Suppliers->save($supplier)) {
                $this->Flash->success(__('El proveedor ha sido modificado con éxito.'));

                return $this->redirect(['action' => 'index']);
            } else {
                
                $this->Flash->error(__('El proveedor no se ha podido modificar. Por favor, intentelo de nuevo.'));
                return $this->redirect(['action' => 'index']);
            }
            
        }
        $this->set(compact('supplier'));
    }


    public function findSupplierById($id = null) {
        if ($this->request->is('get')){
            $id = $this->request->getData('supplier_id');
        }
        $supplier = $this->Suppliers->get($id, [
            'contain' => [],
        ]);

        exit (json_encode($supplier));
    }

    /**
     * Delete method
     *
     * @param string|null $id Supplier id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supplier = $this->Suppliers->get($id);
        if ($this->Suppliers->delete($supplier)) {
            $this->Flash->success(__('El proveedor has sido eliminado correctamente.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('El proveedor no se ha podido eliminar. Por favor, intentelo otra vez.'));
            return $this->redirect(['action' => 'index']);
        }
        exit(json_encode($supplier));
        return $this->redirect(['action' => 'index']);
    }
}
