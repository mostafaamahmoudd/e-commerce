import axios from 'axios';
import 'jquery';
import 'bootstrap';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
