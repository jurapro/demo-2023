<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $date
 * @property string $name
 * @property string|null $file
 * @property int|null $count
 * @property float|null $price
 * @property int|null $year
 * @property string|null $model
 * @property string|null $country
 * @property int|null $category_id
 *
 * @property Cart[] $carts
 * @property Category $category
 * @property ProductOrder[] $productOrders
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['name'], 'required'],
            [['count', 'year', 'category_id'], 'integer'],
            [['price'], 'number'],
            [['name', 'file', 'model', 'country'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'name' => 'Наименование товара',
            'file' => 'Фото',
            'count' => 'Количество',
            'price' => 'Цена',
            'year' => 'Год выпуска',
            'model' => 'Модель',
            'country' => 'Страна-производитель',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[ProductOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrders()
    {
        return $this->hasMany(ProductOrder::class, ['product_id' => 'id']);
    }
}
