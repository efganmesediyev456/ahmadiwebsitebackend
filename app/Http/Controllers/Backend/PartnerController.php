<?php 
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Partner;
use App\DataTables\PartnerDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index(PartnerDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.partners.index');
    }

    public function create()
    {
        $languages = Language::all();
        return view('backend.pages.partners.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('partners', 'public');
            }

            $partner = new Partner();
            $this->mainService->save($partner, $data);
            $this->mainService->createTranslations($partner, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.partners.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(Partner $partner)
    {
        $languages = Language::all();
        return view('backend.pages.partners.edit', compact('partner', 'languages'));
    }

    public function update(Request $request, Partner $partner)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                    Storage::disk('public')->delete($partner->image);
                }
                $data['image'] = $request->file('image')->store('partners', 'public');
            }

            $this->mainService->save($partner, $data);
            $this->mainService->createTranslations($partner, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.partners.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(Partner $partner)
    {
        try {
            DB::beginTransaction();

            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }

            $partner->delete();
            DB::commit();

            return redirect()->route('admin.partners.index')
                ->with('success', 'Partner deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
