<?php

namespace App\Service;

use App\DB\DB;

class ProductService
{
    public function createProduct(array $products): bool
    {
        if (!$products) {
            return false;
        }

        $sql = 'INSERT INTO products(title, price) VALUES';

        $bindParams = [];
        
        foreach ($products as $key => $product) {
            $bindParams[$key .'titile'] = $product['title'];
            $bindParams[$key .'price'] = $product['price'];
            
            $sql.= "(:" . $key .'titile,' . ':' . $key .'price)';

            if ($key !== count($products) -1) {
               $sql .= ',';
            }
        }

       return DB::store($sql)->execute($bindParams);
    }
}
