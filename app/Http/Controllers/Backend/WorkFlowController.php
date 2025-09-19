<?php 
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\WorkFlow;
use App\DataTables\WorkFlowDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WorkFlowController extends Controller
{
    public function index(WorkFlowDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.work_flows.index');
    }

    public function create()
    {
        $languages = Language::all();
        return view('backend.pages.work_flows.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $workFlow = new WorkFlow();
            $this->mainService->save($workFlow, $data);
            $this->mainService->createTranslations($workFlow, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.work_flows.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(WorkFlow $workFlow)
    {
        $languages = Language::all();
        return view('backend.pages.work_flows.edit', compact('workFlow', 'languages'));
    }

    public function update(Request $request, WorkFlow $workFlow)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $this->mainService->save($workFlow, $data);
            $this->mainService->createTranslations($workFlow, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.work_flows.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(WorkFlow $workFlow)
    {
        try {
            DB::beginTransaction();

            $workFlow->delete();
            DB::commit();

            return redirect()->route('admin.work_flows.index')
                ->with('success', 'WorkFlow deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
