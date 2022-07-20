<?php

namespace App\Filters;

class ProductFilter extends QueryFilter{


    public function category_name($categoryName){
        return $this->builder->whereHas('categories', function($q) use ($categoryName)
        {
            $q->where('name', 'LIKE', '%'.$categoryName.'%');

        });
    }


    public function price_min($price_min){
        return $this->builder->where('price', '>=',$price_min);
    }

    public function published($published){
        $published = $published?1:0;
        return $this->builder->where('published', $published);
    }

    public function price_max($price_min){
        return $this->builder->where('price', '<=',$price_min);
    }

    public function search($search_string = ''){
        return $this->builder
            ->where('name', 'LIKE', '%'.$search_string.'%');
    }
}
