$(function() {
    
    $("#search-btn").on("click", function(e) {
        
        $("#search-box").linkpreview({
            previewContainer: "#preview-container",
            refreshButton: "#search-btn",
            previewContainerClass: "row-fluid",
            errorMessage: "Invalid URL",
            preProcess: function() {
                console.log("preProcess");
            },
            onSuccess: function() {
                console.log("onSuccess");
            },
            onError: function() {
                console.log("onError");
            },
            onComplete: function() {
                console.log("onComplete");
            }
        });
    });

    // $("a").linkpreview({
    //     previewContainer: "#preview-container"
    // });
    
});