$("body").on("click", "#btn-add-module", function (e) {
    axios({
        method: "get",
        url: "/registration/add-module-section",
    }).then(function (response) {
        $("#add-module-container").append(response.data.html);
    });
});
