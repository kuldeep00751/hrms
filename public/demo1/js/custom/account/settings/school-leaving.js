//let matricTypeGrading = document.
let addSchoolLeavingBtn = document.getElementById("btn-add-school-subject");

addSchoolLeavingBtn.addEventListener("click", function () {
    axios({
        method: "get",
        url: "/add-school-subject",
        responseType: "html",
    }).then(function (response) {
        $("#school-subjects-tbl-body").append(response.data.html);
    });
});

$("body").on("change", ".matric_types", function (e) {
    let index = getIndexOfSelectedMatricType(e.target);

    let selectedMatricType = e.target.value;
    $.ajax({
        method: "GET",
        url: "/matric-type-grades/" + selectedMatricType,
    }).done(function (data) {
        let matricGrades = "<option>Please select</option>";
        $.each(data, function (key, value) {
            matricGrades +=
                "<option value='" +
                value.grade +
                "' data-points='" +
                value.points +
                "'>" +
                value.grade +
                "</option>";
        });

        $(".mid_term_results").eq(index).html(matricGrades);
        $(".final_term_results").eq(index).html(matricGrades);
    });
});

$("body").on("change", ".mid_term_results", function (e) {
    let midTermPointsIndex = getIndexOfSelectedMidTermGrade(e.target);

    calculateTotalMidTermPoints();

    $(".mid_term_points")
        .eq(midTermPointsIndex)
        .val($(this).find(":selected").attr("data-points"));
});

$("body").on("change", ".final_term_results", function (e) {
    let finalTermPointsIndex = getIndexOfSelectedFinalTermGrade(e.target);

    calculateTotalFinalTermPoints();

    $(".final_term_points")
        .eq(finalTermPointsIndex)
        .val($(this).find(":selected").attr("data-points"));
});

$("body").on("click", ".btn-delete-subject", function (e) {
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
                url: "/delete-subject/" + deleteId,
                responseType: "html",
            }).then(function (response) {
                deleteBtn.closest("tr").remove();
                calculateTotalMidTermPoints();
                calculateTotalFinalTermPoints();
                Swal.fire(
                    "Deleted!",
                    "Your record has been deleted.",
                    "success"
                );
            });
        }
    });
});

function getIndexOfSelectedMatricType(selectedLevel) {
    var nodes = document.getElementsByClassName("matric_types");

    for (let index = 0; index < nodes.length; index++) {
        if (nodes[index] === selectedLevel) {
            return index;
        }
    }
}

function getIndexOfSelectedMidTermGrade(selectedGrade) {
    var nodes = document.getElementsByClassName("mid_term_results");

    for (let index = 0; index < nodes.length; index++) {
        if (nodes[index] === selectedGrade) {
            return index;
        }
    }
}

function getIndexOfSelectedFinalTermGrade(selectedGrade) {
    var nodes = document.getElementsByClassName("final_term_results");

    for (let index = 0; index < nodes.length; index++) {
        if (nodes[index] === selectedGrade) {
            return index;
        }
    }
}

function calculateTotalMidTermPoints() {
    let totalPoints = 0;

    $(".mid_term_results").each(function (index, element) {
        let point = parseInt(
            $("option:selected", element).attr("data-points"),
            10
        );

        if (!isNaN(point)) {
            totalPoints += point;
        }
    });

    $("#mid_term_total_points").text(totalPoints);
}

function calculateTotalFinalTermPoints() {
    let totalPoints = 0;

    $(".final_term_results").each(function (index, element) {
        let point = parseInt(
            $("option:selected", element).attr("data-points"),
            10
        );

        if (!isNaN(point)) {
            totalPoints += point;
        }
    });

    $("#final_term_total_points").text(totalPoints);
}
