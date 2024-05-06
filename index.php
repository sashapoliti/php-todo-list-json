<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Mochiy+Pop+One&display=swap"
    rel="stylesheet">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <!-- CSS -->
  <link rel="stylesheet" href="style/style.css" />
  <!-- Axios -->
  <script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script>
  <!-- VueJS -->
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <!-- JS -->
  <script src="js/script.js" type="module" defer></script>
  <!-- Icon -->
  <link rel="icon" href="https://static.wikia.nocookie.net/722d3979-d955-4ac3-abc7-37147d1874bd/scale-to-width/755"
    type="image/x-icon">
  <title>Kirby's To-Do List</title>
</head>

<body>
  <div id="app">
    <!-- header -->
    <header class="bg-light p-4 d-flex justify-content-between">
      <div class="d-flex align-items-center">
        <img class="w-25 me-3" src="https://pa1.aminoapps.com/6828/499f88a5638efe22c11e52da833a382d780151bc_hq.gif"
          alt="Kirby gif">
        <h1>Kirby's To-Do List</h1>
      </div>
      <div class="d-flex align-items-center">
        <div>
          <select name="done" id="done" v-model="done">
            <option value="">tutto</option>
            <option value="true">fatto</option>
            <option value="false">da fare</option>
          </select>
        </div>
      </div>
    </header>

    <!-- main -->
    <main class="container my-4 bg-light">
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between" v-for="(item, index) in filteredToDo" :key="item.id">
          <span :class="{'text-decoration-line-through' : item.done}" @click="toggleDone(item.id)">
            <h5>{{ item.title }}</h5>
            <p>{{ item.description }}</p>
          </span>
          <i class="fa-regular fa-trash-can" @click="removeItem(item.id)"></i>
        </li>
      </ul>

      <!-- input -->
      <div class="add-task">
        <label for="todotitle" class="form-label">Inserisci to do titolo</label>
        <input type="text" class="form-control" id="todotitle" v-model="elTitle" @keyup.enter="addItem" />
        <label for="todotext" class="form-label">Inserisci to do testo</label>
        <input type="text" class="form-control" id="todotext" v-model="itemText" @keyup.enter="addItem" />
        <button class="mt-3" @click="addItem">Aggiungi</button>
    </main>
  </div>
</body>

</html>