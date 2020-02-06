<!-- JQuery -->
<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/bootstrap.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?=base_url()?>assets/mdb/js/mdb.min.js"></script>
<script>

    // SideNav Initialization
    $(".button-collapse").sideNav();

    var container = document.getElementById('slide-out');
    Ps.initialize(container, {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20
    });

    // Material Select Initialization
    $(document).ready(function () {
        $('.datepicker').pickadate({
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd'
        });
        // $('select').addClass('mdb-select');
        // $('.mdb-select').material_select();
    });

    // Tooltips Initialization
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>