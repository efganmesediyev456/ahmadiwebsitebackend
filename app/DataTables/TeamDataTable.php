<?php
namespace App\DataTables;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TeamDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', fn($row) => view('backend.pages.teams.action', compact('row'))->render())
            ->editColumn('image', fn($row) => $row->image 
                ? '<img src="/storage/' . $row->image . '" width="80" class="img-thumbnail" />' 
                : 'Yoxdur')
            ->editColumn('be_url', fn($row) => $row->be_url)
            ->editColumn('ln_url', fn($row) => $row->ln_url)
            ->editColumn('created_at', fn($row) => $row->created_at?->format('d.m.Y H:i') ?? 'Qeyd edilməyib')
            ->rawColumns(['action', 'image'])
            ->setRowId('id');
    }

    public function query(Team $model): QueryBuilder
    {
        return $model->newQuery()->with('translations')->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('teams-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->text('<i class="fas fa-file-excel"></i> Excel'),
                Button::make('csv')->text('<i class="fas fa-file-csv"></i> CSV'),
                Button::make('pdf')->text('<i class="fas fa-file-pdf"></i> PDF'),
                Button::make('print')->text('<i class="fas fa-print"></i> Print'),
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(50)->addClass('text-center'),
            Column::make('image')->title('Şəkil')->addClass('text-center'),
            Column::make('be_url')->title('BE URL')->addClass('text-center'),
            Column::make('ln_url')->title('LN URL')->addClass('text-center'),
            Column::make('created_at')->title('Yaradılma Tarixi')->addClass('text-center'),
            Column::computed('action')
                ->title('Əməliyyatlar')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'teams_' . date('YmdHis');
    }
}
