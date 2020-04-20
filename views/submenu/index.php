<div class="wrap">
    <h1>Sync Track to Membership Auto-Enroll</h1>

    <p>
        Configure a membership to auto-enroll all courses for a given track.
    </p>

    <?php
    if( isset( $_REQUEST[ 'success' ] ) ) {
        include 'notice/success.php';
    }
    ?>

    <?php include 'form.php'; ?>

</div>