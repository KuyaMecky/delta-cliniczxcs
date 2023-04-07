<?php

namespace App\Http\Livewire;

use App\Models\RadiologyCategory;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RadiologyCategoriesTable extends LivewireTableComponent
{
    protected $model = RadiologyCategory::class;
    use WithPagination;

    public $showButtonOnHeader = true;
    public $showFilterOnHeader = false;
    public $paginationIsEnabled = true;
    public $buttonComponent = 'radiology_categories.add-button';
    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('radiology_categories.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'w-100',
            ];
        });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [

            Column::make(__('messages.user.name'), "name")
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.action'), "id")->view('radiology_categories.action'),
        ];
    }
}
