@extends('layouts.mantis')

@push('css')
    {{-- Load FullCalendar CSS --}}
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    <style>
        #calendar {
            max-height: 700px;
            margin-bottom: 20px;
        }

        .fc-event {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <h5>Kalender Jadwal Member</h5>
                <a href="{{ route('venue.schedule.create') }}" class="btn btn-primary">
                    + Tambah Jadwal
                </a>
            </div>
            <div class="card-body">
                {{-- Elemen Kalender --}}
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    {{-- Modal Tambah Tetap Sama Seperti Sebelumnya --}}
    {{-- @include('venue.schedule.partials.modal-add') --}}
@endsection

@push('scripts')
    {{-- Load FullCalendar JS --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridMonth',
                locale: 'id',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                events: {
                    url: "{{ route('venue.schedule.json') }}",
                    method: 'GET',
                },

                eventClick: function(info) {
                    if (confirm("Hapus jadwal ini?")) {
                        deleteEvent(info.event.id);
                    }
                }
            });

            calendar.render();
        });

        function deleteEvent(id) {
            let form = document.createElement('form');
            form.action = "/venue/schedule/" + id;
            form.method = "POST";
            form.innerHTML = `@csrf @method('DELETE')`;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endpush
