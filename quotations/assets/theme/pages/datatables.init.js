/*
 Template Name: Urora - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File: Datatable js
 */

$(document).ready(function() {
    $('#datatable').DataTable();
    $('#datatable2').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
} );