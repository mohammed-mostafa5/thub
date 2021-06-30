<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateProductSizeRequest;
use App\Http\Requests\AdminPanel\UpdateProductSizeRequest;
use App\Repositories\AdminPanel\ProductSizeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProductSizeController extends AppBaseController
{
    /** @var  ProductSizeRepository */
    private $productSizeRepository;

    public function __construct(ProductSizeRepository $productSizeRepo)
    {
        $this->productSizeRepository = $productSizeRepo;
    }

    /**
     * Display a listing of the ProductSize.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $productSizes = $this->productSizeRepository->all();

        return view('adminPanel.product_sizes.index')
            ->with('productSizes', $productSizes);
    }

    /**
     * Show the form for creating a new ProductSize.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.product_sizes.create');
    }

    /**
     * Store a newly created ProductSize in storage.
     *
     * @param CreateProductSizeRequest $request
     *
     * @return Response
     */
    public function store(CreateProductSizeRequest $request)
    {
        $input = $request->all();

        $productSize = $this->productSizeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/productSizes.singular')]));

        return redirect(route('adminPanel.productSizes.index'));
    }

    /**
     * Display the specified ProductSize.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productSize = $this->productSizeRepository->find($id);

        if (empty($productSize)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productSizes.singular')]));

            return redirect(route('adminPanel.productSizes.index'));
        }

        return view('adminPanel.product_sizes.show')->with('productSize', $productSize);
    }

    /**
     * Show the form for editing the specified ProductSize.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productSize = $this->productSizeRepository->find($id);

        if (empty($productSize)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productSizes.singular')]));

            return redirect(route('adminPanel.productSizes.index'));
        }

        return view('adminPanel.product_sizes.edit')->with('productSize', $productSize);
    }

    /**
     * Update the specified ProductSize in storage.
     *
     * @param int $id
     * @param UpdateProductSizeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductSizeRequest $request)
    {
        $productSize = $this->productSizeRepository->find($id);

        if (empty($productSize)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productSizes.singular')]));

            return redirect(route('adminPanel.productSizes.index'));
        }

        $productSize = $this->productSizeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/productSizes.singular')]));

        return redirect(route('adminPanel.productSizes.index'));
    }

    /**
     * Remove the specified ProductSize from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productSize = $this->productSizeRepository->find($id);

        if (empty($productSize)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productSizes.singular')]));

            return redirect(route('adminPanel.productSizes.index'));
        }

        $this->productSizeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/productSizes.singular')]));

        return redirect(route('adminPanel.productSizes.index'));
    }
}
