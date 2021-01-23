@if (session()->has('success'))
    <script>
        Swal.fire('Good job!', session()->pull("success"), 'success')
        notification = @json(session()->pull("swal_msg"));
        swal(notification.title, notification.message, notification.type);
        do:
       @php
          session()->forget('success');
       @endphp
    </script>
@endif
