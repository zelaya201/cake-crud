<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Record Entity
 *
 * @property int $record_id
 * @property \Cake\I18n\FrozenTime $record_date
 * @property string $record_description
 * @property int $record_quantity
 * @property string|null $record_reference
 * @property int|null $record_product_id
 *
 * @property \App\Model\Entity\Product $product
 */
class Record extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'record_date' => true,
        'record_description' => true,
        'record_quantity' => true,
        'record_reference' => true,
        'record_product_id' => true,
        'product' => true,
    ];
}
