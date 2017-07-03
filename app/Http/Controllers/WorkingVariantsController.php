<?php

namespace App\Http\Controllers;

use App\Models\WorkingVariant;
use Illuminate\Http\Request;

/**
 * Class WorkingVariantsController
 * @package App\Http\Controllers
 */
class WorkingVariantsController extends Controller
{
    /**
     * @var WorkingVariant
     */
    private $variant;

    /**
     * WorkingVariantsController constructor.
     * @param WorkingVariant $variant
     */
    public function __construct(WorkingVariant $variant)
    {
        $this->variant = $variant;
    }

    /**TODO implement variants count show in admin
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $variants = $this->variant->all()->take(10)->toArray();
        return response()->json($variants);
    }
}
