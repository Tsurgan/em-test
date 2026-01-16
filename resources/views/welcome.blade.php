<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>API списка задач </title>

    </head>
    <body>
        <form method="POST" action="{{ route('tasks.store') }}" >
            @csrf
            <label for="title">Заголовок</label></br>
            <input type="text" id="title" name="title"></br>
            <label for="description">Описание</label></br>
            <textarea id="description" name="description" rows="4" cols="50"></textarea></br>
            <label>Статус</label></br>
            <label>
                <input type="radio" name="status_id" value="1">
                Не начата
            </label></br>
            <label>
                <input type="radio" name="status_id" value="2">
                В работе
            </label></br>
            <label>
                <input type="radio" name="status_id" value="3">
                Завершена
            </label></br></br>
            <button type="submit" id="submitButton">Создать задачу</button>
        </form>
        </br>
        </br>
        <button>
            <a method="GET" href="/api/tasks">Вывести задачи</a>
        </button>
        </br>
        </br>
        </br>
        <input type="number" id="inputId" name="inputId" value="1"/>
        <button>
            <a method="GET" id="getById" name="getById" href="/api/tasks/1">Вывести задачу по ID</a>
        </button>
        </br>
        </br>
        </br>
        <form id="putById" method="POST" action="{{ route('tasks.update',['id'=>1]) }}">
            @csrf
            @method('PUT')
            <label for="title">Заголовок</label></br>
            <input type="text" id="title" name="title"></br>
            <label for="description">Описание</label></br>
            <textarea id="description" name="description" rows="4" cols="50"></textarea></br>
            <label>Статус</label></br>
            <label>
                <input type="radio" name="status_id" value="1">
                Не начата
            </label></br>
            <label>
                <input type="radio" name="status_id" value="2">
                В работе
            </label></br>
            <label>
                <input type="radio" name="status_id" value="3">
                Завершена
            </label></br></br>
            <input type="number" id="putInputId" name="putInputId" value="1"/>
            <button type="submit" id="putSubmitButton">Изменить задачу</button>
        </form>

        
        
        <form id="delById" method="POST" action="/api/tasks/1">
            @csrf
            @method('DELETE') 
            <input type="number" id="delInputId" name="delInputId" value="1"/>
            <button type="submit" id="delSubmitButton">Удалить задачу</button>
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const getInput = document.querySelector("#inputId");
                const getLink = document.getElementById("getById");

                const putInput = document.querySelector("#putInputId");
                const putLink = document.getElementById("putById");

                const delInput = document.querySelector("#delInputId");
                const delLink = document.getElementById("delById");

                getInput.addEventListener("change", getUpdateValue);
                putInput.addEventListener("change", putUpdateValue);
                delInput.addEventListener("change", delUpdateValue);

                function getUpdateValue(e) {
                    getLink.href = "/api/tasks/"+e.target.value;
                }

                function putUpdateValue(e) {
                    putLink.action = "/api/tasks/"+e.target.value;
                }                
                function delUpdateValue(e) {
                    delLink.action = "/api/tasks/"+e.target.value;
                }                    
            });
        </script>
    </body>
</html>
