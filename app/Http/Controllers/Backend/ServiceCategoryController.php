<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ServiceCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ServiceCategoryDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.service-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.service-category.create', [
            'category' => null,
            'translations' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
            'name' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $category = ServiceCategory::create([
                'status' => $request->status,
            ]);

            foreach ($request->name ?? [] as $locale => $name) {
                $category->translations()->create([
                    'locale' => $locale,
                    'name' => $name,
                ]);
            }
        });

        $message = 'Kategoriya yaradıldı.';

        if ($request->ajax()) {
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.service-category.index'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceCategory $category)
    {
        $languages = config('app.languages');
        $translations = $category->translations->keyBy('locale');

        return view('backend.pages.service-category.edit', [
            'languages' => $languages,
            'serviceCategory' => $category,
            'translations' => $translations
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceCategory $category)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
            'name' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $category) {
            $category->update([
                'status' => $request->status,
            ]);

            foreach ($request->name ?? [] as $locale => $name) {
                $translation = $category->translations()->where('locale', $locale)->first();
                if ($translation) {
                    $translation->update(['name' => $name]);
                } else {
                    $category->translations()->create([
                        'locale' => $locale,
                        'name' => $name,
                    ]);
                }
            }
        });

        return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.service-category.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ServiceCategory $category)
    {
        try {
            $category->delete();

            if ($request->ajax()) {
                return $this->responseMessage('success', 'Kategoriya silindi.', [], 200);
            }

            return redirect()
                ->route('admin.service-category.index')
                ->with('success', 'Kategoriya silindi.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return $this->responseMessage('error', 'Xəta baş verdi: ' . $e->getMessage(), [], 500);
            }

            return redirect()
                ->route('admin.service-category.index')
                ->with('error', 'Silinmə zamanı xəta baş verdi.');
        }
    }

}
