<?php

namespace App\DataTables;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ServiceDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($service) {
                return view('backend.pages.service.action', compact('service'))->render();
            })
            ->editColumn('category_id', function ($service) {
                return $service->category?->translations
                    ->firstWhere('locale', app()->getLocale())?->title ?? '-';
            })
            ->addColumn('title', function (Service $service) {
                return optional($service->translations->firstWhere('locale', 'az'))->title?? '-';
            })

            ->editColumn('status', function ($service) {
                return ucfirst($service->status);
            })

//            ->addColumn('action', function (Service $row) {
//                $editUrl = route('admin.service.edit', ['service' => $row->id]);
//                $deleteUrl = route('admin.service.destroy', ['service' => $row->id]);
//
//                return view('backend.pages.service.action', compact('editUrl', 'deleteUrl', 'row'))->render();
//            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Service $model): QueryBuilder
    {
        return $model->with(['category.translations', 'translation']); // eager load
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('service-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('title')->title('Başlıq'),
            Column::make('category_id')->title('Kategoriya'),

            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Yaradılma tarixi'),
            Column::make('updated_at')->title('Yenilənmə tarixi'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center')
                ->title('Əməliyyatlar'),
        ];


    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Service_' . date('YmdHis');
    }
}
