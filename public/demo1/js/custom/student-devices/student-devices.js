//let matricTypeGrading = document.
let addStudentDeviceBtn = document.getElementById("btn-add-device");

addStudentDeviceBtn.addEventListener("click", function () {
    axios({
        method: "get",
        url: "/student_devices/add-device-row",
        responseType: "html",
    }).then(function (response) {
        $("#student-device-tbl-body").append(response.data.html);
    });
});

$("body").on("change", ".devices", function (e) {
    let index = getSelectedIndex(e.target);

    let selectedDevice = e.target.value;

    $.ajax({
        method: "GET",
        url: "/student_devices/get-device-info/" + selectedDevice,
    }).done(function (data) {
        let deviceType =
            data.studentDeviceInventory.student_device_type.device_type;

        let description = data.studentDeviceInventory.description;

        let validUntil = addMonthsToDate(
            data.studentDeviceInventory.student_device_type.valid_months
        );

        $(".device-type").eq(index).val(deviceType);
        $(".description").eq(index).val(description);
        $(".valid-until-date").eq(index).val(validUntil);
    });
});

$("body").on("click", ".btn-delete-student-device", function (e) {
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
                url: "/student_devices/delete-student-device/" + deleteId,
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

function getSelectedIndex(selectedLevel) {
    var nodes = document.getElementsByClassName("devices");

    for (let index = 0; index < nodes.length; index++) {
        if (nodes[index] === selectedLevel) {
            return index;
        }
    }
}

function addMonthsToDate(months) {
    var currentDate = new Date(); // Get today's date
    var futureDate = new Date(); // Create a new date object

    futureDate.setMonth(currentDate.getMonth() + months); // Add months to the current date

    var year = futureDate.getFullYear();
    var month = String(futureDate.getMonth() + 1).padStart(2, "0");
    var day = String(futureDate.getDate()).padStart(2, "0");

    return year + "-" + month + "-" + day;
}
