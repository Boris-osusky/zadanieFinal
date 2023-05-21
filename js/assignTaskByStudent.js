$(document).ready(function () {

    let selectedTask;

    $.ajax({
        url: 'api/getTasksOfOneStudent.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            data.forEach(function (item, index) {
                selectElement.append($('<option>', {
                    value: item.value,
                    text: item.text,
                    selected: index === 0
                }));
            });

            selectedTask = selectElement.val();
            console.log('Selected student value:', selectedTask);

        },
        error: function (xhr, status, error) {
            console.error('Request failed with status:', status);
        }
    });
});