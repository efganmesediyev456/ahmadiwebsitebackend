<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyAboutPage;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyAboutPageController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->mainService->model = CompanyAboutPage::class;
    }

    public function index()
    {
        $item = CompanyAboutPage::first();
        if (is_null($item)) {
            $item = CompanyAboutPage::create([]);
        }
        $languages = Language::all();
        return view('backend.pages.company_about.index', compact('item', 'languages'));
    }

    public function update(Request $request, CompanyAboutPage $item)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method');
            $item = $this->mainService->save($item, $data);
            $this->mainService->createTranslations($item, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişdirildi', [], 200, route('admin.company_about.index'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseMessage('error', $exception->getMessage(), [], 500);
        }
    }
}
