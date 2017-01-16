/**
 * Created by artur on 16.01.17.
 */
$( document ).ready(function() {
    $("#click-table").dataTable({
         "dom": 'ftr',
        "order": [[0, "asc"]],
    });

    $("#bad-table").dataTable({
        "dom": 'ftr',
        "order": [[0, "asc"]],
    });
});
