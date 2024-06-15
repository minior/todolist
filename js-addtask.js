document.addEventListener('DOMContentLoaded', function() {
    function addTask() {
        if (taskcount > 49) {
            alert('Sorry, there is a ~50 task limit per user right now, thanks for using!');
            return;
        }
        console.log('adding task field ' + taskcount);

        const taskfield = document.getElementById('taskfield');

        const taskitem = document.createDocumentFragment();
        //defining child items

        const taskcontainer = document.createElement('div');
        taskcontainer.id = 'task' + taskcount;

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'status' + taskcount;
        
        const text = document.createElement('input');
        text.type = 'text';
        text.name = 'task' + taskcount;
        text.size = 30;
        text.maxLength = 30;

        const deadline = document.createElement('input');
        deadline.type = 'date';
        deadline.name = 'deadline' + taskcount;

        const removebutton = document.createElement('button');
        removebutton.innerText = '-';
        removebutton.addEventListener('click', function() {
            taskcontainer.remove();
        });

        taskcontainer.appendChild(checkbox);
        taskcontainer.appendChild(text);
        taskcontainer.appendChild(deadline);
        taskcontainer.appendChild(removebutton);
        taskitem.appendChild(taskcontainer);
        taskfield.appendChild(taskitem);
        taskcount++;
    };
    document.getElementById('addtask').addEventListener('click', addTask);
});