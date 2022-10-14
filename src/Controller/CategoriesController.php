<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client\FormData;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $category = $this->Categories->newEmptyEntity();
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories','category'));
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('category'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEmptyEntity();
        if ($this->request->is('post')) {
            $formData = $this->request->getData();
            $category->category_name = $formData['name'];
            /* $category = $this->Categories->patchEntity($category, $this->request->getData()); */
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('La categoría ha sido guardada con éxito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $this->set(compact('category'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
    
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formData = $this->request->getData();
            
            $category = $this->Categories->get($formData['id'], [
                'contain' => [],
                ]);

            $category->category_name = $formData['categoryname'];

            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
                return $this->redirect(['action' => 'index']);
            }
            
        }
        $this->set(compact('category'));
    }

    public function findCategoryById($id = null) {
        if ($this->request->is('get')){
            $id = $this->request->getData('category_id');
        }
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);

        exit (json_encode($category));
    }


    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

        exit(json_encode($category));
        return $this->redirect(['action' => 'index']);
    }
}
