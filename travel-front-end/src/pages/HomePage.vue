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

      // sezione dei Day

      selectedHoliday: null, // Aggiunto per tracciare la festività selezionata
      days: [], // Aggiunto per memorizzare i giorni della festività selezionata
      newDay: { name: '', img: '', description: '', place: '', date: '' },
      editingDay: null, // Aggiunto per modificare un giorno

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
    },

    // sezione funzioni dei Day

    loadDays(holiday) {
      this.selectedHoliday = holiday;
      apiClient.get(`/holidays/${holiday.id}/days`).then(res => {
        this.days = res.data.results;
        console.log('voglio capire questo valore'+ res)
      }).catch(error => {
        console.error('Errore durante il caricamento dei giorni:', error);
      });
    },

    createNewDay() {
      apiClient.post(`/holidays/${this.selectedHoliday.id}/days`, this.newDay).then(() => {
        this.loadDays(this.selectedHoliday);
        this.newDay = { name: '', img: '', description: '', place: '', date: '' };
      });
    },

    editDay(day) {
      this.editingDay = { ...day };
    },

    updateDay(id) {
      apiClient.put(`/days/${id}`, this.editingDay).then(() => {
        this.editingDay = null;
        this.loadDays(this.selectedHoliday);
      });
    },

    deleteDay(id) {
      apiClient.delete(`/days/${id}`).then(() => {
        this.loadDays(this.selectedHoliday);
      });
    },

    cancelDayEdit() {
      this.editingDay = null;
    },
  },
  mounted() {
    this.loadHolidays();
  }
};
</script>

<template>


  <div>
<!-- 
    <div class="container">
      <h1 class=" display-5 fw-bolder">Holiday List</h1>
    
      <div class="row">
       
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
    </div> -->

    <div class="container">
      <h1 class="display-5 fw-bolder">Holiday List</h1>
    
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4" v-for="holiday in holidays" :key="holiday.id">
          <div class="card h-100">
            <img :src="holiday.img" class="card-img-top" :alt="holiday.title" style="height: 200px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ holiday.title }}</h5>
              <p class="card-text">{{ holiday.description }}</p>
              <div class="mt-auto">
                <button @click="editHoliday(holiday)" class="btn btn-warning btn-sm">Edit</button>
                <button @click="deleteHoliday(holiday.id)" class="btn btn-danger btn-sm">Delete</button>
                <button class="btn btn-primary btn-sm" @click="loadDays(holiday)" data-bs-toggle="modal" data-bs-target="#daysModal">View Days</button>
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

      <!-- Modal per visualizzare i giorni -->
      <div class="modal fade" id="daysModal" aria-hidden="true" aria-labelledby="daysModalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="daysModalLabel">{{ selectedHoliday ? selectedHoliday.title : '' }} - Days</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <ul class="list-group">
                <li class="list-group-item" v-for="day in days" :key="day.id">
                  <h6>{{ day.name }}</h6>
                  <p>{{ day.description }}</p>
                  <p><small>{{ day.place }} - {{ day.date }}</small></p>
                  <button @click="editDay(day)" class="btn btn-warning btn-sm">Edit</button>
                  <button @click="deleteDay(day.id)" class="btn btn-danger btn-sm">Delete</button>
                </li>
              </ul>

              <!-- Form per aggiungere un nuovo giorno -->
              <form @submit.prevent="createNewDay()" class="mt-4">
                <div class="mb-3">
                  <input v-model="newDay.name" class="form-control" placeholder="Day Name" required />
                </div>
                <div class="mb-3">
                  <input v-model="newDay.img" class="form-control" placeholder="Image URL" />
                </div>
                <div class="mb-3">
                  <textarea v-model="newDay.description" class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="mb-3">
                  <input v-model="newDay.place" class="form-control" placeholder="Place" />
                </div>
                <div class="mb-3">
                  <input v-model="newDay.date" class="form-control" placeholder="Date" />
                </div>
                <button type="submit" class="btn btn-primary">Add Day</button>
              </form>

              <!-- Form per modificare un giorno esistente -->
              <div v-if="editingDay" class="mt-4">
                <h5>Edit Day</h5>
                <form @submit.prevent="updateDay(editingDay.id)">
                  <div class="mb-3">
                    <input v-model="editingDay.name" class="form-control" placeholder="Day Name" required />
                  </div>
                  <div class="mb-3">
                    <input v-model="editingDay.img" class="form-control" placeholder="Image URL" />
                  </div>
                  <div class="mb-3">
                    <textarea v-model="editingDay.description" class="form-control" placeholder="Description"></textarea>
                  </div>
                  <div class="mb-3">
                    <input v-model="editingDay.place" class="form-control" placeholder="Place" />
                  </div>
                  <div class="mb-3">
                    <input v-model="editingDay.date" class="form-control" placeholder="Date" />
                  </div>
                  <button type="submit" class="btn btn-success">Update</button>
                  <button type="button" @click="cancelDayEdit" class="btn btn-secondary">Cancel</button>
                </form>
              </div>

            </div>
          </div>
        </div>
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
