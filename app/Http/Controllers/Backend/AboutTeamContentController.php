<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutTeamContent;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutTeamContentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->mainService->model = AboutTeamContent::class;
    }

    public function index()
    {
        $item = AboutTeamContent::first();
        if (is_null($item)) {
            $item = AboutTeamContent::create([]);
        }
        $languages = Language::all();
        return view('backend.pages.about_team.index', compact('item', 'languages'));
    }

    public function update(Request $request, AboutTeamContent $item)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method');
            $item = $this->mainService->save($item, $data);
            $this->mainService->createTranslations($item, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişdirildi', [], 200, route('admin.about_team.index'));
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseMessage('error', $exception->getMessage(), [], 500);
        }
    }
}
