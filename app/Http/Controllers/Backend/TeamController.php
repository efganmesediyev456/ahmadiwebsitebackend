<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Team;
use App\DataTables\TeamDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index(TeamDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.teams.index');
    }

    public function create()
    {
        $languages = Language::all();
        return view('backend.pages.teams.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('teams', 'public');
            }

            $team = new Team();
            $this->mainService->save($team, $data);
            $this->mainService->createTranslations($team, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.teams.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(Team $team)
    {
        $languages = Language::all();
        return view('backend.pages.teams.edit', compact('team', 'languages'));
    }

    public function update(Request $request, Team $team)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                if ($team->image && Storage::disk('public')->exists($team->image)) {
                    Storage::disk('public')->delete($team->image);
                }
                $data['image'] = $request->file('image')->store('teams', 'public');
            }

            $this->mainService->save($team, $data);
            $this->mainService->createTranslations($team, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.teams.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(Team $team)
    {
        try {
            DB::beginTransaction();

            if ($team->image && Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }

            $team->delete();
            DB::commit();

            return redirect()->route('admin.teams.index')
                ->with('success', 'Team member deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
