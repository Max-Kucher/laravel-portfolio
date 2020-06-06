<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguageRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LanguageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LanguageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        parent::setupEntityNameStrings('language');

        $this->crud->setModel('App\Models\Language');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/language');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(LanguageRequest::class);

        // TODO: remove setFromDb() and manually define Fields
//        $this->crud->setFromDb();

        $this->crud->addField([
            'type' => 'text',
            'name' => 'lang_code',
            'label' => trans('backend/models.lang_code'),
            'hint' => trans('backend/hints.lang_code'),
            'wrapper'   => [
                'class' => 'form-group  col-xl-6'
            ],
        ])->addField([
            'type' => 'text',
            'name' => 'name',
            'label' => trans('backend/models.name'),
        ]);

        $this->addStatusField();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
