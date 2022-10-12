<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $product_id
 * @property string $product_img
 * @property string|null $product_img_dir
 * @property string $product_description
 * @property float $product_price
 * @property int $product_stock
 * @property int $product_status
 * @property int|null $product_category_id
 * @property int|null $product_supplier_id
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Supplier $supplier
 */
class Product extends Entity
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
        'product_img' => true,
        'product_img_dir' => true,
        'product_description' => true,
        'product_price' => true,
        'product_stock' => true,
        'product_category_id' => true,
        'product_supplier_id' => true,
        'category' => true,
        'supplier' => true,
    ];
}
