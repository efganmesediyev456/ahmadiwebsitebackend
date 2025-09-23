<?php
namespace App\DataTables;

use App\Models\WhoWeDoItem;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class WhoWeDoItemDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', fn($row) => view('backend.pages.whoWeDoItem.action', compact('row'))->render())
            ->editColumn('who_we_do_id', fn($row) => $row->whoWeDo?->translate(app()->getLocale())?->title ?? 'Yoxdur')
            ->editColumn('title', fn($row) => $row->translate(app()->getLocale())?->title ?? 'Yoxdur')
            ->editColumn('description', fn($row) => $row->translate(app()->getLocale())?->description ?? 'Yoxdur')
            ->setRowId('id');
    }

    public function query(WhoWeDoItem $model)
    {
        return $model->newQuery()->with(['translations', 'whoWeDo.translations'])->orderBy('created_at', 'desc');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('who-we-do-item-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
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
            Column::make('who_we_do_id')->title('Who We Do')->addClass('text-center'),
            Column::make('title')->title('Title')->addClass('text-center'),
            Column::make('description')->title('Description')->addClass('text-center'),
            Column::computed('action')->title('Əməliyyatlar')->exportable(false)->printable(false)
        ];
    }

    protected function filename(): string
    {
        return 'who_we_do_item_' . date('YmdHis');
    }
}
