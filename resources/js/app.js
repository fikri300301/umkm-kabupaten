import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import $ from 'jquery';
import Swal from 'sweetalert2';
import select2 from 'select2';

import './dark';
import './main';

window.$ = $;
window.Alpine = Alpine;
window.Swal = Swal;
select2();

Alpine.plugin(focus);

Alpine.start();
