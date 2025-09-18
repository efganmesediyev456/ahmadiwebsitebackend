<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Portfolio;
use App\DataTables\PortfolioDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index(PortfolioDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.portfolios.index');
    }

    public function create()
    {
        $languages = Language::all();
        return view('backend.pages.portfolios.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('portfolios', 'public');
            }

            $portfolio = new Portfolio();
            $this->mainService->save($portfolio, $data);
            $this->mainService->createTranslations($portfolio, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla yaradıldı', [], 200, route('admin.portfolios.index'));

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function edit(Portfolio $portfolio)
    {
        $languages = Language::all();
        return view('backend.pages.portfolios.edit', compact('portfolio', 'languages'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            if ($request->hasFile('image')) {
                if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                    Storage::disk('public')->delete($portfolio->image);
                }
                $data['image'] = $request->file('image')->store('portfolios', 'public');
            }

            $this->mainService->save($portfolio, $data);
            $this->mainService->createTranslations($portfolio, $request);

            DB::commit();
            return $this->responseMessage('success', 'Uğurla dəyişiklik edildi!', [], 200, route('admin.portfolios.index'));

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseMessage('error', $e->getMessage(), [], 500);
        }
    }

    public function destroy(Portfolio $portfolio)
    {
        try {
            DB::beginTransaction();

            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }

            $portfolio->delete();
            DB::commit();

            return redirect()->route('admin.portfolios.index')
                ->with('success', 'Portfolio deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
