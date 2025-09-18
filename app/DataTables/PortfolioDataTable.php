<?php

namespace App\DataTables;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PortfolioDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return view('backend.pages.portfolios.action', compact('row'))->render();
            })
            ->addColumn('title', function ($row) {
                return $row->title;
            })
            ->editColumn('image', function ($row) {
                return $row->image
                    ? '<img src="/storage/' . $row->image . '" width="80" class="img-thumbnail" />'
                    : 'Yoxdur';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at
                    ? $row->created_at->format('d.m.Y H:i')
                    : 'Qeyd edilməyib';
            })
            ->rawColumns(['action', 'image'])
            ->setRowId('id');
    }

    public function query(Portfolio $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('translations')
            ->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('portfolios-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->text('<i class="fas fa-file-excel"></i> Excel'),
                Button::make('csv')->text('<i class="fas fa-file-csv"></i> CSV'),
                Button::make('pdf')->text('<i class="fas fa-file-pdf"></i> PDF'),
                Button::make('print')->text('<i class="fas fa-print"></i> Print'),
            ])
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'lengthMenu' => [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'Hamısı']
                ],
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width(50)->addClass('text-center'),
            Column::make('title')->title('Başlıq')->addClass('text-center'),
            Column::make('image')->title('Şəkil')->addClass('text-center'),
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
        return 'portfolios_' . date('YmdHis');
    }
}
