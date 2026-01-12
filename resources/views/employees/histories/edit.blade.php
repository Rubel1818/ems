@extends('layouts.app')

@section('content')
    <div class="container">

        <h4>Edit History — {{ $employee->name_bn }}</h4>

        <form method="POST" action="{{ route('employees.histories.update', [$employee->id, $history->id]) }}">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label>Section</label>
                <select name="section_id" class="form-control">
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}" {{ $history->section_id == $section->id ? 'selected' : '' }}>
                            {{ $section->section_name_bn }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Designation</label>
                <select name="designation_id" class="form-control">
                    @foreach ($designations as $designation)
                        <option value="{{ $designation->id }}"
                            {{ $history->designation_id == $designation->id ? 'selected' : '' }}>
                            {{ $designation->designation_name_bn }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ $history->start_date }}" class="form-control">
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('employees.histories.index', $employee->id) }}" class="btn btn-secondary">Back</a>
        </form>

    </div>
@endsection
