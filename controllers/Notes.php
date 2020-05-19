<?php namespace AlbrightLabs\Note\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Notes Back-end Controller
 */
class Notes extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('AlbrightLabs.Note', 'note', 'notes');
    }

    /**
     * Delete method from preview context
     */
    public function preview_onDelete($recordId = null)
    {
        return $this->asExtension('FormController')->update_onDelete($recordId);
    }
}
