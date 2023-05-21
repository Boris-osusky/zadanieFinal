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
            console.log("getListOfStudents.php");
            console.log('Selected student value:', selectedValue);

            fetchListOfFreeTasks(selectedValue);
        },
        error: function (xhr, status, error) {
            console.error('Request failed with status:', status);
        }
    });

    selectElement.on('change', function () {
        selectedValue = $(this).val();
        console.log('Selected student value on click:', selectedValue);

        fetchListOfFreeTasks(selectedValue);
    });

    selectTask.on('change', function () {
        selectedTask = $(this).val();
        console.log('Selected task value on click:', selectedTask);
    });

    assignTaskButton.on('click', function () {
        if (selectedValue && selectedTask) {
            console.log('Selected student value:', selectedValue);
            console.log('Selected task value:', selectedTask);

            $.ajax({
                url: 'api/assignTaskByTeacher.php',
                method: 'POST',
                data: {
                    selectedValue: selectedValue,
                    selectedTask: selectedTask,
                    selectedTeacher: selectedTeacher
                },
                success: function (response) {
                    console.log("assignTaskByTeacher");
                    console.log('Task assigned successfully');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error('Task assignment failed with status:', status);
                }
            });
        } else {
            console.log('Please select a student and a task');
        }
    });

    function fetchListOfFreeTasks(studentId) {
        $.ajax({
            url: 'api/getListOfFreeTasks.php',
            method: 'POST',
            data: { selectedValue: studentId },
            dataType: 'json',
            success: function (data) {
                console.log("function fetchListOfFreeTasks success");
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
                console.log("getListOfFreeTasks.php");
                console.log('Selected task value:', selectedTask);
                console.log('Selected teacher ID:', selectedTeacher);
            },
            error: function (xhr, status, error) {
                console.error('Request failed with status:', status);
            }
        });
    }
});