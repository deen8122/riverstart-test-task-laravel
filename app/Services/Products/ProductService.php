<?php


namespace App\Services\Products;


use App\Models\Client\ClientEvent;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;

class ProductService
{

    public array $errors = [];

    /**
     * Сохранение
     *
     * @param array $data
     * @return bool
     */
    public function save(array $data): bool
    {

        try {
            $product = Product::create($data);
            $this->createProductCategoryRelation($product->id, $data['category_id']);
            return true;
        } catch (Exception $exception) {
            $this->errors[] = $exception->getMessage();
            return false;
        }
    }


    /**
     * Обновление
     *
     * @param array $data
     * @return bool
     */
    public function update(int $productId, array $data): bool
    {
        print_r($data);
        $product = $this->getProductById($productId);
        if (!$product) {
            return false;
        }
        $product->fill(array_filter($data));
        $product->save();
        ProductCategory::where('product_id', $productId)->delete();
        $this->createProductCategoryRelation($product->id, $data['category_id']);
        return true;
    }

    /*
    *
    * @param int $id
    * @return Product|null
    */
    private function getProductById(int $id):Product|null
    {
        $product = Product::find($id);
        if (!$product) {
            $this->errors[] = "Продукт с id = " . $id . " не найден";
            return null;
        }
        return $product;
    }

    /*
  *
     * Удаление
  * @param int $id
  */
    public function delete(int $id): bool
    {
        $product = $this->getProductById($id);
        if ($product) {
            $product->delete();
            return true;
        } else {
            return false;
        }

    }

    /**
     * Создание связи с категориями
     *
     * @param int $productId
     * @param array $categoryIds
     * @return bool
     */
    private function createProductCategoryRelation(int $productId, array $categoryIds)
    {
        $arTempt = [];
        foreach ($categoryIds as $categoryId) {
            $arTempt[] = [
                'category_id' => $categoryId,
                'product_id' => $productId
            ];
        }
        ProductCategory::insert($arTempt);
    }
}
