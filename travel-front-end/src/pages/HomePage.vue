<script>
import { ref } from 'vue';
import apiClient from 'axios';
export default {

  name:'HomePage',

  data() {

    return {
      holidays: []
    };
  },

  methods: {
    loadHolidays() {
      apiClient.get('/holidays').then(response => {
        this.holidays = response.data;
        console.log('questo dato qui'+response.data.data)
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
    this.loadHolidays();
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
            {{ holiday }}
        </li>
      </ul>
    </div>
  
</template>



<style scoped>
.read-the-docs {
  color: #888;
}
</style>
