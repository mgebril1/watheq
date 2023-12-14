<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Traits\ApiResponseHelper;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    use ApiResponseHelper;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return $this->setData($users)->send();
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        return $this->setData($user)->send();
    }

    public function store(UserStoreRequest $request)
    {
        $user = $this->userRepository->create($request->all());
        return $this->setSuccess('User Created !')->setData($user)->send();
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userRepository->update($id, $request->all());
        return $this->setSuccess('User Updated !')->setData($user)->send();
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return $this->setCode(204)->setSuccess('User Deleted !')->setData($product)->send();
    }

    public function getProductsByUserType()
    {
        $products = $this->userRepository->getProductsByUserType();
        return $this->setData($products)->send();
    }
}
