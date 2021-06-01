@extends('layouts.app')

@section('page-title') {{ __('beep.FlashLog').': '.(isset($flashlog->name) ? $flashlog->name : __('general.Item')).' ('.$flashlog->id.')' }}
@endsection

@section('content')
    @component('components/box')
        @slot('title')
            {{ (isset($flashlog->name) ? $flashlog->name : __('general.Item')).' '.__('crud.attributes') }}
        @endslot

        @slot('action')
            @permission('role-edit')
                <a href="{{ route('flash-log.edit', $flashlog->id) }}" title="{{ __('crud.edit') }}"><button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
            @endpermission
        @endslot

        @slot('body')

            <table class="table table-responsive table-striped">
                <tbody>
                    <tr>
                        <th>ID</th><td>{{ $flashlog->id }}</td>
                    </tr>
                    <tr><th> User Id </th><td> {{ $flashlog->user_id }} </td></tr>
                    <tr><th> Device Id </th><td> {{ $flashlog->device_id }} </td></tr>
                    <tr><th> Hive Id </th><td> {{ $flashlog->hive_id }} </td></tr>
                    <tr><th> Log Messages </th><td> {{ $flashlog->log_messages }} </td></tr>
                    <tr><th> Log Saved </th><td> {{ $flashlog->log_saved }} </td></tr>
                    <tr><th> Log erased </th><td> {{ $flashlog->log_erased }} </td></tr>
                    <tr><th> Log Parsed </th><td> {{ $flashlog->log_parsed }} </td></tr>
                    <tr><th> Log Has Timestamps </th><td> {{ $flashlog->log_has_timestamps }} </td></tr>
                    <tr><th> Bytes Received </th><td> {{ $flashlog->bytes_received }} </td></tr>
                    <tr><th> Bytes at BEEP base </th><td> {{ $flashlog->log_size_bytes }} </td></tr>
                    <tr><th> Log file raw </th><td> <a target="_blank" href="{{ $flashlog->log_file }}">{{ $flashlog->log_file }}</a> </td></tr>
                    <tr><th> Log file stripped </th><td> <a target="_blank" href="{{ $flashlog->log_file_stripped }}">{{ $flashlog->log_file_stripped }}</a> </td></tr>
                    <tr><th> Log file parsed </th><td> <a target="_blank" href="{{ $flashlog->log_file_parsed }}">{{ $flashlog->log_file_parsed }}</a> </td></tr>
                </tbody>
            </table>

        @endslot
    @endcomponent
@endsection
