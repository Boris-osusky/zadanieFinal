$(document).ready(function () {
    let sendAnsweredTaskButton = $('#sendAnsweredTaskButton');
    let generateTaskButton = $('#generateTaskButton');
    let selectElement = $('#selectGeneratedTask');
    let generateTaskArea = $('#generateTaskArea');
    let completeTaskArea = $('#completeTaskArea');
    let answerTaskArea = $('#answerTaskArea');
    let answerTaskInput = $('#answerTaskInput');
    var taskData = [];
    let selectedTask;

    $.ajax({
        url: 'api/getTasksOfOneStudent.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.length === 0) {
                generateTaskArea.html('<p>You have no task assigned</p>');
                completeTaskArea.empty();
                answerTaskArea.empty();
            } else {
                data.forEach(function (item, index) {
                    selectElement.append($('<option>', {
                        value: item.value,
                        text: 'Task ' + item.value,
                        selected: index === 0
                    }));
                });

                selectedTask = selectElement.val();
                console.log('Selected student value:', selectedTask);
            }
        },
        error: function (xhr, status, error) {
            console.log('Error in backend:', status);
        }
    });

    generateTaskButton.on('click', function () {
        $.ajax({
            url: 'api/assignTaskByStudent.php',
            method: 'POST',
            dataType: 'json',
            data: {
                selectedTask: selectedTask
            },
            success: function (data) {
                $('#completeTaskArea').empty();

                data.forEach(function (task) {
                    taskData = {
                        task: task.task,
                        answer: task.answer,
                        imagePath: task.image_path
                    };
                    printTaskData(taskData, completeTaskArea);
                });
                answerTaskArea.removeAttr('hidden');
            },
            error: function (xhr, status, error) {
                console.log('Error in backend:', status);
            }
        });
    }); 

    sendAnsweredTaskButton.on('click', function () {
        var input = answerTaskInput.val();
        $.ajax({
            url: 'api/evaluateAnswer.php',
            method: 'POST',
            dataType: 'json',
            data: {
                input : input,
                selectedTask : selectedTask
            },
            success: function (data) {
                console.log(data);
                window.location.href = 'studentRestricted.php';
            },
            error: function (xhr, status, error) {
                console.log('Error in backend:', status);
            }
        });
    });

    function printTaskData(taskData, element) {
        var taskElement = $('<p>').text('Task: ' + '\\( y=5 \\)');
        var answerElement = $('<p>').text('Answer: ' + taskData.answer);
        var imagePathElement = $('<p>').text('Image Path: ' + taskData.imagePath);
    
        element.append(taskElement);
        // element.append(answerElement);
        // element.append(imagePathElement);
    }
});