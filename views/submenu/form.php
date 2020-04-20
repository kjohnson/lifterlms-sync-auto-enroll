<?php
    $action = 'lifterLMSSyncTrackToMembership';
    $formAction = admin_url('admin-post.php');
    $memberships = get_posts([
        'post_type' => 'llms_membership',
        'numberposts' => -1 // Get all.
    ]);
    $courseTracks = get_terms('course_track');
?>
<form action="<?php echo $formAction; ?>" method="post">
    <input type="hidden" name="action" value="<?php echo $action; ?>">
    <?php wp_nonce_field( $action ); ?>
    <select name="courseTrack">
        <option>-</option>
        <?php foreach( $courseTracks as $courseTrack ): ?>
            <option value="<?php echo $courseTrack->slug; ?>">
                <?php echo $courseTrack->name; ?>
                ( <?php echo $courseTrack->slug; ?> )
            </option>
        <?php endforeach; ?>
    </select>
    to
    <select name="membership">
        <option>-</option>
        <?php foreach( $memberships as $membership ): ?>
            <option value="<?php echo $membership->ID; ?>">
                ID# <?php echo $membership->ID; ?>
                -
                <?php echo $membership->post_title; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" class="button button-primary" value="Sync">
</form>