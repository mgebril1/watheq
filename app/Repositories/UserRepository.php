<?php

namespace App\Repositories;
use App\Models\User;
use App\Enums\UserTypeEnum;
use App\Models\Product;

class UserRepository{

	public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function create($data)
    {
        return User::create($data);
    }

    public function update($id, $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function getProductsByUserType()
    {

        $sqlExpression = 'CASE';
        
        foreach (UserTypeEnum::getInstances() as $key => $type) {
            $priceCounting = UserTypeEnum::getPriceCountingForType($type);
            $sqlExpression .= ' WHEN users.type = "'.$type.'" THEN products.price * '.$priceCounting;
            
        }
        $sqlExpression .= ' ELSE products.price END AS calculated_price';

        // Retrieve the products with the calculated price based on user type
        $products = Product::select('products.*', \DB::raw($sqlExpression))
            ->join('users', 'products.user_id', '=', 'users.id')
            ->get();

        return $products;
    }

}

?>