<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FaqsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BannerDetail;
use App\DataTables\BannerDetailDatatable;

class BannerDetailController extends Controller
{
    public function index(BannerDetailDatatable $dataTable)
    {
        return $dataTable->render('backend.pages.banner-details.index');
    }

    public function create()
    {
        $languages = Language::all();
        return view('backend.pages.banner-details.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $faq = new BannerDetail();
            $this->mainService->save($faq, $data);
            $this->mainService->createTranslations($faq, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.banner-details.index'));

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(BannerDetail $banner)
    {
        $languages = Language::all();
        return view('backend.pages.banner-details.edit', compact('banner', 'languages'));
    }

    public function update(Request $request, BannerDetail $banner)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $this->mainService->save($banner, $data);
            $this->mainService->createTranslations($banner, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.banner-details.index'));

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(BannerDetail $banner)
    {
        try {
            DB::beginTransaction();

            $banner->delete();

            DB::commit();
            return redirect()->route('admin.banner-details.index')
                ->with('success', 'Banner Detail deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
