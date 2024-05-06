const { createApp } = Vue;

createApp({
  data() {
    return {
      toDo : [],
      elTitle : '',
      itemText : '',
      done : ''
    };
  },
  methods: {
    toggleDone(id) {
      /* console.log("Toggle done method called"); */
      const index = this.toDo.findIndex((el) =>  el.id === id); //find index
      
      if (index !== -1) { this.toDo[index].done = !this.toDo[index].done; }; //control
    },
    removeItem(id) {
      /* console.log("Remove method called"); */
      const index = this.toDo.findIndex((el) =>  el.id === id); //find index

      if (index !== -1) { this.toDo.splice(index, 1); }; //control
    },
    addItem() {
      const newItem = {
        id : null,
        title : this.elTitle,
        description : this.itemText,
        done : false
      };
      const result = this.toDo.reduce((acc, element) => {
        return element.id > acc ? element.id : acc;
      }, 0); //reduce for max value
      newItem.id = result + 1;

      const data = new FormData();
      data.append('id', newItem.id);
      data.append('title', newItem.title);
      data.append('description', newItem.description);
      data.append('done', newItem.done);
      axios.post("api.php", data).then((response) => {
        console.log(response.data);
      })
      this.elTitle = '';
      this.itemText = '';
    },
    getData() {
      axios.get("api.php").then((response) => {
        this.toDo = response.data;
      })
    }
  },
  computed: {
    filteredToDo() {
      return this.toDo.filter((element) => {
        if (this.done === '') {
          return true
        } else if (this.done === 'false') {
          return element.done === false
        } else if (this.done === 'true') {
          return element.done === true
        }
      })
    }
  },
  created() {
    this.getData();
  }
}).mount("#app");
