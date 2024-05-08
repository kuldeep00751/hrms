$("body").on("click", "#btn-add-next-of-kin", function (e) {
    axios({
        method: "get",
        url: "/add-next-of-kin",
    }).then(function (response) {
        $("#next-of-kin-container").append(response.data.html);
    });
});

$("body").on("click", "#btn-add-previous-qualification", function (e) {
    axios({
        method: "get",
        url: "/add-previous-qualification",
    }).then(function (response) {
        $("#previous-qualification-container").append(response.data.html);
    });
});

$("body").on("click", "#btn-add-application", function (e) {
    let userInfoId = $(this).attr("data-id");

    axios({
        method: "get",
        url: `/add-application/${userInfoId}`,
    }).then(function (response) {
        if (response.data.status) {
            $("#application-container").append(response.data.html);
        } else {
            Swal.fire({
                title: "Maximum number of applications exceeded",
                text: response.data,
                icon: "warning",
            });
        }
    });
});

$("body").on("click", "#btn-edit-application", function (e) {
    let applicationId = $(this).attr("data-id");

    axios({
        method: "get",
        url: `/edit-application/${applicationId}`,
    }).then(function (response) {
        if (response.data.status) {
            $("#application-container").append(response.data.html);
        } else {
            Swal.fire({
                title: "Maximum number of applications exceeded",
                text: response.data,
                icon: "warning",
            });
        }
    });
});

$("body").on("click", ".btn-delete-application", function (e) {
    e.preventDefault();

    let deleteBtn = $(this);

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteBtn.closest("div").parent().remove();

            Swal.fire("Deleted!", "Your record has been deleted.", "success");
        }
    });
});

$("body").on("click", ".btn-delete-next-of-kin", function (e) {
    e.preventDefault();
    let deleteBtn = $(this);

    let deleteId = deleteBtn.attr("data-id");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios({
                method: "delete",
                url: "/delete-next-of-kin/" + deleteId,
                responseType: "html",
            }).then(function (response) {
                deleteBtn.closest("div").parent().remove();

                Swal.fire(
                    "Deleted!",
                    "Your record has been deleted.",
                    "success"
                );
            });
        }
    });
});

$("body").on("click", ".btn-delete-previous-qualification", function (e) {
    e.preventDefault();
    let deleteBtn = $(this);

    let deleteId = deleteBtn.attr("data-id");

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios({
                method: "delete",
                url: "/delete-previous-qualification/" + deleteId,
                responseType: "html",
            }).then(function (response) {
                deleteBtn.closest("div").parent().remove();

                Swal.fire(
                    "Deleted!",
                    "Your record has been deleted.",
                    "success"
                );
            });
        }
    });
});
