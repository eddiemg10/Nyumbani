<?= $this->extend('layouts/main')?>

<!-- Beginning of the content to be rendered into the layout -->
<?= $this->section('content')?>

<?= $this->include('templates/admin_navbar')?>
<?= $this->include('admin/admin_dashboard')?>

<div class="container-fluid oncanvas mt-5">
    <div class="ms-auto mb-5">
        <button class="btn btn-success mx-5" id="viewRequests">All Requests</button>
        <button class="btn btn-success mx-5" id="viewQueue">Queue</button>
    </div>


    <div>
        <table class="table table-success table-hover table-striped mt-5">
            <thead>
                <tr class="table-dark">
                    <td>Owner</td>
                    <td>Property</td>
                    <td>Action</td>

                </tr>
            </thead>
            <tbody id="allrequests">

                <?php foreach($requests as $request):?>
                <tr class="px-3">
                    <td><b><?=$request->firstName. " ".$request->lastName?> </b><br><span class="fw-light">
                            <?=$request->email?></span></td>
                    <td><span class="fw-light"><?= "Added on: ".date('F j, Y',  strtotime($request->created_at))?>
                        </span> <br> <?=$request->propertyDescription?>
                    </td>
                    <td> <button class="btn btn-dark details-btn" data-id="<?=$request->requestID?>">Open</button> </td>

                </tr>
                <tr>
                    <td colspan="3" id="<?=$request->requestID?>" hidden>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="../../uploads/images/properties/<?=$request->thumbnailPhoto?>"
                                            width=200>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="card">
                                    <div class="card-body">
                                        <p><span class="fw-bold">Name:</span>
                                            <?=" ".$request->firstName. " ".$request->lastName?> </p>
                                        <p><span class="fw-bold">Email:</span> <?=" ".$request->email?></p>


                                        <a href="#" class="btn btn-primary queue"
                                            data-id="<?=$request->requestID?>">Begin
                                            Verification</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>

            <tbody id="queuerequests">

                <?php foreach($queues as $queue):?>
                <tr class="px-3">
                    <td><b><?=$queue->firstName. " ".$queue->lastName?> </b><br><span class="fw-light">
                            <?=$queue->email?></span></td>
                    <td><span class="fw-light"><?= "Added on: ".date('F j, Y',  strtotime($queue->created_at))?>
                        </span> <br> <?=$queue->propertyDescription?>
                    </td>
                    <td> <button class="btn btn-dark details-btn" data-id="<?=$queue->requestID?>">Open</button> </td>

                </tr>
                <tr>
                    <td colspan="3" id="<?=$queue->requestID?>" hidden>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="../../uploads/images/properties/<?=$queue->thumbnailPhoto?>"
                                            width=200>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="card">
                                    <div class="card-body">
                                        <p><span class="fw-bold">Name:</span>
                                            <?=" ".$queue->firstName. " ".$queue->lastName?> </p>
                                        <p><span class="fw-bold">Email:</span> <?=" ".$queue->email?></p>


                                        <a href="#" class="btn btn-primary confirm-req"
                                            data-id="<?=$queue->requestID?>">Confirm
                                            Verification</a>

                                        <a href="#" class="btn btn-danger reject-req"
                                            data-id="<?=$queue->requestID?>">Reject
                                            Verification</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>

        </table>

    </div>


</div>

<script>
$(document).ready(function() {

    openDetails();
    $("#queuerequests").hide();


    function openDetails() {
        $(".details-btn").click(function(event) {

            var req = $(this).data('id');
            $("#" + req + "").attr("hidden", false);
            $(this).parent().html('<button class="btn btn-danger closeTab" data-id="' + req +
                '">Close</button>');
            closeDetails();

        });
    }


    function closeDetails() {
        $(".closeTab").click(function(event) {

            var req = $(this).data('id');
            $("#" + req + "").attr("hidden", true);
            $(this).parent().html('<button class="btn btn-dark details-btn" data-id="' + req +
                '">Open</button>');
            openDetails();
        });
    }

    $(".queue").click(function(event) {

        var req = $(this).data('id');

        $.ajax({
            url: "<?php echo base_url('enqueue') ?>",
            method: "POST",
            data: JSON.stringify({
                id: req,
                admin: 23
            }),
            success: function(data) {
                $("#" + req + "").parent().hide();
                $("#" + req + "").parent().prev().hide();
                $("#viewQueue").focus();
            }

        });

    });



    $("#viewQueue").click(function(event) {
        $("#queuerequests").show();
        $("#allrequests").hide();


    });

    $("#viewRequests").click(function(event) {
        $("#queuerequests").hide();
        $("#allrequests").show();


    });

    $(".confirm-req").click(function(event) {

        let req = $(this).data('id');

        if (!confirm("Are you sure you want to approve this Request?")) {
            return false;
        }
        $.ajax({
            url: "<?php echo base_url('verifications/accept/') ?>" + "/" + req,
            method: "GET",
            success: function(data) {
                $("#" + req + "").parent().hide();
                $("#" + req + "").parent().prev().hide();

            }

        });

    });

    $(".reject-req").click(function(event) {
        let req = $(this).data('id');

        if (!confirm("Are you sure you want to reject this Request?")) {
            return false;
        }

        $.ajax({
            url: "<?php echo base_url('verifications/reject//') ?>" + "/" + req,
            method: "GET",
            success: function(data) {
                $("#" + req + "").parent().hide();
                $("#" + req + "").parent().prev().hide();

            }

        });

    });



});
</script>
<?= $this->endSection() ?>