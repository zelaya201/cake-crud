<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 *
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('product_id');
        $this->setPrimaryKey('product_id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'product_category_id',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'product_supplier_id',
        ]);

        $this->addBehavior('Proffer.Proffer', [
            'product_img' => [	// The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'product_img_dir',	// The name of the field to store the folder
                'thumbnailSizes' => [ // Declare your thumbnails
                    'square' => [	// Define the prefix of your thumbnail
                        'w' => 300,	// Width
                        'h' => 300,	// Height
                        'fit' => true,
                        'jpeg_quality'	=> 100
                    ],
                ],
                'thumbnailMethod' => 'gd'	// Options are Imagick or Gd
            ]
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    /* public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('product_img')
            ->maxLength('product_img', 255)
            ->requirePresence('product_img', 'create'); 

        $validator
            ->scalar('product_description')
            ->maxLength('product_description', 255)
            ->requirePresence('product_description', 'create')
            ->notEmptyString('product_description', 'Por favor rellene este campo');

        $validator
            ->numeric('product_price')
            ->requirePresence('product_price', 'create')
            ->notEmptyString('product_price');

        $validator
            ->integer('product_stock')
            ->requirePresence('product_stock', 'create')
            ->notEmptyString('product_stock');

        $validator
            ->integer('product_category_id')
            ->allowEmptyString('product_category_id');

        $validator
            ->integer('product_supplier_id')
            ->allowEmptyString('product_supplier_id');

        return $validator;
    } */

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('product_category_id', 'Categories'), ['errorField' => 'product_category_id']);
        $rules->add($rules->existsIn('product_supplier_id', 'Suppliers'), ['errorField' => 'product_supplier_id']);

        return $rules;
    }
}
