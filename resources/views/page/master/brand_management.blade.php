@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Brand Management</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="panel panel-bordered">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        Brand Template
                                    </h3>
                                </div>
                                <div class="panel-body container-fluid">
                                    <div class="example-wrap">

                                        <ul class="nav nav-tabs">

                                            @foreach ($template as $item)
                                                <li class="nav-item">
                                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                        data-toggle="tab" href="#{{ $item->id }}"
                                                        @if($item->status != 1) onclick="alert('Template is not active'); return false;" @else
                                                        onclick="loadBrandTemplate('{{ $item->id }}')" @endif>
                                                        {{ $item->name }}
                                                    </a>
                                                </li>

                                                @if($loop->first)
                                                    <script>
                                                        $(document).ready(function() {
                                                            loadBrandTemplate('{{ $item->id }}');
                                                        });
                                                    </script>
                                                @endif
                                            @endforeach

                                        </ul>
                                        <div class="tab-content padding-top-20">
                                            <div class="tab-pane active" id="details" role="tabpanel">
                                                <div class="" id="member_basic_details">
                                                    <div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg mt-3" ></i></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.BannerSettingTable').DataTable({
                "info": false,
            });
        });
    </script>

    <script>
        function loadBrandTemplate(id) {
            $('#member_basic_details').html('<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg mt-3" ></i></div></div>');
            $.ajax({
                url: '/brand_management/' + id,
                method: 'GET',
                success: function(response) {
                    $('#member_basic_details').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading brand template:', error);
                }
            });
        }
    </script>
@endpush
