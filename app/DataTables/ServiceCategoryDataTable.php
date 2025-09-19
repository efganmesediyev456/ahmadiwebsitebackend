<?php

namespace App\DataTables;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ServiceCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function (ServiceCategory $category) {
                return optional($category->translations->firstWhere('locale', 'az'))->name ?? '-';
            })
            ->addColumn('action', function (ServiceCategory $row) {
                $editUrl = route('admin.service-category.edit', ['serviceCategory' => $row->id]);
                $deleteUrl = route('admin.service-category.destroy', ['serviceCategory' => $row->id]);

                return view('backend.pages.service-category.action', compact('editUrl', 'deleteUrl', 'row'))->render();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ServiceCategory $model): QueryBuilder
    {
        return $model->newQuery()->with('translations');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('servicecategory-table')
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
            Column::make('name')->title('Ad'),
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
        return 'ServiceCategory_' . date('YmdHis');
    }
}
