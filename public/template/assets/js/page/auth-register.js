"use strict";

$(document).ready(function(){
    $("#password").click(function(){
        $(".pwstrength").pwstrength();
    });
});

$(document).ready(function(){
    $("#password-update").click(function(){
        $("#password-update").pwstrength();
    });
});