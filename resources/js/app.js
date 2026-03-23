import './bootstrap';

import Alpine from 'alpinejs';
import AOS from 'aos';

window.Alpine = Alpine;
Alpine.start();

AOS.init({ duration: 800, once: true });
window.AOS = AOS;
