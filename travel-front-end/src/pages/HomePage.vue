<script>
import { ref } from 'vue';
import apiClient from "../axios.js";
// import apiClient from './path-to-your-api-client';
// import apiClient from './apiClient';

export default {

  name: 'HomePage',

  data() {

    return {
      holidays: [],
      newHoliday: { title: '', img: '', description: '' },
      editingHoliday: null,

    };
  },

  methods: {
    loadHolidays() {
      apiClient.get('/holidays').then(res => {
        this.holidays = res.data.results; // Aggiorna this.holidays con i dati della risposta
        console.log('questo dato qui', res);
      }).catch(error => {
        console.error('Errore durante il caricamento delle festività:', error);
      });
    },

    createNewHoliday() {
      apiClient.post('/holidays', this.newHoliday).then(() => {
        this.loadHolidays();
        this.newHoliday = { title: '', img: '', description: '' };
      });
    },
    editHoliday(holiday) {
      this.editingHoliday = { ...holiday };
    },
    updateHoliday(id) {
      apiClient.put(`/holidays/${id}`, this.editingHoliday).then(() => {
        this.editingHoliday = null;
        this.loadHolidays();
      });
    },
    deleteHoliday(id) {
      apiClient.delete(`/holidays/${id}`).then(() => {
        this.loadHolidays();
      });
    }
  },
  mounted() {
    this.loadHolidays();
  }
};
</script>

<template>


  <div>
    <!-- <h1>Holiday List</h1>
    <ul>
      <li v-for="holiday in holidays" :key="holiday.id">
        {{ holiday.title }} <br>
        {{ holiday.description }}
        <img :src="holiday.img">
        <button @click="deleteHoliday(holiday.id)">Delete</button>
      </li>
    </ul>
    <button @click="createNewHoliday">Add Holiday</button> -->
    <!-- <ul>
      <li v-for="holiday in holidays" :key="holiday.id">
        {{ holiday.title }}
      </li>
    </ul> -->
    <!-- <h1>Holiday List</h1>
    <ul>
      <li v-for="holiday in holidays" :key="holiday.id">
        {{ holiday.title }} - <br> {{ holiday.description }}
        <img :src="holiday.img" alt="">
        <button @click="editHoliday(holiday)">Edit</button>
        <button @click="deleteHoliday(holiday.id)">Delete</button>
      </li>
    </ul>
    <form @submit.prevent="createHoliday">
      <input v-model="newHoliday.title" placeholder="Holiday Name" required /> -->
      <!-- <input v-model="newHoliday.img" placeholder="Holiday Date" required /> -->
      <!-- <button type="submit">Add Holiday</button>
    </form>
    <div v-if="editingHoliday">
      <h3>Edit Holiday</h3>
      <input v-model="editingHoliday.title" />
      <!-- <input v-model="editingHoliday.img" /> -->
      <!-- <button @click="updateHoliday(editingHoliday.id)">Update</button>
    </div> -->

    <div>
      <h1>Holiday List</h1>
      <ul>
        <li v-for="holiday in holidays" :key="holiday.id">
          {{ holiday.title }} - <br> {{ holiday.description }}
          <img :src="holiday.img" alt="">
          <button @click="editHoliday(holiday)">Edit</button>
          <button @click="deleteHoliday(holiday.id)">Delete</button>
        </li>
      </ul>
      <form @submit.prevent="createNewHoliday()">
        <input v-model="newHoliday.title" placeholder="Holiday Name" required />
        <input v-model="newHoliday.img" placeholder="Image URL" required />
        <input v-model="newHoliday.description" placeholder="Description" required />
        <button type="submit">Add Holiday</button>
      </form>
      <div v-if="editingHoliday">
        <h3>Edit Holiday</h3>
        <input v-model="editingHoliday.title" />
        <input v-model="editingHoliday.img" />
        <input v-model="editingHoliday.description" />
        <button @click="updateHoliday(editingHoliday.id)">Update</button>
      </div>
    </div>
    </div>

</template>



<style scoped>
.read-the-docs {
  color: #888;
}
</style>
