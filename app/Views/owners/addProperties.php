?= $this->extend('layouts/main')?>

<!-- Beginning of the content to be rendered into the layout -->
<?= $this->section('content')?>

<?= $this->include('templates/navigation_bar')?>
<?= $this->include('owners/dashboard')?>

<div class="container-fluid oncanvas mt-5">
    ADD PROPERTIES
    


</div>

<?= $this->endSection() ?>