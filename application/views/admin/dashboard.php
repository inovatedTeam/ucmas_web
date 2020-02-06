<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/left_navigation'); ?>

<main>
    <div class="container-fluid">

        <!--Section: Cascading panels-->
        <section class="mb-3">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-lg-12 col-md-12 mb-r">
                    <!--Card-->
                    <div class="card card-cascade narrower">
                        <!--Card image-->
                        <div class="view gradient-card-header info-color">
                            <h4 class="mb-0">Last Classes</h4>
                        </div>
                        <!--/Card image-->
                        <!--Card content-->
                        <div class="card-body text-center">
                            <style>tr th{text-align: center}</style>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Level</th>
                                    <th>Address</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $index = 0;
                                foreach ($courses as $course){
                                    extract($course);
                                    $index ++;
                                    echo '<tr>';
                                    echo '<td>'.$index.'</td>';
                                    echo '<td>'.$level_name.'</td>';
                                    echo '<td>'.$address.'</td>';
                                    echo '<td>'.date('Y-m-d',$date_start).'</td>';
                                    echo '<td>'.date('Y-m-d',$date_end).'</td>';
                                    echo '</tr>';
                                }

                                ?>
                                </tbody>
                            </table>

                        </div>
                        <!--/.Card content-->
                    </div>
                    <!--/.Card-->
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->

        </section>
        <!--Section: Cascading panels-->

        <!--Section: Classic admin cards-->
        <section>

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-xl-3 col-md-6 mb-r">

                    <!--Card Success-->
                    <div class="card classic-admin-card success-color">
                        <div class="card-body">
                            <div class="pull-right">
                                <i class="fa fa-money"></i>
                            </div>
                            <p class="white-text">SALES</p>
                            <h4>2000$</h4>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg green darken-4" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body">
                            <p>Better than last week (25%)</p>
                        </div>
                    </div>
                    <!--/.Card Success-->

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-xl-3 col-md-6 mb-r">

                    <!--Card Default-->
                    <div class="card classic-admin-card default-color">
                        <div class="card-body">
                            <div class="pull-right">
                                <i class="fa fa-line-chart"></i>
                            </div>
                            <p>SUBSCRIPTIONS</p>
                            <h4>200</h4>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body">
                            <p>Worse than last week (25%)</p>
                        </div>
                    </div>
                    <!--/.Card Default-->

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-xl-3 col-md-6 mb-r">

                    <!--Card Blue-->
                    <div class="card classic-admin-card blue">
                        <div class="card-body">
                            <div class="pull-right">
                                <i class="fa fa-pie-chart"></i>
                            </div>
                            <p>TRAFFIC</p>
                            <h4>20000</h4>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg blue darken-4" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body">
                            <p>Better than last week (75%)</p>
                        </div>
                    </div>
                    <!--/.Card Blue-->

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-xl-3 col-md-6 mb-r">

                    <!--Card Purple-->
                    <div class="card classic-admin-card deep-purple lighten-1">
                        <div class="card-body">
                            <div class="pull-right">
                                <i class="fa fa-bar-chart"></i>
                            </div>
                            <p>ORGANIC TRAFFIC</p>
                            <h4>2000</h4>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body">
                            <p>Better than last week (25%)</p>
                        </div>
                    </div>
                    <!--/.Card Purple-->

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </section>
        <!--Section: Classic admin cards-->

    </div>
</main>

<?php $this->load->view('admin/footer_script'); ?>
<?php $this->load->view('admin/footer'); ?>
