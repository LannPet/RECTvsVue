<template>
  <section class="todolist-container">
    <div class="header-container">
      <h1>TODO LIST (VUE)</h1>
    </div>
    <form class="input-container" @submit.prevent="handleClick">
      <input
        type="text"
        placeholder="What Needs To Be Done?"
        v-model="newItem"
      />
      <button type="submit">Add</button>
    </form>
    <div class="list-container">
      <div
        v-for="(item, index) in list"
        :key="index"
        class="list-item-container"
      >
        <p class="item-name">{{ item }}</p>
        <button class="item-delete-btn" @click="handleDelete(index)">X</button>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      newItem: "",
      list: ["Walk the dog", "Take the trash out", "Buy a new Car"],
    };
  },
  methods: {
    async handleClick() {
      if (!this.newItem) return;

      this.list.push(this.newItem); // Add the new item to the list

      try {

        console.log("adding item")
        const response = await axios.post("http://localhost:8000/", {
          item: this.newItem,
        });

        if (!response) return;

        this.newItem = ""; // Clear the input field
      } catch (error) {
        console.error("Error adding item:", error);
      }
    },
    handleDelete(index) {
      this.list.splice(index, 1); // Remove item by index
    },
  },
};
</script>

<style scoped>


button{
  cursor: pointer;
}

h1{
    font-family: sans-serif;
    font-size: 40px;
    color: black
}

.todolist-container{
    width: 40%;
    height: 80%;
    background-color: rgb(156, 212, 223);
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;    
}

.list-container{
    display: flex;
    flex-direction: column;
    margin-top: 50px;
    width: 100%;
    align-items: center;
}

.input-container {
    width: 70%;
    display: flex;
    
}

.input-container input{
    width: 100%;
    height: 40px;
    text-align: center;
    font-family: sans-serif;
    font-size: 20px;
    font-weight: 200;
    border: 0;
}

.list-item-container{
    display: flex;
    align-items: center;
    gap: 30px;
    width: 70%;
    font-family: sans-serif;
    font-weight: 500;
    letter-spacing: 3px;
}

.item-delete-btn{
    height: fit-content;
    margin-left: auto;
}

.item-name{
    margin: 5px 0;
}
</style>
