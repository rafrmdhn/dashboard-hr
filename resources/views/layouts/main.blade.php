<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Dashboard HR | {{ $title }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
    @include('partials.navbar')
    
    @include('partials.aside')

    @if (!request()->is('fdashboard', 'fregistrasi'))
        @include('partials.header')
    @endif
    @if (request()->is('fregistrasi'))
        @include('partials.link')
    @endif
    
    <div class="container max-w-full {{ Request::is('/') ? 'bg-gray-300' : '' }}">
        @yield('container')
    </div>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script>
        $(function(e){
            $("#select_all_ids").click(function(){
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
            });

            $('#deleteAllSelectorRecord').click(function(e){
                e.preventDefault();
                console.log("Hello")
                let form = $('#selectedData');
                form.submit();
                // var all_ids = [];
                // $('input:checkbox[name=ids]:checked').each(function(){
                //     all_ids.push($(this).val());
                // });

                // $.ajax({
                //     url:"",
                //     type:"DELETE",
                //     data:{
                //         ids:all.ids,
                //         _token:'@csrf'
                //     },
                //     success:function(response){
                //         $.each(all_ids,function(key, val){
                //             $('#_ids' + val).remove();
                //         })
                //     }
                // })
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</body>
</html>