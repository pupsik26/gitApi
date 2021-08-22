$(document).ready(function(){
    $('#submit').on('click', function(e){
        e.preventDefault();
        let data = $('#formGroupExampleInput').val();
        if (data == ''){
            alert('Please, put data');
        } else {
            $.ajax({
            type: 'POST',
            url: 'php/db_connection.php',
            data: 'data=' + data,
            success: function(data) {
                $('#content').html(data);
            }
            });
        }
    });
});
