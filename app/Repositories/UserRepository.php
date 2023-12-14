<?php

namespace App\Repositories;
use App\Models\User;

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

    public function getProductsByUserType($user)
    {
        $products = Product::all();

        // Apply different prices based on user type
        switch ($user->type) {
            case 'normal':
                // Apply normal user pricing logic
                break;
            case 'gold':
                // Apply gold user pricing logic
                break;
            case 'silver':
                // Apply silver user pricing logic
                break;
        }

        return $products;
    }

}

?>