$(document).ready(function () {
    const selectElement = $('#selectStudent');
    const selectTask = $('#selectTask');
    const assignTaskButton = $('#assignTaskButton');

    let selectedValue;
    let selectedTask;
    let selectedTeacher;

    $.ajax({
        url: 'api/getListOfStudents.php',
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
            selectedValue = selectElement.val();

            fetchListOfFreeTasks(selectedValue);
        },
        error: function (xhr, status, error) {
            console.error('Request failed with status:', status);
        }
    });

    selectElement.on('change', function () {
        selectedValue = $(this).val();

        fetchListOfFreeTasks(selectedValue);
    });

    selectTask.on('change', function () {
        selectedTask = $(this).val();
    });

    assignTaskButton.on('click', function () {
        if (selectedValue && selectedTask) {

            $.ajax({
                url: 'api/assignTaskByTeacher.php',
                method: 'POST',
                data: {
                    selectedValue: selectedValue,
                    selectedTask: selectedTask,
                    selectedTeacher: selectedTeacher
                },
                success: function (response) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error('Task assignment failed with status:', status);
                }
            });
        } else {
        }
    });

    function fetchListOfFreeTasks(studentId) {
        $.ajax({
            url: 'api/getListOfFreeTasks.php',
            method: 'POST',
            data: { selectedValue: studentId },
            dataType: 'json',
            success: function (data) {
                selectTask.empty();
                selectedTeacher = data[0].teacher_id;
                data.forEach(function (item, index) {
                    selectTask.append($('<option>', {
                        value: item.id,
                        text: "Task " + item.id,
                        selected: index === 0
                    }));
                });

                selectedTask = selectTask.val();
            },
            error: function (xhr, status, error) {
                console.error('Request failed with status:', status);
            }
        });
    }
});