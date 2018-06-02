$( document ).ready(function() {
    $('#start').on('click', function() {
        $('#role').val("1");
        $('#edit').submit();
    });
    $('#approve').on('click', function() {
        $('#role').val("2");
        $('#edit').submit();
    });
    $('#block').on('click', function() {
        $('#role').val("3");
        $('#edit').submit();
    });
    $('#restart').on('click', function() {
        $('#role').val("4");
        $('#edit').submit();
    });
    $('#create_start').on('click', function() {
        $('#role').val("2");
        $('#create').submit();
    });
});