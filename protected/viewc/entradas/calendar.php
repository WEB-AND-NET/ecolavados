<link href='<?= $patch ?>global/packages/core/main.css' rel='stylesheet' />
<link href='<?= $patch ?>global/packages/daygrid/main.css' rel='stylesheet' />
<link href='<?= $patch ?>global/packages/timegrid/main.css' rel='stylesheet' />
<link href='<?= $patch ?>global/packages/list/main.css' rel='stylesheet' />
<script src='<?= $patch ?>global/packages/core/main.js'></script>
<script src='<?= $patch ?>global/packages/interaction/main.js'></script>
<script src='<?= $patch ?>global/packages/daygrid/main.js'></script>
<script src='<?= $patch ?>global/packages/timegrid/main.js'></script>
<script src='<?= $patch ?>global/packages/list/main.js'></script>
<div>
    <div class="box ">
        <div class="box-body">
            <div id='calendar'></div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            events: {
                url: '<?= $data["rootUrl"] ?>entrys/calendar/load'
            },header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },eventClick: function(info) {
                console.log(info.event._def.extendedProps.nombre)
                if(info.event._def.extendedProps.nombre == null){
                    
                    window.location="<?php echo $data["rootUrl"] ?>entrys/schedule/assing/"+info.event.id
                }else{
                    alert("Ya fue asignado un operario");
                }
                
            }
            
        })
        calendar.render();
    })

 
</script>