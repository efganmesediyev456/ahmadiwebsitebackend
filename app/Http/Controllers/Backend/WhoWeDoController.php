<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\WhoWeDo;
use App\DataTables\WhoWeDoDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhoWeDoController extends Controller
{
    public function index(WhoWeDoDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.whoWeDo.index');
    }

    public function create()
    {
        $languages = Language::all();
        return view('backend.pages.whoWeDo.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $whoWeDo = new WhoWeDo();
            $this->mainService->save($whoWeDo, $request->except('_token', '_method'));
            $this->mainService->createTranslations($whoWeDo, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.whoWeDo.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(WhoWeDo $whoWeDo)
    {
        $languages = Language::all();
        return view('backend.pages.whoWeDo.edit', compact('whoWeDo', 'languages'));
    }

    public function update(Request $request, WhoWeDo $whoWeDo)
    {
        try {
            DB::beginTransaction();

            $this->mainService->save($whoWeDo, $request->except('_token', '_method'));
            $this->mainService->createTranslations($whoWeDo, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.whoWeDo.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(WhoWeDo $whoWeDo)
    {
        try {
            DB::beginTransaction();

            $whoWeDo->delete();

            DB::commit();
            return redirect()->route('admin.whoWeDo.index')->with('success', 'Silindi');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
