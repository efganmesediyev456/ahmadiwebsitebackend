<?php
namespace App\DataTables;

use App\Models\WhoWeDo;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class WhoWeDoDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', fn($row) => view('backend.pages.whoWeDo.action', compact('row'))->render())
            ->editColumn('title', fn($row) => $row->translate(app()->getLocale())?->title ?? 'Yoxdur')
            ->editColumn('description', fn($row) => $row->translate(app()->getLocale())?->description ?? 'Yoxdur')
            ->setRowId('id');
    }

    public function query(WhoWeDo $model)
    {
        return $model->newQuery()->with('translations')->orderBy('created_at', 'desc');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('who-we-do-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'), Button::make('csv'),
                Button::make('pdf'), Button::make('print')
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->addClass('text-center'),
            Column::make('title')->title('Title')->addClass('text-center'),
            Column::make('description')->title('Description')->addClass('text-center'),
            Column::computed('action')->title('Əməliyyatlar')->exportable(false)->printable(false)
        ];
    }

    protected function filename(): string
    {
        return 'who_we_do_' . date('YmdHis');
    }
}
