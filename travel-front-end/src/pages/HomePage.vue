<script>
import { ref } from 'vue';
import apiClient from "../axios.js";
// import apiClient from './path-to-your-api-client';
// import apiClient from './apiClient';

export default {

  name: 'HomePage',

  data() {

    return {
      holidays: []

    };
  },

  methods: {
    loadHoliday() {
      apiClient.get('/holidays').then(res => {
        this.holidays = res.data.results; // Aggiorna this.holidays con i dati della risposta
        console.log('questo dato qui', res);
      }).catch(error => {
        console.error('Errore durante il caricamento delle festività:', error);
      });
    },
  
  // createNewHoliday() {
  //   const newHoliday = { title: 'New Holiday' };
  //   apiClient.post('/holidays', newHoliday).then(() => {
  //     this.loadHolidays();
  //   });
  // },
  // deleteHoliday(id) {
  //   apiClient.delete(`/holidays/${id}`).then(() => {
  //     this.loadHolidays();
  //   });
  // }
},
mounted() {
  this.loadHoliday();
}
};
</script>

<template>


  <div>
    <h1>Holiday List</h1>
    <!-- <ul>
        <li v-for="holiday in holidays" :key="holiday.id">
          {{ holiday.title }}
          <button @click="deleteHoliday(holiday.id)">Delete</button>
        </li>
      </ul>
      <button @click="createNewHoliday">Add Holiday</button> -->
    <ul>
      <li v-for="holiday in holidays" :key="holiday.id">
        {{ holiday.title }}
      </li>
    </ul>
  </div>

</template>



<style scoped>
.read-the-docs {
  color: #888;
}
</style>
