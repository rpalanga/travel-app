import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://127.0.0.1:8000/api', // Imposta la base URL per le tue API
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
});

export default apiClient;