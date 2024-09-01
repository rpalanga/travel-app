<script>
import { ref } from 'vue';
import apiClient from "../axios.js";

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
      console.log('Updating holiday ID:', id, 'with data:', this.editingHoliday);
      apiClient.put(`/holidays/${id}`, this.editingHoliday).then(() => {
        this.editingHoliday = null;
        this.loadHolidays();
      });
    },
    deleteHoliday(id) {
      apiClient.delete(`/holidays/${id}`).then(() => {
        this.loadHolidays();
      });
    },
    cancelEdit() {
      this.editingHoliday = null;
    }
  },
  mounted() {
    this.loadHolidays();
  }
};
</script>

<template>


  <div>

    <div class="container">
      <h1 class=" display-2">Holiday List</h1>
    
      <div class="row">
        <!-- Itera sulle festività e crea una card per ciascuna -->
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4" v-for="holiday in holidays" :key="holiday.id">
          <div class="card h-100">
            <img :src="holiday.img" class="card-img-top" :alt="holiday.title" style="height: 200px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ holiday.title }}</h5>
              <p class="card-text">{{ holiday.description }}</p>
              <div class="mt-auto">
                <button @click="editHoliday(holiday)" class="btn btn-warning btn-sm">Edit</button>
                <button @click="deleteHoliday(holiday.id)" class="btn btn-danger btn-sm">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Form per aggiungere una nuova festività -->
      <form @submit.prevent="createNewHoliday()" class="mt-4">
        <div class="row">
          <div class="col-12 col-md-4 mb-3">
            <input v-model="newHoliday.title" class="form-control" placeholder="Holiday Name" required />
          </div>
          <div class="col-12 col-md-4 mb-3">
            <input v-model="newHoliday.img" class="form-control" placeholder="Image URL" required />
          </div>
          <div class="col-12 col-md-4 mb-3">
            <textarea v-model="newHoliday.description" class="form-control" placeholder="Description" required></textarea>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Add Holiday</button>
      </form>

      <!-- Form per modificare una festività esistente -->
      <div v-if="editingHoliday" class="mt-4">
        <h3>Edit Holiday</h3>
        <form @submit.prevent="updateHoliday(editingHoliday.id)">
          <div class="row">
            <div class="col-12 col-md-4 mb-3">
              <input v-model="editingHoliday.title" class="form-control" placeholder="Holiday Name" required />
            </div>
            <div class="col-12 col-md-4 mb-3">
              <input v-model="editingHoliday.img" class="form-control" placeholder="Image URL" />
            </div>
            <div class="col-12 col-md-4 mb-3">
              <textarea v-model="editingHoliday.description" class="form-control" placeholder="Description"></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" @click="cancelEdit" class="btn btn-secondary">Cancel</button>
        </form>
      </div>
    </div>
  </div>

</template>



<style scoped>

.container {
  max-width: 1200px;
  padding: 0 15px;
}

/* Mantieni l'immagine della card adattabile al contenuto */
.card-img-top {
  height: 200px;
  object-fit: cover;
}
</style>
