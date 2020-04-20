<?php

$syncTrackSubmenu = ( new \LifterLMS\SyncAutoEnroll\Submenu( 'Sync Auto-Enroll', 'lifterlms-sync-track' ) )
    ->attach( 'edit.php?post_type=llms_membership' )
    ->view(
        'Sync Track Courses to Membership Auto-Enrollment',
        plugin_dir_path(__FILE__) . 'views/submenu/index.php'
    )
;

add_action('admin_menu', function() use ($syncTrackSubmenu) {
    add_submenu_page(
        $syncTrackSubmenu->parent_slug,
        $syncTrackSubmenu->page_title,
        $syncTrackSubmenu->menu_title,
        $syncTrackSubmenu->capability,
        $syncTrackSubmenu->menu_slug,
        $syncTrackSubmenu->function,
        $syncTrackSubmenu->position
    );
});

add_action( 'admin_post_lifterLMSSyncTrackToMembership', function()  use ($syncTrackSubmenu) {

    check_admin_referer('lifterLMSSyncTrackToMembership');

    $controller = new \LifterLMS\SyncAutoEnroll\Controllers\Sync();
    $controller->__invoke();

    wp_redirect(
        add_query_arg(
            [ 'success' => 1 ],
            $syncTrackSubmenu->getUrl()
        )
    );
    exit;
} );
