<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\MobilProgram;
use App\DataTables\MobilProgramDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MobilProgramController extends Controller
{
    public function index(MobilProgramDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.mobil_programs.index');
    }

    public function create()
    {
        $languages = Language::all();
        return view('backend.pages.mobil_programs.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('mobil_programs', 'public');
            }

            $mobilProgram = new MobilProgram();
            $this->mainService->save($mobilProgram, $data);
            $this->mainService->createTranslations($mobilProgram, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.mobil_programs.index'));

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(MobilProgram $mobilProgram)
    {
        $languages = Language::all();
        return view('backend.pages.mobil_programs.edit', compact('mobilProgram', 'languages'));
    }

    public function update(Request $request, MobilProgram $mobilProgram)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                if ($mobilProgram->image && Storage::disk('public')->exists($mobilProgram->image)) {
                    Storage::disk('public')->delete($mobilProgram->image);
                }
                $data['image'] = $request->file('image')->store('mobil_programs', 'public');
            }

            $this->mainService->save($mobilProgram, $data);
            $this->mainService->createTranslations($mobilProgram, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.mobil_programs.index'));

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(MobilProgram $mobilProgram)
    {
        try {
            DB::beginTransaction();

            if ($mobilProgram->image && Storage::disk('public')->exists($mobilProgram->image)) {
                Storage::disk('public')->delete($mobilProgram->image);
            }

            $mobilProgram->delete();
            DB::commit();

            return redirect()->route('admin.mobil_programs.index')
                ->with('success', 'Mobil Program deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
