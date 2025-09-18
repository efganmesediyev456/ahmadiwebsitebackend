
<head>

    <meta charset="utf-8" />
    <title>Təhsil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/backend/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />


    <link href="{{ asset('backend/datatable/dataTables.bootstrap5.css') }}"  >
    <link href="{{ asset('backend/datatable/autoFill.bootstrap5.css') }} "  >
    <link href="{{ asset('backend/datatable/buttons.bootstrap5.css') }}  "  >
    <link href="{{ asset('backend/datatable/colReorder.bootstrap5.css') }} " >
    <link href="{{ asset('backend/datatable/fixedColumns.bootstrap5.css') }}" >
    <link href="{{ asset('backend/datatable/fixedHeader.bootstrap5.css') }}">
    <link href="{{ asset('backend/datatable/responsive.bootstrap5.css') }}" >
    <link href="{{ asset('backend/datatable/rowReorder.bootstrap5.css') }}">
    <link href="{{ asset('backend/datatable/scroller.bootstrap5.css') }}" >
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">

    <!-- App Css-->
    <link href="/backend/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="/backend/assets/css/custom.css?v={{ time() }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    @stack('css')

</head>
