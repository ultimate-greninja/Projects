let tasks = 2

function DeleteToDo(itemNumber) 
{
    const item = document.getElementById("item"+ itemNumber);

    item.parentNode.removeChild(item)
}
function AddToDo()
{
    let divContainer = document.createElement("div");
    divContainer.classList.add("todo");
    divContainer.id = "item"+tasks;

    let checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.id = "todocheck"+tasks;

    let span = document.createElement("span");
    span.classList.add("checkmark");
    span.setAttribute("onclick",`TaskChange(${tasks})`) // ${}` allows variables in it

    let textbox = document.createElement("input");
    textbox.type = "text";
    textbox.id = "todotext"+tasks;

    let button = document.createElement("input");
    button.type = "button";
    button.value = "X";
    button.classList.add("delete-button");
    button.setAttribute("onclick", `DeleteToDo(${tasks})`);

    divContainer.append(checkbox,span,textbox,button)

    const todos = document.getElementById("todos");

    todos.append(divContainer);

    tasks++;
}

function TaskChange(x) {
    const checkBoxTask = document.getElementById("todocheck"+x);
    const textBoxTask = document.getElementById("todotext"+x)

    if (!checkBoxTask.checked)
    {
        checkBoxTask.checked = true;
        textBoxTask.classList.add("complete");
        textBoxTask.disabled = true;
    }
    else
    {
        checkBoxTask.checked = false;
        textBoxTask.classList.remove("complete");
        textBoxTask.disabled = false;
    }
}