<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Management;
use App\DataTables\ManagementDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ManagementController extends Controller
{
    public function index(ManagementDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.managements.index');
    }

    public function create()
    {
        $languages = Language::all();
        return view('backend.pages.managements.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('managements', 'public');
            }

            $management = new Management();
            $this->mainService->save($management, $data);
            $this->mainService->createTranslations($management, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.managements.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(Management $management)
    {
        $languages = Language::all();
        return view('backend.pages.managements.edit', compact('management', 'languages'));
    }

    public function update(Request $request, Management $management)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                if ($management->image && Storage::disk('public')->exists($management->image)) {
                    Storage::disk('public')->delete($management->image);
                }
                $data['image'] = $request->file('image')->store('managements', 'public');
            }

            $this->mainService->save($management, $data);
            $this->mainService->createTranslations($management, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.managements.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(Management $management)
    {
        try {
            DB::beginTransaction();

            if ($management->image && Storage::disk('public')->exists($management->image)) {
                Storage::disk('public')->delete($management->image);
            }

            $management->delete();
            DB::commit();

            return redirect()->route('admin.managements.index')
                ->with('success', 'Management member deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
