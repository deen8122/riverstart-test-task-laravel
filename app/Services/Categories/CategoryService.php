<?php


namespace App\Services\Categories;


use App\Models\Category;
use App\Models\ProductCategory;
use Exception;

class CategoryService
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
            Category::create($data);
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
    public function update(int $categoryId, array $data): bool
    {
        print_r($categoryId);
        $category = Category::find($categoryId);
        if (!$category) {
            return false;
        }
        $category->fill(array_filter($data));
        $category->save();
        return true;
    }



    /**
     * Удаление
     *
     * @param int $categoryId
     * @return bool
     */
    public function delete(int $categoryId): bool
    {
        /*
         * Если у категории есть связанные товары
         * запрещаем удалять
         */
        if($count = ProductCategory::where('category_id',$categoryId)->count()){
            $this->errors[] = "У данной категории {$categoryId} есть товары: ".$count;
            return false;
        }
        /*
         * Если нет связанных товаров то удаляем категорию
         */
        $category =  Category::findOrFail($categoryId);
        $category->delete();
        return true;
    }


}
