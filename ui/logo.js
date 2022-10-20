function frmValidate() {
    var val = $("#domain").val();
    if (/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/.test(val)) {
        return true;
    } else {
        alert("Enter Valid Domain Name");
        $("#domain").focus();
        return false;
    }
}


$(document).on("change", "#size", function(e){
    $("#sizez").text($(this).val());
});
$(document).on("change", "#offset", function(e){
    $("#offsetz").text($(this).val());
});
$(document).on("change", "#poffset", function(e){
    $("#poffsetz").text($(this).val());
});


$(document).on("change", "#color, #price, #domain, #template, #font, #size, #offset, #poffset", function (e) {
var $this = $(this);

makeAjax();
})
    function makeAjax(){

    var data = new FormData();
    data.append("domain", $("#domain").val());
    data.append("font", $("#font").val());
    data.append("color", $("#color").val());
    data.append("price", $("#price").val());
    data.append("template", $("#template").val());
    data.append("size", $("#size").val());
    data.append("offset", $("#offset").val());
    data.append("poffset", $("#poffset").val());



    $("#submit_btn").prop("disabled", true);
    $.ajax({
        type: "POST",
        url:  $("#logo_maker").data("action"),
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $("#preview_image").attr("src", data.basecode);
            $("#clicker").attr("download",$("#domain").val()+".jpg");
            $("#clicker").attr("href", data.basecode);

        },
        error: function (e) {

            console.log("ERROR : ", e);
            var gL = e.responseJSON.error;
            alert(gl);
        }
    })
}
