<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\CompanyAbout;
use App\DataTables\CompanyAboutDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyAboutController extends Controller
{
    public function index(CompanyAboutDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.company_abouts.index');
    }

    public function create()
    {
        $languages = Language::all();
        return view('backend.pages.company_abouts.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('company_abouts', 'public');
            }

            $companyAbout = new CompanyAbout();
            $this->mainService->save($companyAbout, $data);
            $this->mainService->createTranslations($companyAbout, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.company_abouts.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(CompanyAbout $companyAbout)
    {
        $languages = Language::all();
        return view('backend.pages.company_abouts.edit', compact('companyAbout', 'languages'));
    }

    public function update(Request $request, CompanyAbout $companyAbout)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                if ($companyAbout->image && Storage::disk('public')->exists($companyAbout->image)) {
                    Storage::disk('public')->delete($companyAbout->image);
                }
                $data['image'] = $request->file('image')->store('company_abouts', 'public');
            }

            $this->mainService->save($companyAbout, $data);
            $this->mainService->createTranslations($companyAbout, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.company_abouts.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(CompanyAbout $companyAbout)
    {
        try {
            DB::beginTransaction();

            if ($companyAbout->image && Storage::disk('public')->exists($companyAbout->image)) {
                Storage::disk('public')->delete($companyAbout->image);
            }

            $companyAbout->delete();
            DB::commit();

            return redirect()->route('admin.company_abouts.index')
                ->with('success', 'Company About deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
