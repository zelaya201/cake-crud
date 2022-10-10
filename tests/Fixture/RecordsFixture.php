<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RecordsFixture
 */
class RecordsFixture extends TestFixture
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
                'record_id' => 1,
                'record_date' => '2022-10-08 04:52:18',
                'record_description' => 'Lorem ipsum dolor sit amet',
                'record_quantity' => 1,
                'record_reference' => 'Lorem ipsum dolor sit amet',
                'record_product_id' => 1,
            ],
        ];
        parent::init();
    }
}
