<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 */
class ProductsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'product_id' => 1,
                'product_img' => 'Lorem ipsum dolor sit amet',
                'product_img_dir' => 'Lorem ipsum dolor sit amet',
                'product_description' => 'Lorem ipsum dolor sit amet',
                'product_price' => 1,
                'product_stock' => 1,
                'product_status' => 1,
                'product_category_id' => 1,
                'product_supplier_id' => 1,
            ],
        ];
        parent::init();
    }
}
