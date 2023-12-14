<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponseHelper;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    use ApiResponseHelper;

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();
        return $this->setData($products)->send();
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        return $this->setData($product)->send();
    }

    public function store(ProductStoreRequest $request)
    {
        $product = $this->productRepository->create($request->all());

        return $this->setSuccess('Product Created !')->setData($product)->send();
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = $this->productRepository->update($id, $request->all());

        return $this->setSuccess('Product Updated !')->setData($product)->send();
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);

        return $this->setCode(204)->setSuccess('Product Deleted !')->setData($product)->send();
    }
}
