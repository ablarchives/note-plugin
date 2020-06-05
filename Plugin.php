<?php namespace AlbrightLabs\Note;

use Event;
use Backend;
use AlbrightLabs\Client\Models\Client;
use AlbrightLabs\Client\Controllers\Clients;
use System\Classes\PluginManager;
use System\Classes\PluginBase;

/**
 * Note Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Note',
            'description' => 'A simple note plugin, also extends Client Plugin',
            'author'      => 'Albright Labs LLC',
            'icon'        => 'icon-sticky-note'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        // If Client plugin is installed
        if(PluginManager::instance()->exists('AlbrightLabs.Client')){

            // Add relation to AlbrightLabs.Client Client model
            Client::extend(function($model) {
                $model->hasMany['notes'] = 'AlbrightLabs\Note\Models\Note';
            });

            // Add relation config to AlbrightLabs.Client Clients controller
            Clients::extend(function($controller){
                // Only for the Clients controller
                if (!$controller instanceof \AlbrightLabs\Client\Controllers\Clients) {
                    return;
                }
                if (!isset($controller->relationConfig)) {
                    $controller->addDynamicProperty('relationConfig');
                }
                $myConfigPath = '$/albrightlabs/note/controllers/notes/config_relation.yaml';
                $controller->relationConfig = $controller->mergeConfig(
                    $controller->relationConfig,
                    $myConfigPath
                );
            });

            // Extend all backend form usage for AlbrightLabs.Client Client model
            Event::listen('backend.form.extendFields', function($widget) {

                // Only for the Clients controller
                if (!$widget->getController() instanceof \AlbrightLabs\Client\Controllers\Clients) {
                    return;
                }

                // Only for the Client model
                if (!$widget->model instanceof \AlbrightLabs\Client\Models\Client) {
                    return;
                }

                // Add the notes list field
                $widget->addTabFields([
                    'notes' => [
                        'label' => 'Notes',
                        'type'  => 'partial',
                        'path'  => '$/albrightlabs/note/controllers/notes/_field_notes.htm',
                        'tab'   => 'Notes',
                    ],
                ]);
            });

            // Extend all backend form usage for AlbrightLabs.Note note model
            Event::listen('backend.form.extendFields', function($widget) {

                // Only for the Clients controller
                if (!$widget->getController() instanceof \AlbrightLabs\Note\Controllers\Notes) {
                    return;
                }

                // Only for the Client model
                if (!$widget->model instanceof \AlbrightLabs\Note\Models\Note) {
                    return;
                }

                // Remove thte title field
                $widget->removeField('title');

                // Add the client dropdown and re-add title field
                $widget->addFields([
                    'client' => [
                        'label'  => 'Client',
                        'type'   => 'relation',
                        'select' => 'concat(name, " ", surname)',
                    ],
                    'title' => [
                        'label' => 'Title',
                        'type'  => 'text',
                        'span'  => 'full',
                    ],
                ]);
            });
        }
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'albrightlabs.note.manage' => [
                'tab' => 'Note',
                'label' => 'Manage notes'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'note' => [
                'label'       => 'Notes',
                'url'         => Backend::url('albrightlabs/note/notes'),
                'icon'        => 'icon-sticky-note',
                'iconSvg'     => '/plugins/albrightlabs/note/assets/img/icon.svg',
                'permissions' => ['albrightlabs.note.*'],
                'order'       => 190,
            ],
        ];
    }
}
