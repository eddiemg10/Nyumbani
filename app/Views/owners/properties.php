<?= $this->extend('layouts/main')?>

<!-- Beginning of the content to be rendered into the layout -->
<?= $this->section('content')?>

<?= $this->include('templates/navigation_bar')?>
<?= $this->include('owners/dashboard')?>

<div class="modal fade" id="detailsmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 80vw">
            <div class="modal-header"> Property Details
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <div class=" container d-flex justify-content-center" id="propDetails">

                </div>


            </div>


        </div>
    </div>
</div>


<div class="container-fluid oncanvas mt-5">
    <h1 class="display-4"> Your Properties</h1>
    <li class="my-2">
        <hr class="dropdown-divider">
    </li>

    <!-- <div class="container card shadow p-3 rounded mt-5 ms-3" style="width: 80%;">
        <img src="../../uploads/images/properties/pic1.jpg" class="card-img-top" alt="...">
        <a class="btn btn-dark">Gallery</a>

        <div class="d-flex flex-wrap justify-content-evenly">

        </div>

        <div class="card-body">

            <h4 class="fw-bold text-center">4 bdrm dfddds ssd</h4>
            <h5>
                Type:
                <small class="text-muted">Bungalow</small>
            </h5>
            <h5>
                Rent:
                <small class="text-muted">12000</small>
            </h5>
            <h5>
                County:
                <small class="text-muted">12000</small>
            </h5>
            <h5>
                Description:
                <small class="text-muted">12000</small>
            </h5>
            <div style="background: rgb(183, 235, 223)" class="rounded p-3">
                <h5>
                    Tenant Name:
                    <small class="text-muted">12000</small>
                </h5>
                <h5>
                    Tenant Email:
                    <small class="text-muted">12000</small>
                </h5>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-lg btn-success" id="listing">Add to Listing</button>

            </div>

        </div>
    </div> -->

    <div class="d-flex flex-wrap justify-content-evenly" id="properties">

    </div>

    <!-- <div class="card shadow p-3 rounded mt-5 ms-3" style="width: 25rem;">
        <img src="../../uploads/images/properties/pic1.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            Status: <a class="btn btn-success me-5">Occupied</a>

            <a href="#" class="btn btn-dark reject-req ms-5" data-id=""> Details</a>
  
        </div>
    </div> -->


</div>

<script>
$(document).ready(function() {

    getProps();

    function getProps() {

        var user = 1;
        $.ajax({
            url: "<?php echo base_url('properties/') ?>" + "/" + user,
            method: "GET",
            success: function(data) {
                console.log(data);
                for (var property in data) {
                    var p = data[property];
                    let status = "Occupied";
                    if (p.tenantID == null) {
                        status = "Vaccant";
                    }

                    var card =
                        '<div class="card shadow p-3 rounded mt-5 ms-3" style="width: 30rem;"> <' +
                        'img src = "../../uploads/images/properties/' + p.thumbnailPhoto + '"' +
                        'class = "card-img-top mb-4"' +
                        '<div class = "card-body row">' +
                        '<span>Status: <a class = "btn btn-success me-5 col-3">' + status +
                        '</a>' +
                        '<a href = "#" data-id="' + property +
                        '" class = "btn btn-dark reject-req ms-5 details col-3"> Details </a></span>' +
                        '</div>' +
                        '</div>';

                    $("#properties").append(card);



                }

                $(".details").click(function(event) {

                    let property = $(this).data('id');
                    event.preventDefault();

                    $('#detailsmodal').attr('style', 'z-index: 2000 !important');
                    $('#detailsmodal').modal('show');
                    $('html, body').css({
                        overflow: 'hidden',
                        height: '100%'
                    });


                    $.ajax({
                        url: "<?php echo base_url('properties/') ?>" + "/" + user,
                        method: "GET",
                        success: function(data) {
                            var p = data[property];


                            let dits =
                                '<div class="container card shadow p-3 rounded mt-5 ms-3" style="width: 100rem;">' +
                                '<img src = "../../uploads/images/properties/' +
                                p
                                .thumbnailPhoto + '"' +
                                'class = "card-img-top"' +
                                '<a class = "btn btn-dark"> Gallery </a>' +

                                '<div class = "d-flex flex-wrap justify-content-evenly">' +

                                '</div>' +

                                '<div class = "card-body">' +

                                '<h4 class = "fw-bold text-center">' + p
                                .propertyDescription +
                                '</h4> ' +
                                '<h5>' +
                                'Type:' +
                                '<small class = "text-muted" >' + p
                                .propertyType +
                                ' </small> </h5>' +
                                '<h5>' +
                                'Rent:' +
                                '<small class = "text-muted" >' + p
                                .propertyRent + '</small>' +
                                '</h5>' +
                                '<h5>' +
                                'Physical Address:' +
                                '<small class = "text-muted">' + p
                                .propertyPhysicalAddress +
                                '</small> </h5>' +
                                '<h5>' +
                                'Description:' +
                                '<small class = "text-muted">' + p
                                .propertyDescription +
                                '</small> </h5>' +
                                '<div style = "background: rgb(183, 235, 223)"' +
                                'class = "rounded p-3">' +
                                '<h5>' +
                                'Tenant Name:' +
                                '<small class = "text-muted">' + p.firstName +
                                " " + p
                                .lastName + ' </small> </h5>' +
                                '<h5> Tenant Email: <small class = "text-muted" >' +
                                p.email +
                                '</small>' +
                                '</h5> </div> <div class = "modal-footer d-flex justify-content-center">' +
                                '<button type = "button"class = "btn btn-lg btn-success listing"id="' +
                                p.propertyID + '" > Add to Listing </button>' +
                                '</div></div> </div > ';

                            $("#propDetails").html(dits);

                        }

                    });



                });
            }

        });
    }


});
</script>

<?= $this->endSection() ?>