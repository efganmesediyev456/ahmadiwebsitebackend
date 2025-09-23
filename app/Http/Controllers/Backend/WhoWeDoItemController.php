<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\WhoWeDo;
use App\Models\WhoWeDoItem;
use App\DataTables\WhoWeDoItemDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhoWeDoItemController extends Controller
{
    public function index(WhoWeDoItemDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.whoWeDoItem.index');
    }

    public function create()
    {
        $languages = Language::all();
        $whoWeDos = WhoWeDo::all();
        return view('backend.pages.whoWeDoItem.create', compact('languages', 'whoWeDos'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $whoWeDoItem = new WhoWeDoItem();
            $this->mainService->save($whoWeDoItem, $request->except('_token', '_method'));
            $this->mainService->createTranslations($whoWeDoItem, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.whoWeDoItem.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(WhoWeDoItem $whoWeDoItem)
    {
        $languages = Language::all();
        $whoWeDos = WhoWeDo::all();
        return view('backend.pages.whoWeDoItem.edit', compact('whoWeDoItem', 'languages', 'whoWeDos'));
    }

    public function update(Request $request, WhoWeDoItem $whoWeDoItem)
    {
        try {
            DB::beginTransaction();

            $this->mainService->save($whoWeDoItem, $request->except('_token', '_method'));
            $this->mainService->createTranslations($whoWeDoItem, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.whoWeDoItem.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(WhoWeDoItem $whoWeDoItem)
    {
        try {
            DB::beginTransaction();

            $whoWeDoItem->delete();

            DB::commit();
            return redirect()->route('admin.whoWeDoItem.index')->with('success', 'Silindi');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
