<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController as BackpackCrudController;
use App\Enums\Status;

class CrudController extends BackpackCrudController {
    protected function addStatusField($addHiddenStatus = true)
    {
        $options = [
            'type' => 'radio',
            'name' => 'status',
            'label' => trans('backend/models.status'),
            'default' => Status::ACTIVE,
            'options' => [
                Status::ACTIVE => trans('backend/models.status_' . Status::ACTIVE),
                Status::DISABLE => trans('backend/models.status_' . Status::DISABLE),
            ],
            'inline' => true,
            'wrapper'   => [
                'class' => 'form-group col-md-12 required-radio'
            ],
        ];

        if ($addHiddenStatus === true) {
            $options['options'][Status::HIDDEN] = trans('backend/models.status_' . Status::HIDDEN);
        }

        return $this->crud->addField($options);
    }

    /**
     * Set my settings to backpack crud
     *
     * @param string $entry_name
     */
    public function setupEntityNameStrings($entry_name = '')
    {
        $this->crud->setEntityNameStrings(trans_choice('backend/models.' . $entry_name, 1), trans_choice('backend/models.' . $entry_name, 2));
    }
}