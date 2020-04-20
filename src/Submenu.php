<?php

namespace LifterLMS\SyncAutoEnroll;

class Submenu
{
    protected $parent_slug;
    protected $page_title;
    protected $menu_title;
    protected $capability = 'manage_options';
    protected $menu_slug;
    protected $function;
    protected $position;

    public function __construct( $menu_title, $menu_slug )
    {
        $this->menu_title = $menu_title;
        $this->menu_slug = $menu_slug;
    }

    public function __get( $property )
    {
        return $this->$property;
    }

    public function getUrl()
    {
        return add_query_arg([
            'page' => $this->menu_slug
        ], admin_url( $this->parent_slug ) );
    }

    public function attach( $parent_slug, $position = null )
    {
        $this->parent_slug = $parent_slug;
        $this->position = $position;
        return $this;
    }

    public function view( $page_title, $view_path )
    {
        $this->page_title = $page_title;
        $this->function = function() use ($view_path) {
            include $view_path;
        };
        return $this;
    }
}