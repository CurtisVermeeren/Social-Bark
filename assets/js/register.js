$(document).ready(function() {

    // On click signup, hide login and show registration form
    $("#signup").click(function() {
        $("#first").slideUp("fast", ()=> {
            $("#second").slideDown("fast");
        });
    });

    // On click signin, hide registration and show login form
    $("#signin").click(function() {
        $("#second").slideUp("fast", ()=> {
            $("#first").slideDown("fast");
        });
    });
});