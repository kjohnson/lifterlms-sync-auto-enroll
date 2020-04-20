<?php

namespace LifterLMS\SyncAutoEnroll\Controllers;

class Sync
{
    public function __invoke()
    {
        if( ! isset( $_POST[ 'membership' ] )) return;
        if( ! isset( $_POST[ 'courseTrack' ] )) return;
    
        $courseTrack = sanitize_text_field( $_POST[ 'courseTrack' ] );
        $courses = get_posts([
            'post_type' => 'course',
            'course_track' => $courseTrack,
            'numberposts' => -1 // Get all.
        ]);
    
        $courseIds = array_map( function( $course ) {
            return $course->ID;
        }, $courses);
    
        $membership = intval( $_POST[ 'membership' ] );
        $autoEnroll = get_post_meta( $membership, '_llms_auto_enroll', $single = true );
        update_post_meta( $membership, '_llms_auto_enroll', array_merge( $courseIds, $autoEnroll )); 
    }
}