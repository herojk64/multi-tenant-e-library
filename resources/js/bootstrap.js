import axios from 'axios';
import '../../vendor/masmerise/livewire-toaster/resources/js';
import Alpine from 'alpinejs'
import AOS from 'aos';
import 'aos/dist/aos.css';
import 'hover.css/css/hover.css';


window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

AOS.init();

if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}
