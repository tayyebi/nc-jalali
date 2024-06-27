document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: ['dayGrid'],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,dayGridWeek,dayGridDay'
    },
    dayHeaderContent: function(info) {
      // Customize the header content here
      return '<div class="custom-header">' + info.dayNumberText + '<br>Happy 1st of July</div>';
    }
  });

  calendar.render();
});
