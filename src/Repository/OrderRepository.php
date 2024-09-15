<?php
namespace App\Repository;

use App\DB\DB;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use PDO;

class OrderRepository 
{
    public function getUserOrders(int $userId) : array
    {
        $sqlQuery = "
            select u.first_name, u.second_name, p.title, p.price from user_order uo 
            left join user u on uo.user_id = u.id 
            left join products p on uo.product_id = p.id
            where uo.user_id = :userId
            ORDER by p.title ASC, p.price DESC
        ";

        $sth = DB::get($sqlQuery);

        $sth->bindParam('userId', $userId, PDO::PARAM_INT);
        $sth->execute();
        
        $sthResult = $sth->fetchAll();

        $result = [];

        foreach ($sthResult as $res) {
            $user = new User();
            $user->setFirstName($res['first_name']);
            $user->setSecondName($res['second_name']);

            $order = new Order();
            $order->setUser($user);
            
            $product = new Product();

            $product->setTitle($res['title']);
            $product->setPrice($res['price']);

            $order->setProduct($product);

            $result[] = $order;
        }

        return $result;
    }
}
