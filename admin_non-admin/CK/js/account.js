function openshell() {
    $.ajax({
        url: 'actions/linux/loadshell.php',
        success: function(result) {
            console.log(result);
            $('#home').html('<iframe width="720" src="http://linux.campuskarma.in:443"></iframe>');
        }
    });
}

$(function(){
    $('input[name="create-account"]').on('click', function(e) {
        e.preventDefault();
        var here = $(this);
        here.attr('disabled', 'disabled');
        here.val('Creating...');
        $.ajax({
            url: 'actions/linux/create.php',
            success: function(result) {
                result = $.trim(result);
                if(result == "User has been created successfully. Check your mail for login details.") {
                    here.val('Success. Loading terminal...');
                    openshell();
                } else {
                    here.val('Error. Please try again later!');
                }
            }
        });
    });
    
    $('input[name="login-account"]').on('click', function(e) {
        e.preventDefault();
        var here = $(this);
        here.attr('disabled', 'disabled');
        here.val('Opening terminal...');
        openshell();
    });
    
    $('input[name="extend-account"]').on('click', function(e) {
        e.preventDefault();
        var here = $(this);
        here.attr('disabled', 'disabled');
        here.val('Extending...');
        $.ajax({
            url: 'actions/linux/extend.php',
            success: function(result) {
                result = $.trim(result);
                if(result == "Your account has been extended successfully.") {
                    here.val('Success');
                } else {
                    here.val('Error. Please try again later!');
                }
            }
        });
    });
    
    $('input[name="delete-account"]').on('click', function(e) {
        e.preventDefault();
        var here = $(this);
        here.attr('disabled', 'disabled');
        here.val('Deleting...');
        $.ajax({
            url: 'actions/linux/delete.php',
            success: function(result) {
                result = $.trim(result);
                if(result == "User has been deactivated successfully. Check your mail for confirmation.") {
                    here.val('Deleted!');
                } else {
                    here.val('Error. Please try again later!');
                }
            }
        });
    });
    
    $('input[name="request-service"]').on('click', function(e) {
        e.preventDefault();
        var here = $(this);
        here.attr('disabled', 'disabled');
        here.val('Submitting...');
        var message = $('textarea[name="message"]').val();
        $.ajax({
            url: 'actions/linux/request.php',
            type: 'post',
            data: 'message='+message,
            success: function(result) {
                result = $.trim(result);
                if(result == "Thank you for your request. One of our representative will contact you within the next 48 hours.") {
                    $('textarea[name="message"]').val('');
                    here.val('Submitted');
                } else {
                    here.val('Error. Please try again later!');
                }
            }
        });
    });
});


