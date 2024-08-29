import axios from 'axios';

const apiClient = axios.create({
    baseURL: '/api', // Imposta la base URL per le tue API
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
});

export default apiClient;