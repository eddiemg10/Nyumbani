<?= $this->extend('layouts/main')?>

<!-- Beginning of the content to be rendered into the layout -->
<?= $this->section('content')?>

<?= $this->include('templates/admin_navbar')?>
<?= $this->include('admin/admin_dashboard')?>



<div class="container-fluid oncanvas">

    <div class="d-flex justify-content-center mb-4">
        <div class="card col-6 m-5 pb-5 shadow bg-body rounded" style="width: 500px">
            <div class="card-header p-2">
                <h3>Users</h3>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <select class="form-select form-select mb-3 mt-3" style="width: 50%" id="usersChartFilter"
                    aria-label=".form-select-lg example">
                    <option disabled selected>Choose filtering options</option>
                    <option value="1">Type</option>
                    <option value="2">Status</option>
                </select>
            </div>


            <canvas id="usersChart" width="300" height="180"></canvas>

        </div>

        <div class="card col-6 m-5 pb-5 shadow bg-body rounded" style="width: 500px">
            <div class="card-header p-2">
                <h3>Properties</h3>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <select class="form-select form-select mb-3 mt-3" style="width: 50%" id="propertiesChartFilter"
                    aria-label=".form-select-lg example">
                    <option disabled selected>Choose filtering options</option>
                    <option value="1">Availability</option>
                    <option value="2">Verification</option>
                    <option value="3">Property Type</option>

                </select>
            </div>


            <canvas id="propertiesChart" width="300" height="180"></canvas>

        </div>
    </div>


    <div class="d-flex justify-content-center mb-4">

        <div class="card col-10 m-5 pb-5 shadow bg-body rounded">
            <div class="card-header p-2">
                <h3>Property Locations</h3>
            </div>




            <canvas id="propertyLocationChart" width="600" height="260"></canvas>

        </div>
    </div>

    <div class="d-flex justify-content-center mb-4">

        <div class="card col-10 m-5 pb-5 shadow bg-body rounded">
            <div class="card-header p-2">
                <h3>Tenancy Applications</h3>
            </div>

            <div class="d-flex justify-content-center mb-4">
                <select class="form-select form-select mb-3 mt-3" style="width: 50%" id="applicationsChartFilter"
                    aria-label=".form-select-lg example">
                    <option disabled selected>Choose filtering options</option>
                    <option value="1">Day</option>
                    <option value="2">This Year</option>
                    <option value="3">All Time</option>

                </select>


            </div>

            <div class="d-flex justify-content-center mb-5">
                <div class="col-sm-4">
                    <div class="input-group date" id="datepicker" style="display: none">
                        <input type="text" class="form-control" id="dateValue">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>




            <canvas id="applicationsChart" width="600" height="260"></canvas>

        </div>
    </div>


</div>


<script>
$(document).ready(function() {

    $(function() {
        $('#datepicker').datepicker();
    });

    var propertiesChart, propertiesChart2, propertiesChart3, applicationsChart;
    showUsersChart(1);
    showPropertiesChart(1);
    showPropertyLocationChart();
    showApplicationsChart(2);

    $("#propertiesChartFilter").on('change', function() {

        var filter = $(this).val();
        showPropertiesChart(filter);



    });


    $("#applicationsChartFilter").on('change', function() {

        $('#datepicker').hide();

        var filter = $(this).val();
        if (filter == 1) {
            $('#datepicker').show();

            $("#datepicker").on("change", function() {
                var selected = $("#dateValue").val();
                // console.log(selected);
            });
        }

        if (filter == 2) {
            showApplicationsChart(2);
        }
        if (filter == 3) {
            showApplicationsChart(3);
        }

    });


    $("#usersChartFilter").on('change', function() {

        var filter = $(this).val();
        showUsersChart(filter);

    });


    function showPropertiesChart(filter) {

        $.ajax({
            url: "<?php echo base_url('properties/propertyChartData') ?>",
            method: "POST",
            data: {
                filter: filter,
            },
            success: function(data) {

                const ctx = document.getElementById('propertiesChart').getContext('2d');

                //Destroy existing chart on ajax reload
                if (typeof propertiesChart !== 'undefined') {
                    propertiesChart.destroy()
                }

                propertiesChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Users',
                            data: data.numbers,
                            backgroundColor: [
                                'rgb(30, 216, 167)',
                                'rgb(255, 99, 132)',
                                'rgb(250, 220, 72)',
                                'rgb(96, 221, 235)',
                                'rgb(184, 230, 227)',


                            ],
                            hoverOffset: 4
                        }]
                    },
                });

            }

        });


    }

    function showUsersChart(filter) {

        $.ajax({
            url: "<?php echo base_url('users/usersChartData') ?>",
            method: "POST",
            data: {
                filter: filter,
            },
            success: function(data) {
                const ctx = document.getElementById('usersChart').getContext('2d');

                //Destroy existing chart on ajax reload
                if (typeof propertiesChart3 !== 'undefined') {
                    propertiesChart3.destroy()
                }

                propertiesChart3 = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Properties',
                            data: data.totals,
                            backgroundColor: [
                                'rgb(30, 216, 167)',
                                'rgb(255, 99, 132)',
                                'rgb(250, 220, 72)',


                            ],
                            hoverOffset: 4
                        }]
                    },
                });

            }

        });


    }

    function showPropertyLocationChart() {
        $.ajax({
            url: "<?php echo base_url('properties/propertyLocationChartData') ?>",
            method: "GET",

            success: function(data) {
                const colors = getColors(data.totals.length);
                const ctx = document.getElementById('propertyLocationChart').getContext(
                    '2d');
                //Destroy existing chart on ajax reload
                if (typeof propertiesChart2 !== 'undefined') {
                    propertiesChart2.destroy()
                }
                propertiesChart2 = new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                        labels: data.counties,
                        datasets: [{
                            label: 'Properties',
                            data: data.totals,
                            backgroundColor: colors,
                            hoverOffset: 4
                        }]
                    },
                });

            }

        });
    }

    function showApplicationsChart(filter) {
        $.ajax({
            url: "<?php echo base_url('applications/applicationData') ?>",
            method: "POST",
            data: {
                filter: filter,
            },

            success: function(data) {
                console.log(data);
                const colors = getColors(data.totals.length);
                const ctx = document.getElementById('applicationsChart').getContext('2d');

                //Destroy existing chart on ajax reload
                if (typeof applicationsChart !== 'undefined') {
                    applicationsChart.destroy()
                }

                applicationsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Applications',
                            data: data.totals,
                            backgroundColor: colors,
                            hoverOffset: 4
                        }]
                    },
                });

            }

        });
    }

    function getColors(size) {

        var colors = [];

        $.ajax({
            url: "https://gist.githubusercontent.com/jjdelc/1868136/raw/c9160b1e60bd8c10c03dbd1a61b704a8e977c46b/crayola.json",
            method: "GET",

            success: function(data) {
                const result = JSON.parse(data);
                let colors2 = colors;

                let r = Math.floor(Math.random() * 87);

                for (let i = 0; i < size; i++) {
                    colors2.push("rgb" + result[r++].rgb);
                }


            },
            async: false

        });

        return colors;
    }


});
</script>


<?= $this->endSection() ?>