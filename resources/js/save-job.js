import $ from "jquery";
// import axios from "axios";

$(document).ready(function() {
    $(".save-job-btn").on("click", function() {
        let saveBtn = $(this);
        let jobId = saveBtn.data("job-id");

        axios
            .post(`/jobs/${jobId}/save`)
            .then(function(response) {
                if (response.data.result == "saved") {
                    saveBtn.html('<i class="fa fa-star"></i>Saved');
                } else {
                    saveBtn.html('<i class="far fa-star"></i>Save');
                }
            })
            .catch(function(error) {
                let message = "Cannot save the job. Error: ";
                alert(message + error.message);
            });
    });
});
