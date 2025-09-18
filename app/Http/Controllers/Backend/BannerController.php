<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Language;
use App\Helpers\FileUploadHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->mainService->model = Banner::class;
    }

    public function index()
    {
        $item = Banner::first();
        if (is_null($item)) {
            $item = Banner::create([]);
        }
        $languages = Language::all();
        return view('backend.pages.banner.index', compact('item', 'languages'));
    }

    public function update(Request $request, Banner $item)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token', '_method');
            $item = $this->mainService->save($item, $data);
            $this->mainService->createTranslations($item, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişdirildi', [], 200, route('admin.banner.index'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseMessage('error', $exception->getMessage(), [], 500);
        }
    }
}
