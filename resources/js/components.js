import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

export default {
  mounted() {
    let calendarEl = document.getElementById('calendar');

    let calendar = new Calendar(calendarEl, {
      plugins: [ dayGridPlugin, timeGridPlugin, interactionPlugin ],
      events: '/events',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      eventClick: function(info) {
        console.log(info.event.title);
      }
    });

    calendar.render();
  }
}
