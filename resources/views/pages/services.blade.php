@extends('layouts.app')

@section('content')
    @include('components.page-banner', [
        'title' => 'Our Services',
        'subtitle' => config('ctc.name'),
    ])

    <section class="py-16 lg:py-20" id="cardiac_surgery">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Cardiac Surgery" subtitle="Surgical care for heart conditions in adults and children." />
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($cardiac as $service)
                    <x-service-card
                        :name="$service->name"
                        :description="$service->description"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20 bg-ctc-grey-light" id="thoracic_surgery">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Thoracic Surgery" subtitle="Surgery for lung, chest wall, and mediastinal conditions." />
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($thoracic as $service)
                    <x-service-card
                        :name="$service->name"
                        :description="$service->description"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-20" id="diagnostics">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-title title="Diagnostics" subtitle="Imaging and testing for accurate diagnosis." />
            <div class="grid sm:grid-cols-2 gap-6">
                @foreach($diagnostics as $service)
                    <x-service-card
                        :name="$service->name"
                        :description="$service->description"
                    />
                @endforeach
            </div>
        </div>
    </section>
@endsection
