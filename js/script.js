const { createApp } = Vue;

createApp({
  data() {
    return {
      toDo: [],
      elTitle: "",
      itemText: "",
      done: "",
    };
  },
  methods: {
    toggleDone(id) {
      /* console.log("Toggle done method called"); */
      /* const index = this.toDo.findIndex((el) =>  el.id === id); //find index
      
      if (index !== -1) { this.toDo[index].done = !this.toDo[index].done; }; //control */
      const data = {
        id: id,
      };
      axios.put("api.php", data).then((response) => {
        this.toDo = response.data;
      });
    },
    removeItem(id) {
      /* console.log("Remove method called"); */
      /* const index = this.toDo.findIndex((el) =>  el.id === id); //find index

      if (index !== -1) { this.toDo.splice(index, 1); }; //control */

      const data = {
        id: id,
      };
      axios.delete("api.php", { data }).then((response) => {
        this.toDo = response.data;
      });
    },
    addItem() {
      const newItem = {
        id: null,
        title: this.elTitle,
        description: this.itemText,
        done: false,
      };
      const result = this.toDo.reduce((acc, element) => {
        return element.id > acc ? element.id : acc;
      }, 0); //reduce for max value
      newItem.id = result + 1;

      const data = new FormData();
      data.append("id", newItem.id);
      data.append("title", newItem.title);
      data.append("description", newItem.description);
      data.append("done", newItem.done);
      axios.post("api.php", data).then((response) => {
        this.toDo = response.data;
      });
      this.elTitle = "";
      this.itemText = "";
    },
    getData() {
      axios.get("api.php").then((response) => {
        this.toDo = response.data;
      });
    },
  },
  computed: {
    filteredToDo() {
      return this.toDo.filter((element) => {
        if (this.done === "") {
          return true;
        } else if (this.done === "0") {
          return element.done === true;
        } else if (this.done === "1") {
          return element.done === false;
        }
      });
    },
  },
  created() {
    this.getData();
  },
}).mount("#app");
