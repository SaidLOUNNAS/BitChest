$(function () {
    // Manage mobile nav
    $("#closeNav, #toggleNav").click(function() {
        $("#sidebar").toggleClass('hidden');
    });
    $('.datatable:not(.custom)').DataTable({});

    // Trigger tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
