jQuery.ajax({
    type: "seriestv",
    dataType: "json",
   // url: myobject.ajax_url,
    //data: formData,
    success: function(msg){
        console.log(msg);
    }
});