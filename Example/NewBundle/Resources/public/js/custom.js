$(document).ready(function() {
    $('a#ajax_delete').on("click", (function() {
        if (confirm("Are you sure?")) {
            $.post($(this).data('path'),
                function(response){
                    if(response.success){
                        location.reload();
                    }
                    else {
                        alert(response.message);
                    }
                }, "json");
        }
        return false;
        }))
});
